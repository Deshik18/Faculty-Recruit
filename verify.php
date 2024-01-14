<?php
require 'config.php'; // Include your database configuration file

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Verify the token in the database
    $sql = "SELECT * FROM users WHERE verification_token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if the user is already verified
        if ($user['verified'] == 0) {
            // Update user status as verified
            $updateSql = "UPDATE users SET verified = 1 WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param('i', $user['id']);
            if ($updateStmt->execute()) {
                // Display a confirmation message
                $message = '<div class="success-message">Email verification successful. You can now log in.</div>';
                $buttonText = 'Click here to login';
            } else {
                $message = 'Email verification failed. Please try again later.';
                $buttonText = '';
            }
        } else {
            $message = '<div class="success-message">Email has already been verified.</div>';
            $buttonText = 'Click here to login';
        }
    } else {
        // Token is not valid
        $message = 'Invalid verification token.';
        $buttonText = '';
    }
} else {
    // Token not provided in the URL
    $message = 'Invalid request.';
    $buttonText = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Style the "Click here to login" button */
.login-button {
    display: block;
    width: 150px; /* Set your desired width */
    margin: 20px auto; /* Center the button horizontally and add space below the message */
    padding: 10px 20px;
    background-color: white; /* Set your desired background color */
    color: #2c3e50; /* Set your desired text color */
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Style the button on hover */
.login-button:hover {
    background-color: #2980b9; /* Change background color on hover */
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
        .success-message {
    background-color: #3498db; /* Green background color */
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 5px;
    margin-top: 5px;
}
</style>
</head>
<body>
    <div class="message-container">
        <div class="message <?php echo ($user['verified'] == 0) ? 'success-message' : 'info-message'; ?>">
            <?php echo $message; ?>
        </div>
        <?php if ($buttonText): ?>
            <a href="login.php" class="login-button"><?php echo $buttonText; ?></a>
        <?php endif; ?>
    </div>
</body>
</html>

