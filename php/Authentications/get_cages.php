<?php
session_start();
require_once '../Config/database.php';
$user_id = $_SESSION['user_id'];

header('Content-Type: application/json');

try {
    $stmt = $pdo->prepare("SELECT * FROM cages WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]);

    $cages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($cages);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>