<?php
session_start();
require_once '../Config/database.php';

if (!isset($_POST['cage_id'], $_POST['cage_name'], $_POST['cage_desc']) || !isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

$cage_id = intval($_POST['cage_id']);
$cage_name = trim($_POST['cage_name']);
$cage_desc = trim($_POST['cage_desc']);
$user_id = $_SESSION['user_id'];

// Update cage details in the database
$stmt = $pdo->prepare("UPDATE cages SET cage_name = :cage_name, cage_desc = :cage_desc WHERE cage_id = :cage_id AND user_id = :user_id");
$stmt->execute([':cage_name' => $cage_name, ':cage_desc' => $cage_desc, ':cage_id' => $cage_id, ':user_id' => $user_id]);

if ($stmt->rowCount() > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update cage.']);
}