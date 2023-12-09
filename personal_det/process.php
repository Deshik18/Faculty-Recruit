<?php
// Include your database connection or use any database connection method you prefer.
include('../config.php'); // Change to your actual database connection file
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['adv_num'] = $_POST['adv_num'];
    $_SESSION['dept'] = $_POST['dept'];
    $_SESSION['fname'] = $_POST['$fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['cast'] = $_POST['cast'];
    // Retrieve form data
    $adv_num = $_POST['adv_num'];
    $ref_num = $_POST['ref_num'];
    $post = $_POST['post'];
    $dept = $_POST['dept'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $mstatus = $_POST['mstatus'];
    $cast = $_POST['cast'];
    $id_proof = $_POST['id_proof'];
    $father_name = $_POST['father_name'];
    $cadd = $_POST['cadd'];
    $cadd1 = $_POST['cadd1'];
    $cadd2 = $_POST['cadd2'];
    $cadd3 = $_POST['cadd3'];
    $cadd4 = $_POST['cadd4'];
    $padd = $_POST['padd'];
    $padd1 = $_POST['padd1'];
    $padd2 = $_POST['padd2'];
    $padd3 = $_POST['padd3'];
    $padd4 = $_POST['padd4'];
    $mobile = $_POST['mobile'];
    $mobile_2 = $_POST['mobile_2'];
    $email_2 = $_POST['email_2'];
    $landline = $_POST['landline'];

    // Create JSON objects for different parts of the form
    $application_details = json_encode([
        'adv_num' => $adv_num,
        'ref_num' => $ref_num,
        'post' => $post,
        'dept' => $dept
    ]);

    $per_det = json_encode([
        'fname' => $fname,
        'mname' => $mname,
        'lname' => $lname,
        'nationality' => $nationality,
        'dob' => $dob,
        'gender' => $gender,
        'mstatus' => $mstatus,
        'cast' => $cast,
        'id_proof' => $id_proof,
        'father_name' => $father_name
    ]);

    $cadd_det = json_encode([
        'street' => $cadd,
        'city' => $cadd1,
        'state' => $cadd2,
        'country' => $cadd3,
        'zip' => $cadd4
    ]);

    $padd_det = json_encode([
        'street' => $padd,
        'city' => $padd1,
        'state' => $padd2,
        'country' => $padd3,
        'zip' => $padd4
    ]);

    $contact_det = json_encode([
        'mobile' => $mobile,
        'mobile_2' => $mobile_2,
        'email_2' => $email_2,
        'landline' => $landline
    ]);

    // Perform any additional processing or validation as needed

    // Perform database insertion
    $query = "UPDATE faculty_details SET application_details = ?, per_det = ?, cadd_det = ?, padd_det = ?, contact_det = ? WHERE email = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ssssss", $application_details, $per_det, $cadd_det, $padd_det, $contact_det, $_SESSION['email']);

    if ($stmt->execute()) {
        // Data has been successfully inserted into the database
        $selected_department = strtoupper($dept); // Convert department name to uppercase
        $name_email_cat = strtoupper($fname . '_' . $lname . '_' . $_SESSION['email'] . '_' . $cast);

        $photo_upload_dir = '../' . $adv_num . '/' . $selected_department . '/' . $name_email_cat . '/';
    
        if (!file_exists($photo_upload_dir)) {
            mkdir($photo_upload_dir, 0777, true);
        }
    
        $photo_file_type = strtolower(pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION)); // Get the file type from the uploaded file
        $photo_file = $photo_upload_dir . 'photo.' . $photo_file_type; // Define $photo_file here
    
        if (getimagesize($_FILES['userfile']['tmp_name']) === false) {
            die('Invalid file. Please upload a valid image.');
        } elseif ($_FILES['userfile']['size'] > 1000000) {
            die('File is too large. Please upload an image smaller than 1 MB.');
        } elseif ($photo_file_type !== 'jpg' && $photo_file_type !== 'jpeg') {
            die('Only JPG and JPEG images are allowed.');
        }
    
        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $photo_file)) {
            // The photo file has been successfully uploaded
    
            $id_proof_upload_dir = '../' . $adv_num . '/' . $selected_department . '/' . $name_email_cat . '/';
    
            if (!file_exists($id_proof_upload_dir)) {
                mkdir($id_proof_upload_dir, 0777, true);
            }
    
            $id_proof_file = $id_proof_upload_dir . 'idproof.' . $photo_file_type;
    
            if (move_uploaded_file($_FILES['userfile2']['tmp_name'], $id_proof_file)) {
                // Data and files uploaded successfully
                header('Location: ../acad_det/main.php');
                exit();
            } else {
                die('Error uploading the ID proof file.');
            }
        } else {
            die('Error uploading the image. Data entered successfully.');
        }
    } else {
        die('Error inserting data into the database.');
    }    
} else {
    die('Invalid request.');
}
?>
