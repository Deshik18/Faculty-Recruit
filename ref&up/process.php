<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_department = strtoupper($_SESSION['dept']);
    $name_email_cat = strtoupper($_SESSION['fname'] . '_' . $_SESSION['lname'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
    $uploads_dir = '../' . $_SESSION['adv_num'] . '/' . $selected_department . '/' . $name_email_cat . '/';
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }    
    $file_fields = [
        'userfile7' => 'research_paper.pdf',
        'userfile'  => 'phd_certificate.pdf',
        'userfile1' => 'pg_documents.pdf',
        'userfile2' => 'ug_documents.pdf',
        'userfile3' => 'hsc_documents.pdf',
        'userfile4' => 'ssc_documents.pdf',
        'userfile9' => 'payslip.pdf',
        'userfile10' => 'noc.pdf',
        'userfile8' => 'postphd_certificate',
        'userfile6' => 'misc.pdf',
        'userfile5' => 'signature.jpg',
        // ... add other mappings for the rest of the fields
    ];

    foreach ($file_fields as $field => $newFileName) {
        if ($_FILES[$field]['error'] == 0) {
            $file_type = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
            $file_path = $uploads_dir . $newFileName; // Use the mapped file name
            $sql = "UPDATE faculty_details SET refrees = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $jsonFileInfo, $email);
            if (move_uploaded_file($_FILES[$field]['tmp_name'], $file_path)) {
                
            }else {
            die('Error uploading ' . $field . ' file.');
            }
        }
    }
    $ref = array();
    if(isset($_POST['referee_name'])){
        for ($i = 0; $i < count($_POST['referee_name']); $i++) {
            $qemp = array(
            'name' => $_POST['referee_name'][$i],
            'position' => $_POST['referee_position'][$i],
            'association' => $_POST['referee_association'][$i],
            'institution' => $_POST['referee_institution'][$i],
            'email' => $_POST['referee_email'][$i],
            'contact'=> $_POST['referee_contact'][$i],
            );
            $ref[] = $qemp;
        }
    }
    $ref_json = json_encode($ref);
    $update = "UPDATE faculty_details set refrees = ? WHERE email = ? ";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ss", $ref_json, $_SESSION['email']);
    if ($stmt->execute()) {
        header("Location: ../zzz.php");
        exit();
    } else {
        echo 'Some Error Occurred: ' . $stmt->error;
    }
}   
?>
