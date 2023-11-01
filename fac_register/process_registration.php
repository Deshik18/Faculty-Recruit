<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cast = $_POST['cast'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Check if password and re_password match
    if ($password !== $re_password) {
        echo "Passwords do not match. Please go back and try again.";
        exit();
    }

    // Combine first name, last name, and cast into a JSON object
    $fn_ln_cast = json_encode(array(
        'first_name' => $firstname,
        'last_name' => $lastname,
        'cast' => $cast
    ));

    // Generate a unique activation token (you can use any method to create this token)
    $activationToken = bin2hex(random_bytes(16)); // This is just an example; you can choose your own method.

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO faculty_details (fn_ln_cast, email, password, activate) VALUES ('" . mysqli_real_escape_string($conn, $fn_ln_cast) . "', '" . mysqli_real_escape_string($conn, $email) . "', '" . mysqli_real_escape_string($conn, $password) . "', '{\"activation_token\":\"$activationToken\", \"activated\":false}')";

    if (mysqli_query($conn, $sql)) {
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" . "activate.php?id=" . $sql;
        $toEmail = $email;
        $subject = "User Registration Activation Email";
        $content = "Click this link to activate your account | <a href='" . $actual_link . "'>" . $actual_link . "</a>";
        $mailHeaders = "From: Admin\r\n";
        if (mail($toEmail, $subject, $content, $mailHeaders)) {
            $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate you account.";
            $type = "success";
        }else {
            // Email sending failed
            echo "Registration succeeded, but we couldn't send the activation email. Please contact support.";
        }
        unset($_POST);
    } else {
        // Registration failed, handle the error
        echo "Registration failed. Please try again or contact support.";
    }

    mysqli_close($conn);
}
?>
