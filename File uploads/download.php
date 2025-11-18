<?php

if (!isset($_GET['file'])) {
    http_response_code(400);
    exit("Missing file parameter");
}

$filename = $_GET['file'];

// Prevent directory traversal
if (preg_match('/\.\.|\/|\\\\/', $filename)) {
    http_response_code(403);
    exit("Invalid filename");
}

$path = __DIR__ . "/uploads/" . $filename;

if (!file_exists($path)) {
    http_response_code(404);
    exit("File not found");
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($path) . '"');
header('Content-Length: ' . filesize($path));

readfile($path);
exit;

// $file = $_GET['file'];

// $file = "uploads/" . $file;

// if (file_exists($file)) {

//     // Headers for download
//     header('Content-Description: File Transfer');
//     header('Content-Type: application/octet-stream');
//     header('Content-Disposition: attachment; filename="'.basename($file).'"');
//     header('Content-Length: ' . filesize($file));
//     readfile($file);

//     exit;

// } else {
//     echo "File not found!";
// }