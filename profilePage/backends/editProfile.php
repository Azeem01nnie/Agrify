<?php
session_start();
require_once '../../php/Config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"), true);

$fullname = $data['fullname'] ?? '';
$address = $data['address'] ?? '';
$dob = $data['dob'] ?? '';
$email = $data['email'] ?? '';

if (!$fullname || !$address || !$dob || !$email) {
    echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Update user_profiles
    $stmt1 = $pdo->prepare("UPDATE user_profiles SET name = :name, address = :address, dob = :dob WHERE user_id = :user_id");
    $stmt1->execute([
        ':name' => $fullname,
        ':address' => $address,
        ':dob' => $dob,
        ':user_id' => $user_id
    ]);

    // Update users (email)
    $stmt2 = $pdo->prepare("UPDATE users SET email = :email WHERE user_id = :user_id");
    $stmt2->execute([
        ':email' => $email,
        ':user_id' => $user_id
    ]);

    $pdo->commit();
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
