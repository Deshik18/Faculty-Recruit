<?php
// Include necessary files for database connection
include_once('../config.php'); // Replace with your actual database connection file
session_start();
// Initialize variables for messages and email
$message = '';
$email = '';

// Check if the token is provided in the URL
if (isset($_GET['token'])) {
    $resetToken = $_GET['token'];

    // Retrieve the user with the given reset token
    $selectQuery = "SELECT * FROM faculty_details WHERE reset_token = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $resetToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Valid reset token, store email in session and redirect to main2.html
        $_SESSION['email'] = $user['email'];
        header("Location: main2.html");
        exit();
    } else {
        $message = "Invalid reset token.";
    }
} else {
    $message = "Reset token not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <title>Reset Password</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4">Reset Password</h4>
                        <p class="card-text">
                            <?php echo $message; ?>
                        </p>
                        <!-- Display a message or instructions if needed -->
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
