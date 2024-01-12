<?php
session_start();

// Check if $_SESSION['email'] is not set, redirect to login page
if (!isset($_SESSION['email'])) {
    header('Location: fac_login/main.html');
    exit();
}

// Include your database connection file
include 'config.php';

// Assuming $_SESSION['email'] contains the email of the faculty member
$email = $_SESSION['email'];

// Use a prepared statement to avoid SQL injection
$query = "SELECT submitted FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch data as an associative array
    $facultyDetails = $result->fetch_assoc();

    // Close the statement
    $stmt->close();

    // Check the submitted status and redirect accordingly
    if ($facultyDetails['submitted'] == 1) {
        header('Location: fin_sub/main.php');
        exit();
    } elseif ($facultyDetails['submitted'] == 2) {
        header('Location: finalpdf.php');
        exit();
    }
} else {
    // Handle the case where the statement preparation failed
    echo "Error in prepared statement: " . $conn->error;
}

$conn->close();
?>
