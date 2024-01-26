<?php
// Include necessary files for database connection and email sending
include_once('../config.php'); // Replace with your actual database connection file
require '../PHPMailer.php';
require '../SMTP.php';
require '../Exception.php';

// Initialize variables for messages
$message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the email address
    $email = $_POST["email"];

    // Check if the email exists in the database
    $checkQuery = "SELECT * FROM faculty_details WHERE email = ?";
    $stmtCheck = $conn->prepare($checkQuery);
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    // If the email is not found in the database
    if ($result->num_rows == 0) {
        $message = "Email not found in the database. Please enter a valid registered email address.";
    } else {
        // Generate a random reset token
        $resetToken = bin2hex(random_bytes(16));

        // Update the faculty_details table with the reset token
        $updateQuery = "UPDATE faculty_details SET reset_token = ? WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ss", $resetToken, $email);

        // Execute the update query
        if ($stmt->execute()) {
            // Send the password reset email
            $mail = new PHPMailer\PHPMailer\PHPMailer();
            // ... (your existing email configuration code)

            try {
                if ($mail->send()) {
                    $message = "An email with instructions to reset your password has been sent to your registered email address.";
                } else {
                    $message = "Email sending failed. Please try again.";
                }
            } catch (Exception $e) {
                $message = "Email sending failed: " . $e->getMessage();
            }
        } else {
            $message = "Error updating the database. Please try again later.";
        }
    }
} else {
    // Handle the case where the form was not submitted
    header("Location: ../fac_login/main.html"); // Redirect to the login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="../favicon.ico" type="image/x-icon">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bootstrap-datepicker.css">
    <script type="text/javascript" src="../jquery.js"></script>
    <script type="text/javascript" src="../bootstrap.js"></script>
    <script type="text/javascript" src="../bootstrap-datepicker.js"></script>

    <link href="../files/css" rel="stylesheet"> 
    <link href="../files/css(1)" rel="stylesheet"> 
    <link href="../files/css(2)" rel="stylesheet"> 
    <link href="../files/css(3)" rel="stylesheet"> 
    <link href="../files/css(4)" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="../files/css2" rel="stylesheet">
    <!-- Add your custom styles if needed -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            margin-bottom: 15px;
        }

        .card-success {
            border: 1px solid #28a745;
        }

        .card-failure {
            border: 1px solid #dc3545;
        }

        .card-body {
            color: #555;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php
                $cardClass = $message ? 'card-success' : 'card-failure';
                ?>
                <div class="card <?php echo $cardClass; ?>">
                    <div class="card-body">
                        <h4 class="card-title">Password Reset</h4>
                        <p class="card-text">
                            <?php echo $message; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
