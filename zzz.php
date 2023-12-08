<?php
// Include your database connection or use any database connection method you prefer.
include('config.php'); // Change to your actual database connection file

// Start the session
session_start();

// Retrieve data from the database
$sql = "SELECT * FROM faculty_details WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Database Values</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Database Values</h2>

    <?php
    if ($row) {
        echo '<h3>Personal Details:</h3>';
        echo '<ul>';
        foreach ($row as $key => $value) {
            echo "<li><strong>$key:</strong> $value</li>";
        }
        echo '</ul>';
    } else {
        echo '<div class="alert alert-warning" role="alert">No data found in the database for the given email.</div>';
    }
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
 