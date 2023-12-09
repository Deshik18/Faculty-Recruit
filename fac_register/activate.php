<?php
include('../config.php'); // Change to your actual database connection file

if (isset($_GET['token'])) {
    $activationToken = $_GET['token'];

    // Retrieve user details based on the activation token
    $sql = "SELECT * FROM faculty_details WHERE activate LIKE '%\"activation_token\":\"$activationToken\"%'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Check if the user is not already activated
        if (!$user['is_activated']) {
            // Update the 'is_activated' status in the database
            $updateSql = "UPDATE faculty_details SET is_activated = 1, activate = '{\"activation_token\":\"$activationToken\", \"activated\":true}' WHERE id = {$user['id']}";
            if (mysqli_query($conn, $updateSql)) {
                // Redirect to the main.html page
                header("Location: ../fac_login/main.html");
                exit();
            } else {
                echo "Failed to activate the account. Please contact support.";
            }
        } else {
            echo "Account is already activated.";
        }
    } else {
        echo "Invalid activation token.";
    }
} else {
    echo "Invalid request. Please provide an activation token.";
}

mysqli_close($conn);
?>
