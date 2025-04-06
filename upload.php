<?php
// Define the upload directory
$uploadDir = 'uploads/';

// Check if the 'uploads' directory exists, if not, create it
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if a file has been uploaded
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = time() . '-' . basename($file['name']);
    $filePath = $uploadDir . $fileName;

    // Check for upload errors
    if ($file['error'] == UPLOAD_ERR_OK) {
        // Move the file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            $downloadLink = 'uploads/' . $fileName;
            echo "<p>File uploaded successfully!</p>";
            echo "<p>Download link: <a href='$downloadLink' target='_blank'>$downloadLink</a></p>";
        } else {
            echo "<p>Error uploading file.</p>";
        }
    } else {
        echo "<p>File upload error: " . $file['error'] . "</p>";
    }
} else {
    echo "<p>No file uploaded.</p>";
}
?>
