<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your reCAPTCHA secret key
    $recaptchaSecretKey = 'YOUR_RECAPTCHA_SECRET_KEY_HERE';

    // Verify the CAPTCHA response
    if (isset($_POST['g-recaptcha-response'])) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptchaData = array(
            'secret' => $recaptchaSecretKey,
            'response' => $recaptchaResponse
        );

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($recaptchaData)
            )
        );

        $context = stream_context_create($options);
        $recaptchaResult = file_get_contents($recaptchaUrl, false, $context);
        $recaptchaResult = json_decode($recaptchaResult, true);

        if ($recaptchaResult['success'] !== true) {
            // CAPTCHA verification failed
            echo "CAPTCHA verification failed. Please go back and try again.";
            exit();
        }
    } else {
        // CAPTCHA response not received
        echo "CAPTCHA verification failed. Please go back and try again.";
        exit();
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cast = $_POST['cast'];

    // Combine first name, last name, and cast into a JSON object
    $fn_ln_cast = json_encode(array(
        'first_name' => $firstname,
        'last_name' => $lastname,
        'cast' => $cast
    ));

    // Generate a unique activation token (you can use any method to create this token)
    $activationToken = bin2hex(random_bytes(16)); // This is just an example; you can choose your own method.

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO your_table_name (fn_ln_cast, email, password, activation_info) VALUES ('" . mysqli_real_escape_string($conn, $fn_ln_cast) . "', '" . mysqli_real_escape_string($conn, $_POST['email']) . "', '" . mysqli_real_escape_string($conn, $_POST['password']) . "', '{\"activation_token\":\"$activationToken\", \"activated\":false}')";

    if (mysqli_query($conn, $sql)) {
        // Registration was successful
        // Send an email with the activation link to the user's email address
        $to = $_POST['email'];
        $subject = "Activate your account";
        $message = "Dear " . $firstname . " " . $lastname . "\n\n";
        $message .= "You have successfully registered in the portal. Click the link below to activate your credentials:\n";
        $message .= "https://example.com/activate.php?token=" . $activationToken . "\n\n";
        $message .= "Thank you for registering!\n";
        $headers = "From: your_email@example.com";

        if (mail($to, $subject, $message, $headers)) {
            // Email sent successfully
            header('Location: registration_success.php');
            exit();
        } else {
            // Email sending failed
            echo "Registration succeeded, but we couldn't send the activation email. Please contact support.";
        }
    } else {
        // Registration failed, handle the error
        echo "Registration failed. Please try again or contact support.";
    }

    mysqli_close($conn);
}
?>
