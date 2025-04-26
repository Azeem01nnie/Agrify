<?php
header('Content-Type: application/json');
require_once '../Config/database.php'; // Your PDO connection file

try {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['cage_id'])) {
        echo json_encode(['success' => false, 'message' => 'Missing cage ID.']);
        exit;
    }

    $id = intval($data['cage_id']);

    // Optional: Check if cage exists
    $check = $pdo->prepare("SELECT cage_id FROM cages WHERE cage_id = :id");
    $check->execute([':id' => $id]);

    if ($check->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Cage not found.']);
        exit;
    }

    // Delete cage
    $stmt = $pdo->prepare("DELETE FROM cages WHERE cage_id = :id");
    $stmt->execute([':id' => $id]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>