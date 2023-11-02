<?php
// Start the session (if you haven't already)
session_start();
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted

    // You can access the posted values like this:
    $pres_emp_position = $_POST['pres_emp_position'];
    $pres_emp_employer = $_POST['pres_emp_employer'];
    $pres_status = $_POST['pres_status'];
    $pres_emp_doj = $_POST['pres_emp_doj'];
    $pres_emp_dol = $_POST['pres_emp_dol'];
    $pres_emp_duration = $_POST['pres_emp_duration'];

    $pres_emp_det = json_encode(array(
        'position' => $pres_emp_position,
        'employer' => $pres_emp_employer,
        'status' => $pres_status,
        'doj' => $pres_emp_doj,
        'dol' => $pres_emp_dol,
        'duration' => $pres_emp_duration,
    ));

    $emp_hist = array();
    if (isset($_POST['position'])) {
        for ($i = 0; $i < count($_POST['position']); $i++) {
            $qemp1 = array(
                'position' => $_POST['position'][$i],
                'org' => $_POST['org'][$i],
                'doj' => $_POST['doj'][$i],
                'dol' => $_POST['dol'][$i],
                'duration' => $_POST['duration'][$i],
            );
            $emp_hist[] = $qemp1;
        }
    }
    $emp_hist_json = json_encode($emp_hist);

    $te_exp = array();
    if (isset($_POST['te_position'])) {
        for ($i = 0; $i < count($_POST['te_position']); $i++) {
            $qemp2 = array(
                'position' => $_POST['te_position'][$i],
                'employer' => $_POST['te_employer'][$i],
                'course' => $_POST['te_course'][$i],
                'ug_pg' => $_POST['te_ug_pg'][$i],
                'no_stu' => $_POST['te_no_stu'][$i],
                'doj' => $_POST['te_doj'][$i],
                'dol' => $_POST['te_dol'][$i],
                'duration' => $_POST['te_duration'][$i],
            );
            $te_exp[] = $qemp2;
        }
    }
    $te_exp_json = json_encode($te_exp);

    $r_exp = array();
    if (isset($_POST['r_exp_position'])) {
        for ($i = 0; $i < count($_POST['r_exp_position']); $i++) {
            $qemp3 = array(
                'position' => $_POST['r_exp_position'][$i],
                'institute' => $_POST['r_exp_institute'][$i],
                'supervisor' => $_POST['r_exp_supervisor'][$i],
                'doj' => $_POST['r_exp_doj'][$i],
                'dol' => $_POST['r_exp_dol'][$i],
                'duration' => $_POST['r_exp_duration'][$i],
            );
            $r_exp[] = $qemp3;
        }
    }
    $r_exp_json = json_encode($r_exp);

    $ind_exp = array();
    if (isset($_POST['ind_org'])) {
        for ($i = 0; $i < count($_POST['ind_org']); $i++) {
            $qemp4 = array(
                'org' => $_POST['ind_org'][$i],
                'work' => $_POST['ind_work'][$i],
                'doj' => $_POST['ind_doj'][$i],
                'dol' => $_POST['ind_dol'][$i],
                'period' => $_POST['period'][$i],
            );
            $ind_exp[] = $qemp4;
        }
    }
    $ind_exp_json = json_encode($ind_exp);

    $area_det = json_encode(array(
        'area_spl' => $_POST['area_spl'],
        'area_rese' => $_POST['area_rese'],
    ));

    // Update the faculty_details table with the new data
    $updateQuery = "UPDATE faculty_details SET pre_emp_det = ?, his_det = ?, te_det = ?, r_det = ?, ind_det = ?, area_det = ? WHERE email = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssss", $pres_emp_det, $emp_hist_json, $te_exp_json, $r_exp_json, $ind_exp_json, $area_det, $_SESSION['email']);

    if ($stmt->execute()) {
        // Update successful
        // Redirect to a success page or perform other actions
        header('Location: ../pub_det/main.php');
        exit();
    } else {
        echo 'Some Error Occurred: ' . $stmt->error;
    }
} else {
    // If the form was not submitted via POST, handle the case accordingly
    // For example, display an error message or redirect to an error page
    echo "Form not submitted!";
}
?>
