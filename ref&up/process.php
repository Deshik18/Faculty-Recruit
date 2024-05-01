<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_department = strtoupper($_SESSION['dept']); // Convert department name to uppercase
    $name_email_cat = strtoupper($_SESSION['first_name'] . '_' . $_SESSION['last_name'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
    $uploads_dir = '../' . $_SESSION['adv_num'] . '/' . $selected_department . '/' . $_SESSION['post'] . '/' . $_SESSION['cast'] . '/' . $_SESSION['ref_num'] . '_' . $name_email_cat . '_supportingdocs/';

    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    $file_fields = [
        'userfile'  => 'PHD_Certificate.pdf',
        'userfile1' => 'PG_Certificate.pdf',
        'userfile2' => 'UG_Certificate.pdf',
        'userfile3' => '12th_HSC_Diploma.pdf',
        'userfile4' => '10th_SSC_Certificate.pdf',
        'userfile9' => 'Payslip.pdf',
        'userfile10' => 'NOC.pdf',
        'userfile8' => '10_Years_Post_PHD_Experience_Certificate.pdf',
        'userfile6' => 'Any_Other_Document.pdf',
        'userfile5' => 'Signature.jpg',
        // ... add other mappings for the rest of the fields
    ];

    $file_fields2 = [
        'userfile7' => 'Research_Paper',
    ];

    foreach ($file_fields2 as $field => $newFileName) {
        $files = $_FILES[$field]; // Get the array of files
        foreach ($files['name'] as $index => $fileName) {
            $file_type = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $file_path = $uploads_dir . $newFileName . '_' . ($index + 1) . '.' . $file_type; // Include index to differentiate multiple files
    
            if ($files['error'][$index] == 0) {
                if (move_uploaded_file($files['tmp_name'][$index], $file_path)) {
                    // File uploaded successfully
                } else {
                    die('Error uploading ' . $field . ' file.');
                }
            }
        }
    }

    foreach ($file_fields as $field => $newFileName) {
        $file_type = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        $file_path = $uploads_dir . $newFileName; // Use the mapped file name

        if ($_FILES[$field]['error'] == 0) {
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $file_path)) {
                // File uploaded successfully
            } else {
                die('Error uploading ' . $field . ' file.');
            }
        }
    }

    $ref = array();
    if (isset($_POST['referee_name'])) {
        for ($i = 0; $i < count($_POST['referee_name']); $i++) {
            $qemp = array(
                'name' => $_POST['referee_name'][$i],
                'position' => $_POST['referee_position'][$i],
                'association' => $_POST['referee_association'][$i],
                'institution' => $_POST['referee_institution'][$i],
                'email' => $_POST['referee_email'][$i],
                'contact' => $_POST['referee_contact'][$i],
            );
            $ref[] = $qemp;
        }
    }
    $ref_json = json_encode($ref);
    $v1 = 1;
    $update = "UPDATE faculty_details set refrees = ?, submitted=? WHERE email = ? ";
    $stmt = $conn->prepare($update);
    $stmt->bind_param('sis', $ref_json, $v1, $_SESSION['email']);
    if ($stmt->execute()) {
        header("Location: ../fin_sub/main.php");
        exit();
    } else {
        echo 'Some Error Occurred: ' . $stmt->error;
    }
}
?>
