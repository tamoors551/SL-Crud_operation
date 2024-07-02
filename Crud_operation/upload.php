<?php
// Check if the form was submitted with a file
if (isset($_FILES['video']) && $_FILES['video']['error'] === 0) {

  // Get information about the uploaded video
  $fileName = $_FILES['video']['name'];
  $fileSize = $_FILES['video']['size'];
  $tmpName = $_FILES['video']['tmp_name'];

  // Define allowed extensions (modify as needed)
  $allowedExtensions = array('mp4', 'avi', 'mov');

  // Get file extension
  $extension = pathinfo($fileName, PATHINFO_EXTENSION);

  // Validate file size and extension
  if ($fileSize > 50000000) { // Limit to 50MB (adjust as needed)
    echo "Error: File size exceeds limit (50MB)";
  } else if (!in_array($extension, $allowedExtensions)) {
    echo "Error: Invalid file type. Only " . implode(', ', $allowedExtensions) . " allowed.";
  } else {
    // Generate a unique name for the uploaded file (optional)
    $newName = uniqid('', true) . '.' . $extension;

    // Define upload path (modify as needed)
    $uploadPath = 'uploads/';

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($tmpName, $uploadPath . $newName)) {
      echo "Video uploaded successfully!";
      // You can optionally save video information to a database here
    } else {
      echo "Error: Failed to upload video.";
    }
  }
} else {
  echo "No video selected for upload.";
}
?>
