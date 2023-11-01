<?php
include('../config.php'); // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Check if the provided email exists in your database
    $query = "SELECT email FROM faculty_details WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a unique reset token
        $resetToken = bin2hex(random_bytes(16));

        // Store the token in your database
        $updateQuery = "UPDATE faculty_details SET reset_token = ? WHERE email = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ss", $resetToken, $email);
        $updateStmt->execute();

        // Send an email with the reset link to the user's email address
        $resetLink = "localhost/fac_forgotpwd/checking.php?token=" . $resetToken;
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: $resetLink";
        $headers = "From: your_email@example.com";

        if (mail($email, $subject, $message, $headers)) {
            // Redirect the user to a confirmation page
            header('Location: ../fac_login/main.html');
            exit();
        } else {
            echo "Failed to send the password reset email. Please try again later.";
        }
    } else {
        echo "Invalid email. Please check your email and try again.";
    }
}
?>
