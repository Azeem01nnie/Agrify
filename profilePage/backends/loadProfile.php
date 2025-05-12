<?php
session_start();
require_once '../../php/Config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the user ID from the session

// Query to fetch user profile details using the user_id
try {
    // Use aliases for the columns to match the expected frontend names
    $stmt = $pdo->prepare("SELECT name AS full_name, address AS address, dob AS dob FROM user_profiles WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['status' => 'success', 'data' => $user]);
    } else {
        echo json_encode(['error' => 'User profile not found']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
