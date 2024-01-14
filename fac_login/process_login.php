<?php
// Start a PHP session (if not already started)
session_start();

// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user's credentials are valid (example query - replace with your database schema)
    $query = "SELECT * FROM faculty_details WHERE email = '" . mysqli_real_escape_string($conn, $email) . "' AND password = '" . mysqli_real_escape_string($conn, $password) . "'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if the user is activated
        $activationData = json_decode($row['activate'], true);

        if ($activationData && $activationData['activated'] === true) {
            // User is activated, proceed with login
            $_SESSION['email'] = $email; // Store the user's email in a session variable
            header('Location: setname.php'); // Redirect to the next step (setname.php in this case)
            exit();
        } else {
            // User is not activated
            $errorMessage = "Your account is not activated. Please check your email for the activation link.";
        }
    } else {
        // Authentication failed
        $errorMessage = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Error</title>
    <style type="text/css">
        body {
            background-color: lightgray;
            padding-top: 50px;
            text-align: center;
        }

        .error-message-container {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            margin: 20px auto;
            max-width: 400px;
        }

        .go-back-link {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($errorMessage)) : ?>
            <div class="error-message-container">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <div class="go-back-link">
            <a href="main.html" class="btn btn-secondary">Go Back</a>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (add them if not already included in your project) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
