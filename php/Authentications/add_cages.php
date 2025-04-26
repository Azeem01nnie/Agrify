<?php
require_once '../Config/database.php'; 

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

// Start session if not already started (important for $_SESSION access)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current user ID from session
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo json_encode(['success' => false, 'message' => 'User not authenticated.']);
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    // Remove whitespace
    $cage_name = trim($_POST['cage_name'] ?? '');
    $cage_desc = trim($_POST['cage_desc'] ?? '');
    $image_path = null;

    if ($cage_name === '') {
        throw new Exception("Cage name is required.");
    }

    // Handle file upload
    if (!empty($_FILES['cage_image']['tmp_name']) && $_FILES['cage_image']['error'] === 0) {
        // Securely get MIME type
        $image_info = getimagesize($_FILES['cage_image']['tmp_name']);
        $mime_type = $image_info['mime'] ?? '';

        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (!in_array($mime_type, $allowed_types)) {
            throw new Exception("Only JPG, PNG, and GIF files are allowed. Detected type: $mime_type");
        }

        // Set upload directory
        $upload_dir = __DIR__ . '/../../php/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create directory if it doesn't exist
        }

        // Generate a unique filename
        $file_name = uniqid('cage_', true) . '_' . basename($_FILES['cage_image']['name']);
        $target_path = $upload_dir . $file_name;

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['cage_image']['tmp_name'], $target_path)) {
            throw new Exception("Failed to upload image.");
        }

        // Store relative path from web root
        $image_path = '../php/uploads/' . $file_name;
    }

    // Insert cage info into database
    $stmt = $pdo->prepare("INSERT INTO cages (cage_name, cage_desc, image_path, created_at, user_id) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->execute([$cage_name, $cage_desc, $image_path, $user_id]);

    $response['success'] = true;
    $response['message'] = "Cage successfully added.";
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Return JSON response
echo json_encode($response);
?>
