<?php
// Include necessary files for database connection
include_once('../config.php'); // Replace with your actual database connection file
session_start();
// Initialize variables for messages and email
$success_message = '';
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the passwords
    $password = $_POST["password"];
    $rePassword = $_POST["re_password"];

    if ($password == $rePassword) {
        // Passwords match, proceed with the update
        $email = $_SESSION['email']; // Retrieve the email from the session

        // Update the faculty_details table with the new password and reset token
        $updateQuery = "UPDATE faculty_details SET password = ?, reset_token = NULL WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ss", $password, $email);

        // Execute the update query
        if ($stmt->execute()) {
            // Password change successful
            $success_message = "Password changed successfully. You can now <a href='../fac_login/main.html'>login</a>.";
        } else {
            // Error updating the database
            $error_message = "Error updating the database. Please try again later.";
        }
    } else {
        // Passwords do not match
        $error_message = "Passwords do not match. Please try again.";
    }
} else {
    // Redirect to the login page or another appropriate page
    header("Location: ../fac_login/main.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Password Change</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if (!empty($success_message)) : ?>
                            <h4 class="card-title text-success">Password Change Success</h4>
                            <p class="card-text">
                                <?php echo $success_message; ?>
                            </p>
                        <?php else : ?>
                            <h4 class="card-title text-danger">Password Change Error</h4>
                            <p class="card-text">
                                <?php echo $error_message; ?>
                            </p>
                            <a href="../fac_login/main.html" class="btn btn-primary">Go back to Login</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>

</html>
