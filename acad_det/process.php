<?php
// Start the session (if you haven't already)
session_start();
include '../config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $college_phd = $_POST['college_phd'];
    $stream = $_POST['stream'];
    $supervisor = $_POST['supervisor'];
    $yoj_phd = $_POST['yoj_phd'];
    $dod_phd = $_POST['dod_phd'];
    $doa_phd = $_POST['doa_phd'];
    $phd_title = $_POST['phd_title'];

    $pg_degree = $_POST['pg_degree'];
    $pg_college = $_POST['pg_college'];
    $pg_subjects = $_POST['pg_subjects'];
    $pg_yoj = $_POST['pg_yoj'];
    $pg_yog = $_POST['pg_yog'];
    $pg_duration = $_POST['pg_duration'];
    $pg_perce = $_POST['pg_perce'];
    $pg_rank = $_POST['pg_rank'];

    $ug_degree = $_POST['ug_degree'];
    $ug_college = $_POST['ug_college'];
    $ug_subjects = $_POST['ug_subjects'];
    $ug_yoj = $_POST['ug_yoj'];
    $ug_yog = $_POST['ug_yog'];
    $ug_duration = $_POST['ug_duration'];
    $ug_perce = $_POST['ug_perce'];
    $ug_rank = $_POST['ug_rank'];

    $hsc_ssc = $_POST['hsc_ssc']; // This will be an array
    $school = $_POST['school'];   // This will be an array
    $passing_year = $_POST['passing_year']; // This will be an array
    $s_perce = $_POST['s_perce']; // This will be an array
    $s_rank = $_POST['s_rank'];   // This will be an array

    // Build JSON representations for each educational qualification
    $phd_details = json_encode(array(
        'college' => $college_phd,
        'stream' => $stream,
        'supervisor' => $supervisor,
        'yoj' => $yoj_phd,
        'dod' => $dod_phd,
        'doa' => $doa_phd,
        'title' => $phd_title,
    ));

    $pg_details = json_encode(array(
        'degree' => $pg_degree,
        'college' => $pg_college,
        'subjects' => $pg_subjects,
        'yoj' => $pg_yoj,
        'yog' => $pg_yog,
        'duration' => $pg_duration,
        'percentage' => $pg_perce,
        'rank' => $pg_rank,
    ));

    $ug_details = json_encode(array(
        'degree' => $ug_degree,
        'college' => $ug_college,
        'subjects' => $ug_subjects,
        'yoj' => $ug_yoj,
        'yog' => $ug_yog,
        'duration' => $ug_duration,
        'percentage' => $ug_perce,
        'rank' => $ug_rank,
    ));

    $sch_details = json_encode(array(
        'hsc_ssc' => $hsc_ssc,
        'school' => $school,
        'passing_year' => $passing_year,
        'percentage' => $s_perce,
        'rank' => $s_rank,
    ));

    $additional_qualifications = array();
    for ($i = 0; $i < count($_POST['add_degree']); $i++) {
        $qualification = array(
            'degree' => $_POST['add_degree'][$i],
            'college' => $_POST['add_college'][$i],
            'stream' => $_POST['add_subjects'][$i],
            'yoj' => $_POST['add_yoj'][$i],
            'yoc' => $_POST['add_yoc'][$i],
            'duration' => $_POST['add_duration'][$i],
            'percentage' => $_POST['add_perce'][$i],
            'division' => $_POST['add_rank'][$i], // Update the key to 'division'
        );
        $additional_qualifications[] = $qualification;
    }

    // Encode the array as JSON
    $additional_qualifications_json = json_encode($additional_qualifications);

    $var = 1;

    // Now you can update your database with these JSON values
    $updateQuery = "UPDATE faculty_details SET acad_bool = ?, phd_det = ?, pg_det = ?, ug_det = ?, sch_det = ?, additional_qualifications = ? WHERE email = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("issssss", $var, $phd_details, $pg_details, $ug_details, $sch_details, $additional_qualifications_json, $_SESSION['email']);


    if ($stmt->execute()) {
        // Update successful
        // Redirect to a success page or perform other actions
        header('Location: ../emp_det/main.php');
        exit();
    }else{
        echo 'Some Error Ocurred'. $stmt->error;
    }
} else {
    // If the form was not submitted via POST, handle the case accordingly
    // For example, display an error message or redirect to an error page
    echo "Form not submitted!";
}
