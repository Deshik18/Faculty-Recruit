<?
$activationCode = md5(uniqid(rand(), true));

echo

// Insert user into the database
$query = "INSERT INTO users (username, email, password, activation_code) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$username, $email, $hashedPassword, $activationCode]);
$subject = "Activate Your Account";
$message = "Hello $username,\n\nThank you for signing up! To activate your account, please click on the following link:\n\n";
$message .= "localhost/fac_recruit/activate.php?code=$activationCode\n\n";
$message .= "If you can't click on the link, copy and paste the following activation code: $activationCode\n\n";
$message .= "Thank you,\nYour Website Team";

mail($email, $subject, $message);

?>
