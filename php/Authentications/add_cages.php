<?php
require_once '../Config/database.php'; 

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    // removes whitespaces
    $cage_name = trim($_POST['cage_name'] ?? '');
    $cage_desc = trim($_POST['cage_desc'] ?? '');
    $image_path = null;

    if ($cage_name === '') {
        throw new Exception("Cage name is required.");
    }

    // Handle file upload
    if (!empty($_FILES['cage_image']['tmp_name']) && $_FILES['cage_image']['error'] === 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = mime_content_type($_FILES['cage_image']['tmp_name']);

        if (!in_array($file_type, $allowed_types)) {
            throw new Exception("Only JPG, PNG, and GIF files are allowed.");
        }

        $upload_dir = __DIR__ . '/../../php/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_name = uniqid('cage_', true) . '_' . basename($_FILES['cage_image']['name']);
        $target_path = $upload_dir . $file_name;

        if (!move_uploaded_file($_FILES['cage_image']['tmp_name'], $target_path)) {
            throw new Exception("Failed to upload image.");
        }

        // Store relative path from web root
        $image_path = '/php/uploads/' . $file_name;
    }

    // Insert into DB
    $stmt = $pdo->prepare("INSERT INTO cages (cage_name, cage_desc, image_path, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$cage_name, $cage_desc, $image_path]);

    $response['success'] = true;
    $response['message'] = "Cage successfully added.";
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
