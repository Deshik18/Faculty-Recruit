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

    // Example: Insert data into the faculty_details table
    $sql = "UPDATE faculty_details
            SET research_statement = '$researchStatement',
                teaching_statement = '$teachingStatement',
                rel_info = '$relInfo',
                prof_service = '$profService',
                journal_publications = '$journalPublications',
                conference_publications = '$conferencePublications'
            WHERE email = '$sessionEmail'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../ref&up/main.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
