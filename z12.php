<?php
    include 'config.php';
    session_start();
    require 'convertapi-php-master/lib/ConvertApi/autoload.php';
    use \ConvertApi\ConvertApi;

    // Set ConvertApi secret
    ConvertApi::setApiSecret('ezubjWtrEMtkztDW');

    // Directory and file names
    $selected_department = strtoupper($_SESSION['dept']);
    $name_email_cat = strtoupper($_SESSION['first_name'] . '_' . $_SESSION['last_name'] . '_' . $_SESSION['email'] . '_' . $_SESSION['cast']);
    $uploadsDir = $_SESSION['adv_num'] . '/' . $selected_department . '/' . $_SESSION['post'] . '/' . $_SESSION['cast'] . '/' . $_SESSION['ref_num'] . '_' . $name_email_cat . '_supportingdocs/';

    $fileNames = [
        'PHD_Certificate.pdf',
        'PG_Certificate.pdf',
        'UG_Certificate.pdf',
        '12th_HSC_Diploma.pdf',
        '10th_SSC_Certificate.pdf',
        '10_Years_Post_PHD_Experience_Certificate.pdf',
        'Any_Other_Document.pdf'
    ];

    // Add all files in the specified directory
    $allFiles = [];
    foreach ($fileNames as $fileName) {
        $filePath = $uploadsDir . $fileName;

        // Check if the file exists before adding to the array
        if (file_exists($filePath)) {
            $allFiles[] = $filePath;
        }
    }

    // Convert and merge all files
    $result = ConvertApi::convert('merge', [
        'Files' => $allFiles,
        'BookmarksToc' => 'title',
        'OpenPage' => '1',
    ], 'pdf');

    // Specify the directory to save the result
    $resultDirectory = $uploadsDir;  // Change to the desired directory

    // Save the result file as 'application.pdf' in the specified directory
    $result->getFile()->save($resultDirectory . '/application.pdf');
    ?>