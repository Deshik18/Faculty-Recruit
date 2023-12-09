<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer Autoloader
require 'path/to/PHPMailer/Exception.php';
require 'path/to/PHPMailer/PHPMailer.php';
require 'path/to/PHPMailer/SMTP.php';

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

    // Get the current date in the desired format (e.g., DD/MM/YYYY)
    $currentDate = date('d/m/Y');

    // Generate a unique activation token (you can use any method to create this token)
    $activationToken = bin2hex(random_bytes(16)); // This is just an example; you can choose your own method.

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO faculty_details (fn_ln_cast, email, password, activate, doa) VALUES ('" . mysqli_real_escape_string($conn, $fn_ln_cast) . "', '" . mysqli_real_escape_string($conn, $email) . "', '" . mysqli_real_escape_string($conn, $password) . "', '{\"activation_token\":\"$activationToken\", \"activated\":false}', '" . $currentDate . "')";

    if (mysqli_query($conn, $sql)) {
        // Set up PHPMailer for SMTP
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'your_username';
            $mail->Password = 'your_password';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipient
            $mail->setFrom('your_email@example.com', 'Admin');
            $mail->addAddress($email);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = "User Registration Activation Email";
            $mail->Body = "Click this link to activate your account: <a href='" . $actual_link . "'>" . $actual_link . "</a>";

            // Send the email
            $mail->send();

            $message = "You have registered and the activation mail is sent to your email. Click the activation link to activate your account.";
            $type = "success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        unset($_POST);
    } else {
        // Registration failed, handle the error
        echo "Registration failed. Please try again or contact support.";
    }

    mysqli_close($conn);
}
?>
