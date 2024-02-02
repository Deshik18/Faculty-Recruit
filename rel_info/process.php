<?php
// process.php
include '../config.php';
session_start(); // Start the session

function replaceNewlines($input) {
    // Replace \r\n with <br>
    return str_replace("\r\n", "", $input);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $researchStatement = $_POST['research_statement']; // No need to filter as we want to store HTML content
    $teachingStatement = $_POST['teaching_statement']; // No need to filter as we want to store HTML content
    $relInfo = $_POST['rel_in']; // No need to filter as we want to store HTML content
    $profService = $_POST['prof_serv']; // No need to filter as we want to store HTML content
    $journalPublications = $_POST['jour_details']; // No need to filter as we want to store HTML content
    $conferencePublications = $_POST['conf_details']; // No need to filter as we want to store HTML content

    // Remove \r\n characters and replace them with <br>
    $researchStatement = replaceNewlines($researchStatement);
    $teachingStatement = replaceNewlines($teachingStatement);
    $relInfo = replaceNewlines($relInfo);
    $profService = replaceNewlines($profService);
    $journalPublications = replaceNewlines($journalPublications);
    $conferencePublications = replaceNewlines($conferencePublications);

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
