<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
    $activationToken = $_GET['token'];

    // Query the database to find the user with the provided activation token
    $sql = "SELECT * FROM fac_recruit WHERE JSON_EXTRACT(activation_info, '$.activation_token') = '" . mysqli_real_escape_string($conn, $activationToken) . "'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (!$user['activated']) {
            // Mark the user as activated in the database
            $updateSql = "UPDATE your_table_name SET activation_info = JSON_SET(activation_info, '$.activated', true) WHERE JSON_EXTRACT(activation_info, '$.activation_token') = '" . mysqli_real_escape_string($conn, $activationToken) . "'";
            if (mysqli_query($conn, $updateSql)) {
                // Activation successful
                echo "Your account has been successfully activated. You can now log in.";
            } else {
                echo "Activation failed. Please try again or contact support.";
            }
        } else {
            echo "Your account has already been activated. You can log in.";
        }
    } else {
        echo "Invalid activation token. Please check the link or contact support.";
    }
} else {
    echo "Invalid request. Please use the activation link sent to your email.";
}
?>
