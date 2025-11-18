<?php


header("Content-Type: application/json");

if (!isset($_FILES['myfile'])) {
    echo json_encode(["status" => "error", "message" => "No file uploaded"]);
    exit;
}

$file = $_FILES['myfile'];
//print_r($file);

if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(["status" => "error", "message" => "Upload error"]);
    exit;
}

// Validate MIME type
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);

// echo $mime;
// die;

finfo_close($finfo);

$allowed = ['image/jpeg', 'image/png'];
if (!in_array($mime, $allowed)) {
    echo json_encode(["status" => "error", "message" => "Only JPG/PNG allowed"]);
    exit;
}

$ext = ($mime === 'image/png') ? 'png' : 'jpg';

$newName = "user_" . time() . "." . $ext;
$destination = __DIR__ . "/uploads/" . $newName;

$destination = __DIR__ . "/uploads/" . $newName;

if (!move_uploaded_file($file['tmp_name'], $destination)) {
    echo json_encode(["status" => "error", "message" => "Failed to move file"]);
    exit;
}

echo json_encode(["status" => "success", "file" => "uploads/" . $newName]);

// if (isset($_POST["submit"])) {
//     //echo 'title';
//     $fileName = $_FILES['myfile']['name'];
//     $fileTmp  = $_FILES['myfile']['tmp_name'];
//     $fileSize = $_FILES['myfile']['size'];
//     $fileError = $_FILES['myfile']['error'];

//     $ext = pathinfo($fileName, PATHINFO_EXTENSION);

//     if ($fileError === 0) {
//         if($ext == 'png' || $ext == 'jpg') {

//             $newFileName = 'user_' . time() . '.' . $ext;
//             // echo $newFileName;
//             // die;
//             $destination = "uploads/" . $newFileName;

//             if (move_uploaded_file($fileTmp, $destination)) {
//                 echo "File uploaded successfully!";
//             } else {
//                 echo "Error uploading the file!";
//             }
//         }else {
//             echo "Error: formt mora biti jpg ili png";
//         }

//     } else {
//         echo "Error: " . $fileError;
//     }
// }

?>