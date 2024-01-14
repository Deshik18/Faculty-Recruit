<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .success-message {
    background-color: #3498db; /* Green background color */
    color: white;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    margin-top: 10px;
}
body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #2c3e50; /* Background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
</style>
</head>

<?php
require 'config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect user input from the registration form
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Generate a unique verification token
    $verificationToken = bin2hex(random_bytes(32));
    
    if ($conn->query($createTableQuery) === FALSE) {
        echo "Error creating table: " . $conn->error;
    }
    
    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users1 (name, phone, email, password, verification_token) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('sssss', $name, $phone, $email, $password, $verificationToken);
    
    if ($stmt->execute()) {
        // Send a verification email via Gmail SMTP
        require 'PHPMailer.php';
        require 'SMTP.php';
        require 'Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        //$mail->Username = 'dattisaisravanth@gmail.com'; // Your Gmail address
        //$mail->Password = 'cdfccigdzsjkvhzi'; // App Password generated in Gmail
        $mail->Username = 'deshiksingamsetty@gmail.com'; // Your Gmail address
        $mail->Password = 'akcxgetdhwoqsssd';
        
        //$mail->setFrom('dattisaisravanth@gmail.com', 'Sravanth');
        $mail->setFrom('deshiksingam@gmail.com', 'Shopeasy');
        $mail->addAddress($email);
        $mail->Subject = 'Verify Your Email Address';
        $verificationLink = 'http://localhost/verify1.php?token=' . $verificationToken;
        $mail->Body = 'Click the following link to verify your email address: ' . $verificationLink;

        try {
            if ($mail->send()) {
                echo '<div class="success-message">Registration successful! Please check your email to verify your account.</div>';
            } else {
                echo 'Email sending failed: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo 'Email sending failed: ' . $e->getMessage();
        }
        
    } else {
        echo 'Registration failed.';
    }
    $stmt->close();
}
?>