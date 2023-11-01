<?php
// Start a PHP session (if not already started)
session_start();

// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // You should perform validation and sanitization of user input here to prevent SQL injection or other security issues.
    // For example, use prepared statements to query the database.

    // Check if the user's credentials are valid (example query - replace with your database schema)
    $sql = "SELECT * FROM faculty_details WHERE email = '" . mysqli_real_escape_string($conn, $email) . "' AND password = '" . mysqli_real_escape_string($conn, $password) . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Authentication successful, set a session variable and redirect to a secure page
        $_SESSION['email'] = $email; // Store the user's email in a session variable
        header('Location: setname.php');
        exit();
    } else {
        // Authentication failed, redirect to the login page with an error message
        header('Location: main.html?error=1'); // You can customize the error handling
        exit();
    }
}
?>
