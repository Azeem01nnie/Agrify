<?php
session_start();
header('Content-Type: application/json');
require_once '../Config/database.php';
$user_id = $_SESSION['user_id'];

try {
    // Decode incoming JSON data
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if the required fields are present
    if (!isset($data['cage_id'], $data['cage_name'], $data['cage_desc'])) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }

    // Get and sanitize inputs
    $id = intval($data['cage_id']);  // Convert to integer for security
    $name = trim($data['cage_name']);
    $desc = trim($data['cage_desc']);

    // Validate cage name is not empty
    if ($name === '') {
        echo json_encode(['success' => false, 'message' => 'Cage name cannot be empty.']);
        exit;
    }

    // Check if the cage belongs to the user (move this after defining $id)
    $check = $pdo->prepare("SELECT cage_id FROM cages WHERE cage_id = :id AND user_id = :user_id");
    $check->execute([':id' => $id, ':user_id' => $user_id]);

    if ($check->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Cage not found or permission denied.']);
        exit;
    }

    // Update the cage record in the database
    $stmt = $pdo->prepare("UPDATE cages SET cage_name = :name, cage_desc = :desc WHERE cage_id = :id");
    $stmt->execute([
        ':name' => $name,
        ':desc' => $desc,
        ':id'   => $id  // Corrected parameter: :id
    ]);

    // Respond with success
    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    // Handle any database errors
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>