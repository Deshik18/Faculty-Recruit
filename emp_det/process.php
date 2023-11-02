<?php
// Start the session (if you haven't already)
session_start();

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
        'pres_emp_position' => $pres_emp_position,
        'pres_emp_employer' => $pres_emp_employer,
        'pres_status' => $pres_status,
        'pres_emp_doj' => $pres_emp_doj,
        'pres_emp_dol' => $pres_emp_dol,
        'pres_emp_duration' => $pres_emp_duration,
    ));

    $emp_hist = array();
    for ($i = 0; $i < count($_POST['position']); $i++) {
        $qemployments = array(
            'position' => $_POST['position'][$i],
            'employer' => $_POST['employer'][$i],
            'doj' => $_POST['doj'][$i],
            'dol' => $_POST['dol'][$i],
            'exp+duration' => $_POST['exp_duration'][$i],
        );
        $emp_hist[] = $qemployments;
    }

    // Access and save additional details for other sections here...
    // You can access them using $_POST superglobal as shown above.

    // Process the data as needed, e.g., save it to the database

    // Redirect to the next page after processing
    header("Location: next_page.php");
    exit();
}
