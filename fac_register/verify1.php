<?php
include '../config.php'; // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $verificationToken = $_GET['token'];

    // Check if the token exists in the database
    $tokenCheckQuery = "SELECT email, activate FROM faculty_details WHERE JSON_EXTRACT(activate, '$.activation_token') = '" . mysqli_real_escape_string($conn, $verificationToken) . "'";
    $tokenCheckResult = mysqli_query($conn, $tokenCheckQuery);

    if ($tokenCheckResult && mysqli_num_rows($tokenCheckResult) > 0) {
        $row = mysqli_fetch_assoc($tokenCheckResult);
        $email = $row['email'];
        $activationData = json_decode($row['activate'], true);

        echo '<!DOCTYPE html>';
        echo '<html lang="en">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
        echo '<title>Email Verification</title>';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        echo '</head>';
        echo '<body class="bg-light text-center">';

        if ($activationData && $activationData['activated'] === true) {
            echo '<div class="container mt-5">';
            echo '<h1 class="text-success">Account Already Activated</h1>';
            echo '<p class="lead">You can log in using your credentials.</p>';
            echo '</div>';
        } else {
            // Mark the user as activated
            $updateQuery = "UPDATE faculty_details SET activate = JSON_SET(activate, '$.activated', true) WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
            if (mysqli_query($conn, $updateQuery)) {
                echo '<div class="container mt-5">';
                echo '<h1 class="text-success">Email Verified Successfully</h1>';
                echo '<p class="lead">You can now log in.</p>';
                echo '<p class="lead">You can log in <a href="https://localhost/fac_recruit/fac_login/main.html">here</a>.</p>';
                echo '</div>';
            } else {
                echo '<div class="container mt-5">';
                echo '<h1 class="text-danger">Error Updating Activation Status</h1>';
                echo '<p class="lead">Please contact support for assistance.</p>';
                echo '</div>';
            }
        }

        echo '</body>';
        echo '</html>';
    } else {
        echo 'Invalid token or user not found. Please check your activation link.';
    }
} else {
    echo 'Invalid request.';
}

mysqli_close($conn);
?>
