<?php
// Start the session to access user_id
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo "Not logged in";
    exit;
}

$user_id = $_SESSION['user_id'];

// Check if a file was uploaded and there was no error
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    // Set the upload directory to the 'uploads' folder outside 'profilePage'
    $uploadDir = dirname(__DIR__, 2) . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Get the file extension and validate it
    $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($ext, $allowed)) {
        echo "Invalid file type";
        exit;
    }

    // Build the target filename as user_{user_id}.{ext}
    $filename = "user_" . $user_id . "." . $ext;
    $targetFile = $uploadDir . $filename;

    // Move the uploaded file to the target location
    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
        echo "success";
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "No file uploaded or upload error.";
}
?>
