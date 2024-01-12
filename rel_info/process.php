<?php
// process.php
include '../config.php';
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $researchStatement = filter_input(INPUT_POST, 'research_statement', FILTER_SANITIZE_STRING);
    $teachingStatement = filter_input(INPUT_POST, 'teaching_statement', FILTER_SANITIZE_STRING);
    $relInfo = filter_input(INPUT_POST, 'rel_in', FILTER_SANITIZE_STRING);
    $profService = filter_input(INPUT_POST, 'prof_serv', FILTER_SANITIZE_STRING);
    $journalPublications = filter_input(INPUT_POST, 'jour_details', FILTER_SANITIZE_STRING);
    $conferencePublications = filter_input(INPUT_POST, 'conf_details', FILTER_SANITIZE_STRING);
    
    // Get the email from the session
    $sessionEmail = $_SESSION['email'];

    // Check if the database connection is successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "UPDATE faculty_details
            SET research_statement = ?,
                teaching_statement = ?,
                rel_info = ?,
                prof_service = ?,
                journal_publications = ?,
                conference_publications = ?
            WHERE email = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssssss", $researchStatement, $teachingStatement, $relInfo, $profService, $journalPublications, $conferencePublications, $sessionEmail);

    if ($stmt->execute()) {
        header("Location: ../ref&up/main.php");
    } else {
        // Log the error instead of displaying it to the user
        error_log("Error updating database: " . $stmt->error);
        // Redirect to an error page or display a generic error message
        header("Location: ../error-page.php");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
