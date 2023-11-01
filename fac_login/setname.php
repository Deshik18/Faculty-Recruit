<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    
    // Query the database to fetch the first name and last name based on the user's email
    $sql = "SELECT * FROM faculty_details WHERE email = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $fn_ln_cast = json_decode($row['fn_ln_cast'], true);
            $doa = $row['doa'];
            // Extract the first name and last name
            $first_name = $fn_ln_cast['first_name'];
            $last_name = $fn_ln_cast['last_name'];
            $cast = $fn_ln_cast['cast'];
            // Set the first name and last name as session variables
            $_SESSION['first_name'] = $first_name;
            $_SESSION['last_name'] = $last_name;
            $_SESSION['doa'] = $doa;
            $_SESSION['cast'] = $cast;
            header('Location: ../personal_det/main.php');
            exit();
        }else{
            echo 'Error 1';
        }
    }else{
        echo 'Error 2';
    }
}else{
    echo 'Error 3';
}

?>
