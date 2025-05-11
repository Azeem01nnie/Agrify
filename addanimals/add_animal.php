<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);

session_start();
require_once '../php/Config/database.php';

header('Content-Type: application/json');

function sendJsonResponse($success, $message, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode(['success' => $success, 'message' => $message]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    sendJsonResponse(false, 'User not logged in', 401);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(false, 'Invalid request method', 405);
}

$cage_id = filter_input(INPUT_POST, 'cage_id', FILTER_VALIDATE_INT);
$animal_type = filter_input(INPUT_POST, 'animal_type', FILTER_SANITIZE_STRING);
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$breedable = filter_input(INPUT_POST, 'breedable', FILTER_VALIDATE_INT);
$sellable = filter_input(INPUT_POST, 'sellable', FILTER_VALIDATE_INT);

if (!$cage_id || !$animal_type || !$dob || $price === false) {
    sendJsonResponse(false, 'Missing or invalid required fields', 400);
}

try {
    // Check cage ownership
    $stmt = $pdo->prepare("SELECT cage_id FROM cages WHERE cage_id = :cage_id AND user_id = :user_id");
    $stmt->execute([':cage_id' => $cage_id, ':user_id' => $_SESSION['user_id']]);
    
    if (!$stmt->fetch()) {
        sendJsonResponse(false, 'Invalid or unauthorized cage ID', 403);
    }

    $stmt = $pdo->prepare("
        INSERT INTO animals (
            cage_id, animal_type, date_of_birth, price, breedable, sellable, created_at
        ) VALUES (
            :cage_id, :animal_type, :dob, :price, :breedable, :sellable, NOW()
        )
    ");

    $stmt->execute([
        ':cage_id' => $cage_id,
        ':animal_type' => $animal_type,
        ':dob' => $dob,
        ':price' => $price,
        ':breedable' => $breedable,
        ':sellable' => $sellable
    ]);

    sendJsonResponse(true, 'Animal added successfully', 200);

} catch (PDOException $e) {
    error_log("Database error in add_animal.php: " . $e->getMessage());
    sendJsonResponse(false, 'Database error occurred', 500);
}