<?php
include '../config.php';
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_proj = array();
    if (isset($_POST["agency"])) {
    for ($i = 0; $i < count($_POST['agency']); $i++) {
        $project = array(
            'agency' => $_POST['agency'][$i],
            'title' => $_POST['stitle'][$i],
            'amount' => $_POST['samount'][$i],
            'period' => $_POST['speriod'][$i],
            'role' => $_POST['s_role'][$i],
            'status' => $_POST['s_status'][$i],
        );
        $s_proj[] = $project;
    }}

    // Handle posted data for awards
    $awards = array();
    if (isset($_POST['award_nature'])) {
    for ($i = 0; $i < count($_POST['award_nature']); $i++) {
        $award = array(
            'nature' => $_POST['award_nature'][$i],
            'organization' => $_POST['award_org'][$i],
            'year' => $_POST['award_year'][$i],
        );
        $awards[] = $award;
    }}

    // Handle posted data for professional training
    $prof_trg = array();
    if (isset($_POST['trg'])) {
    for ($i = 0; $i < count($_POST['trg']); $i++) {
        $training = array(
            'name' => $_POST['trg'][$i],
            'organization' => $_POST['porg'][$i],
            'year' => $_POST['pyear'][$i],
            'duration' => $_POST['pduration'][$i],
        );
        $prof_trg[] = $training;
    }
    }

    // Handle posted data for professional society memberships
    $membership = array();
    if (isset($_POST['mname'])) {
    for ($i = 0; $i < count($_POST['mname']); $i++) {
        $society = array(
            'name' => $_POST['mname'][$i],
            'status' => $_POST['mstatus'][$i],
        );
        $membership[] = $society;
    }}

    // Handle posted data for consultancy projects
    $consultancy = array();
    if (isset($_POST['c_org'])) {
    for ($i = 0; $i < count($_POST['c_org']); $i++) {
        $project = array(
            'organization' => $_POST['c_org'][$i],
            'title' => $_POST['ctitle'][$i],
            'amount' => $_POST['camount'][$i],
            'period' => $_POST['cperiod'][$i],
            'role' => $_POST['c_role'][$i],
            'status' => $_POST['c_status'][$i],
        );
        $consultancy[] = $project;
    }}

    $s_proj_json = json_encode($s_proj);
    $awards_json = json_encode($awards);
    $prof_trg_json = json_encode($prof_trg);
    $membership_json = json_encode($membership);
    $consultancy_json = json_encode($consultancy);

    $updateQuery = "UPDATE faculty_details SET s_proj = ?, awards = ?, prof_trg = ?, membership = ?, consultancy = ? WHERE email = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssss", $s_proj_json, $awards_json, $prof_trg_json, $membership_json, $consultancy_json, $_SESSION['email']);
    if ($stmt->execute()) {
        // Update successful
        // Redirect to a success page or perform other actions
        header("Location: ../acad_exp/main.php");
        exit();
    }else{
        echo 'Some Error Ocurred'. $stmt->error;
    }
} else {
    // Handle cases where the form was not submitted
    echo "Form was not submitted.";
}
?>
