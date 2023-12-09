<?php
include '../config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted for PhD theses
    if (isset($_POST['phd_scholar'])) {
        $phd_scholar = $_POST['phd_scholar'];
        $phd_thesis = $_POST['phd_thesis'];
        $phd_role = $_POST['phd_role'];
        $phd_ths_status = $_POST['phd_ths_status'];
        $phd_ths_year = $_POST['phd_ths_year'];

        // Create an array to store PhD theses data
        $phd_data = [];

        // Loop through each row and add data to the array
        for ($i = 0; $i < count($phd_scholar); $i++) {
            $phd_data[] = [
                'scholar' => $phd_scholar[$i],
                'thesis' => $phd_thesis[$i],
                'role' => $phd_role[$i],
                'status' => $phd_ths_status[$i],
                'year' => $phd_ths_year[$i],
            ];
        }

        // Convert the array to JSON
        $phd_data_json = json_encode($phd_data);
    } else {
        // Set an empty JSON string if no data is provided
        $phd_data_json = '[]';
    }

    // Check if the form was submitted for MTech theses
    if (isset($_POST['pg_scholar'])) {
        $mtech_scholar = $_POST['pg_scholar'];
        $mtech_thesis = $_POST['pg_thesis'];
        $mtech_role = $_POST['pg_role'];
        $mtech_status = $_POST['pg_ths_status'];
        $mtech_ths_year = $_POST['pg_ths_year'];

        // Create an array to store MTech theses data
        $mtech_data = [];

        // Loop through each row and add data to the array
        for ($i = 0; $i < count($mtech_scholar); $i++) {
            $mtech_data[] = [
                'scholar' => $mtech_scholar[$i],
                'thesis' => $mtech_thesis[$i],
                'role' => $mtech_role[$i],
                'status' => $mtech_status[$i],
                'year' => $mtech_ths_year[$i],
            ];
        }

        // Convert the array to JSON
        $mtech_data_json = json_encode($mtech_data);
    } else {
        // Set an empty JSON string if no data is provided
        $mtech_data_json = '[]';
    }

    // Check if the form was submitted for BTech theses
    if (isset($_POST['ug_scholar'])) {
        $btech_scholar = $_POST['ug_scholar'];
        $btech_thesis = $_POST['ug_thesis'];
        $btech_role = $_POST['ug_role'];
        $btech_status = $_POST['ug_ths_status'];
        $btech_ths_year = $_POST['ug_ths_year'];

        // Create an array to store BTech theses data
        $btech_data = [];

        // Loop through each row and add data to the array
        for ($i = 0; $i < count($btech_scholar); $i++) {
            $btech_data[] = [
                'scholar' => $btech_scholar[$i],
                'thesis' => $btech_thesis[$i],
                'role' => $btech_role[$i],
                'status' => $btech_status[$i],
                'year' => $btech_ths_year[$i],
            ];
        }

        // Convert the array to JSON
        $btech_data_json = json_encode($btech_data);
    } else {
        // Set an empty JSON string if no data is provided
        $btech_data_json = '[]';
    }

    // Example: Update the database with the JSON data
    $stmt = $conn->prepare("UPDATE faculty_details SET phd_thesis = ?, mtech_thesis = ?, btech_thesis = ? WHERE email = ?");
    $stmt->bind_param("ssss", $phd_data_json, $mtech_data_json, $btech_data_json, $_SESSION['email']);

    if ($stmt->execute()) {
        header("Location: ../rel_info/main.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }
} else {
    echo "Form was not submitted.";
}
?>
