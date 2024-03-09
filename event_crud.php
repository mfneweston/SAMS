<?php
$target_dir = "uploads/ProofDocument/";
$target_file = $target_dir . basename($_FILES["fileInput"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$response = ""; // Initialize the response variable

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileInput"]["tmp_name"]);
  if ($check !== false) {
    $response .= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $response .= "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $response .= "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileInput"]["size"] > 5000000) {
  $response .= "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
$allowed_formats = ["pdf", "doc", "docx"];
if (!in_array($imageFileType, $allowed_formats)) {
  $response .= "Sorry, only PDF, DOC, and DOCX files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  // $response .= "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $target_file)) {
    $response .= "The file " . htmlspecialchars(basename($_FILES["fileInput"]["name"])) . " has been success uploaded.";
  } else {
    $response .= "Sorry, there was an error uploading your file.";
  }
}

// Return the response to the AJAX request
echo $response;
