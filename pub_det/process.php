<?php
include '../config.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
var_dump($_POST);

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data as needed
    $summary_journal_inter = $_POST["summary_journal_inter"];
    $summary_journal = $_POST["summary_journal"];
    $summary_conf_inter = $_POST["summary_conf_inter"];
    $summary_conf_national = $_POST["summary_conf_national"];
    $patent_publish = $_POST["patent_publish"];
    $summary_book = $_POST["summary_book"];
    $summary_book_chapter = $_POST["summary_book_chapter"];

    $sum_pub = json_encode(array(
        'summary_journal_inter' => $summary_journal_inter,
        'summary_journal'=> $summary_journal,
        'summary_conf_inter'=> $summary_conf_inter,
        'summary_conf_national'=> $summary_conf_national,
        'patent_publish' => $patent_publish,
        'summary_book'=> $summary_book,
        'summary_book_chapter'=> $summary_book_chapter,
    ));

    $best_pub = array();
    if (isset($_POST['author'])) {
    for ($i = 0; $i < count($_POST['author']); $i++) {
        $qemp = array(
            'author' => $_POST['author'][$i],
            'title' => $_POST['title'][$i],
            'journal' => $_POST['journal'][$i],
            'year' => $_POST['year'][$i],
            'impact' => $_POST['impact'][$i],
            'doi'=> $_POST['doi'][$i],
            'status'=> $_POST['status'][$i],
        );
        $best_pub[] = $qemp;
    }
    }

    $book = array();
    if (isset($_POST['bauthor'])) {
    for ($i = 0; $i < count($_POST['bauthor']); $i++) {
        $books = array(
            'bauthor' => $_POST['bauthor'][$i],
            'btitle' => $_POST['btitle'][$i],
            'byear' => $_POST['byear'][$i],
            'bisbn' => $_POST['bisbn'][$i],
            // Add more book fields here if needed
        );
        $book[] = $books;
    }
    }

    // Handle posted data for book chapters
    $chapter = array();
    if (isset($_POST['bc_author'])) {
    for ($i = 0; $i < count($_POST['bc_author']); $i++) {
        $book_chapter = array(
            'author' => $_POST['bc_author'][$i],
            'title' => $_POST['bc_title'][$i],
            'year' => $_POST['bc_year'][$i],
            'isbn' => $_POST['bc_isbn'][$i],
        );
        $chapter[] = $book_chapter;
    }
    }

    // Handle posted data for patents
    $patents = array(); // Use a different variable name

    if (isset($_POST['pauthor'])) {
        for ($i = 0; $i < count($_POST['pauthor']); $i++) {
            $current_patent = array( // Use a different variable name
                'inventor' => $_POST['pauthor'][$i],
                'title' => $_POST['ptitle'][$i],
                'country' => $_POST['p_country'][$i],
                'number' => $_POST['p_number'][$i],
                'year_filed' => $_POST['pyear_filed'][$i],
                'year_published' => $_POST['pyear_published'][$i],
                'year_issued' => $_POST['pyear_issued'][$i],
            );
            $patents[] = $current_patent; // Use a different variable name
        }
    }


    $best_pub_json = json_encode($best_pub);
    $book_json = json_encode($book);
    $chapter_json = json_encode($chapter);
    $patent_json = json_encode($patents);
    
    $updateQuery = "UPDATE faculty_details SET sum_pub = ?, best_pub = ?, book = ?, chap = ?, patent = ?, scholar_link = ? WHERE email = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssss", $sum_pub, $best_pub_json, $book_json, $chapter_json, $patent_json, $_POST['google_link'], $_SESSION['email']);
    if ($stmt->execute()) {
        // Update successful
        // Redirect to a success page or perform other actions
        header("Location: ../acad_ind_exp/main.php");
        exit();
    } else {
        echo 'Some Error Occurred: ' . $stmt->error;
    }
} else {
    // Handle cases where the form was not submitted
}
?>
