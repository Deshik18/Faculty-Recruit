<?php
include('../config.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    
    // Generate a unique reset token (you can use any method to create this token)
    $resetToken = bin2hex(random_bytes(16)); // Example; you can choose your own method
    
    // Store the token in your database (create a table for this)
    $query = "INSERT INTO password_reset_tokens (email, token, created_at) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $resetToken);
    $stmt->execute();
    
    // Send an email with the reset link to the user's email address
    $resetLink = "localhost/fac_recruit/fac_forgotpwd/main.html?token=" . $resetToken;
    $subject = "Password Reset";
    $message = "Click the following link to reset your password: $resetLink";
    $headers = "From: your_email@example.com";

    mail($email, $subject, $message, $headers);

    // Redirect the user to a confirmation page
    header('Location: reset_request_confirmation.php');
    exit();
}
?>
