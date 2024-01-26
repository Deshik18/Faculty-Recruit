<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

session_start(); // Start a PHP session

// Initialize error and success messages
$errorMsg = '';
$successMsg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cast = $_POST['cast'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    // Check if password and re_password match
    if ($password !== $re_password) {
        $errorMsg = 'Passwords do not match.';
    } else {
        // Check if the email already exists in the database
        $emailCheckQuery = "SELECT COUNT(*) as count FROM faculty_details WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);
        $emailCount = mysqli_fetch_assoc($emailCheckResult)['count'];

        if ($emailCount > 0) {
            $errorMsg = 'Email already exists. Please use a different email address.';
        } else {
            // Combine first name, last name, and cast into a JSON object
            $userCountQuery = "SELECT COUNT(*) as count FROM faculty_details";
            $userCountResult = mysqli_query($conn, $userCountQuery);
            $userCount = mysqli_fetch_assoc($userCountResult)['count'];

            // Increment the user count for the new user
            $newRefNum = $userCount + 1;

            // Format the new ref_num to be a 10-digit number (padded with zeros)
            $formattedRefNum = str_pad($newRefNum, 10, '0', STR_PAD_LEFT);

            // Combine first name, last name, and cast into a JSON object
            $fn_ln_cast = json_encode(array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'cast' => $cast,
                'ref_num' => $formattedRefNum
            ));

            // Get the current date in the desired format (e.g., DD/MM/YYYY)
            $currentDate = date("Y-m-d"); // Format: 'YYYY-MM-DD'

            // Generate a unique activation token
            $verificationToken = bin2hex(random_bytes(16)); // You can choose your own method.

            // Prepare and execute the SQL query to insert data into the database
            $sql = "INSERT INTO faculty_details (fn_ln_cast, email, password, activate, doa) VALUES ('" . mysqli_real_escape_string($conn, $fn_ln_cast) . "', '" . mysqli_real_escape_string($conn, $email) . "', '" . mysqli_real_escape_string($conn, $password) . "', '{\"activation_token\":\"$verificationToken\", \"activated\":false}', '$currentDate')";

            if (mysqli_query($conn, $sql)) {
                // Send a verification email via Gmail SMTP
                require '../PHPMailer.php';
                require '../SMTP.php';
                require '../Exception.php';

                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->Username = 'deshiksingamsetty@gmail.com'; // Your Gmail address
                $mail->Password = 'akcxgetdhwoqsssd';

                $mail->setFrom('deshiksingam@gmail.com', 'Faculty Recruit');
                $mail->addAddress($email);
                $mail->Subject = 'Verify Your Email Address';
                $verificationLink = 'http://localhost/fac_recruit/fac_register/verify1.php?token=' . $verificationToken;
                $mail->Body = 'Click the following link to verify your email address: ' . $verificationLink;

                try {
                    if ($mail->send()) {
                        $successMsg = 'Registration successful! Please check your email to verify your account.';
                    } else {
                        $errorMsg = 'Email sending failed. Please try again.';
                    }
                } catch (Exception $e) {
                    $errorMsg = 'Email sending failed: ' . $e->getMessage();
                }
            } else {
                $errorMsg = 'Problem in registration. Please try again.';
            }
        }
    }
}

// Display the messages in the HTML page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Faculty Register | IIT Patna</title>
	<link rel="stylesheet" type="text/css" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="../bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap-datepicker.css">
	<script type="text/javascript" src="../jquery.js"></script>
	<script type="text/javascript" src="../bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap-datepicker.js"></script>

	<link href="../files/css" rel="stylesheet"> 
	<link href="../files/css(1)" rel="stylesheet"> 
	<link href="../files/css(2)" rel="stylesheet"> 
	<link href="../files/css(3)" rel="stylesheet"> 
	<link href="../files/css(4)" rel="stylesheet"> 
	<link rel="preconnect" href="https://fonts.gstatic.com/">
	<link href="../files/css2" rel="stylesheet">
    <style>

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    if (!empty($errorMsg)) {
        echo '<div class="alert alert-danger">' . $errorMsg . '</div>';
    } elseif (!empty($successMsg)) {
        echo '<div class="alert alert-success">' . $successMsg . '</div>';
    }
    ?>
    <a href="main.html" class="btn btn-primary">Go Back</a>
</div>

</body>
</html>
