<?php
include 'config.php';

$emailToCheck = 'deshiksingamsetty5@gmail.com'; // Change to the email you want to check

$query = "SELECT activate FROM faculty_details WHERE email='" . mysqli_real_escape_string($conn, $emailToCheck) . "'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $activationData = json_decode($row['activate'], true);

    if ($activationData) {
        echo 'Activation Data: <pre>' . print_r($activationData, true) . '</pre>';
    } else {
        echo 'No activation data found for the email.';
    }
} else {
    echo 'Error executing the query: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>
