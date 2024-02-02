<?php
// Include TCPDF library
require_once('TCPDF-main/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('Admin');
$pdf->SetAuthor('Admin');
$pdf->SetTitle('User Application');
$pdf->SetSubject('Final Form');

// Add a page
$pdf->AddPage();
include 'config.php';
// Include 'finalpdf.php'
include 'finalpdf.php';
// Get the buffered output
$html = ob_get_clean();

if (!isset($_SESSION['adv_num']) || !isset($_SESSION['dept']) || !isset($_SESSION['fname']) || !isset($_SESSION['lname'])) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the email from the session
    $sessionEmail = $_SESSION['email'];

    // Fetch values from the database
    $sql = "SELECT application_details, per_det FROM faculty_details WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $sessionEmail);
        $stmt->execute();
        $stmt->bind_result($applicationDetails, $perDetails);

        if ($stmt->fetch()) {
            $detailsArray = json_decode($applicationDetails, true);

            // Update session variables
            $_SESSION['adv_num'] = $detailsArray['adv_num'];
            $_SESSION['dept'] = $detailsArray['dept'];

            $perDetailsArray = json_decode($perDetails, true);

            $_SESSION['fname'] = $perDetailsArray['fname'];
            $_SESSION['lname'] = $perDetailsArray['lname'];
        }

        $stmt->close();
    }
}

// Assuming $_SESSION['email'] contains the email of the faculty member
$email = $_SESSION['email'];

// Use a prepared statement to avoid SQL injection
$updateQuery = "UPDATE faculty_details SET submitted = '2' WHERE email = ?";
$stmtUpdate = $conn->prepare($updateQuery);
$stmtUpdate->bind_param("s", $email);

if ($stmtUpdate->execute()) {
    // Query executed successfully

    // Now, let's fetch the faculty details
    $selectQuery = "SELECT * FROM faculty_details WHERE email = ?";
    $stmtSelect = $conn->prepare($selectQuery);

    if ($stmtSelect) {
        $stmtSelect->bind_param("s", $email);
        $stmtSelect->execute();

        // Get the result
        $result = $stmtSelect->get_result();

        // Fetch data as an associative array
        $facultyDetails = $result->fetch_assoc();

        // Close the statement
        $stmtSelect->close();
    } else {
        // Handle the case where the statement preparation failed
        echo "Error in prepared statement: " . $conn->error;
    }
}

$stmtUpdate->close();
$application_details = json_decode($facultyDetails["application_details"], true) ?? [];
    
$selected_department = strtoupper($application_details["dept"]);
$name_email_cat = strtoupper($_SESSION["first_name"] . "_" . $_SESSION["last_name"] . "_" . $_SESSION["email"] . "_" . $_SESSION["cast"]);
$uploadsDir = $application_details["adv_num"] . "/" . $selected_department . "/" . $application_details["post"] . "/" . $_SESSION["cast"] . "/" . $application_details["ref_num"] . "_" . $name_email_cat . "_supportingdocs/";

$pdf->AddPage();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output($uploadsDir . 'application.pdf', 'F');

// Display a message or redirect the user
echo 'PDF generated and saved successfully!';
