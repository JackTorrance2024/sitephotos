<?php
header('Content-Type: application/json');

// Error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$directory = 'photos';
$photos = array();

if (is_dir($directory)) {
    $iterator = new DirectoryIterator($directory);
    foreach ($iterator as $fileinfo) {
        if ($fileinfo->isFile()) {
            $photos[] = $fileinfo->getFilename();
        }
    }
} else {
    // Error message if the directory is not found
    echo json_encode(array('error' => 'Directory not found'));
    exit;
}

// Check for errors or unexpected output
$output = json_encode($photos);
if ($output === false) {
    // JSON encoding error
    echo json_encode(array('error' => 'JSON encoding error: ' . json_last_error_msg()));
    exit;
}

echo $output;
?>
