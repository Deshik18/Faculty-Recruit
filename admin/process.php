<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if form is submitted
if (isset($_SESSION['admin_dept'])) {
    // Directory to be zipped
    $folderPath = '../IITP-FACREC-2023-NOV-02/' . $_SESSION['admin_dept'];
    echo $folderPath;
    // Check if the directory exists
    if (is_dir($folderPath)) {
        // Create a zip archive
        $zip = new ZipArchive();
        $zipFileName = 'folder.zip';
        
        if ($zip->open($zipFileName, ZipArchive::CREATE) === TRUE) {
            // Add files to the zip
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folderPath));
            foreach ($files as $file) {
                // Exclude ".", ".." and hidden files
                if (!$files->isDot() && !$files->isDir() && !preg_match('/^\./', $file->getFilename())) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($folderPath) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }
            
            // Close the zip
            $zip->close();
            
            // Set headers to force download the zip file
            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $zipFileName);
            header('Content-Length: ' . filesize($zipFileName));
            readfile($zipFileName);
            
            // Delete the zip file after download
            unlink($zipFileName);
            
            exit;
        } else {
            echo "Error: Failed to create zip archive.";
        }
    } else {
        echo "Error: Directory does not exist.";
    }
}
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <title>Download Folder as Zip</title>
</head>
<body>
    <form method="post">
        <label for="admin_dept">Enter Department Name:</label>
        <input type="text" id="admin_dept" name="admin_dept" required>
        <button type="submit">Download Folder as Zip</button>
    </form>
</body>
</html> -->
