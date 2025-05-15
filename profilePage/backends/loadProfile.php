<?php
session_start();
require_once '../../php/Config/database.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in', 'data' => null]);
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the user ID from the session

// Query to fetch user profile details using the user_id
try {
    // Use a subquery to fetch the email
    $stmt = $pdo->prepare("
        SELECT 
            up.name AS full_name, 
            up.address AS address, 
            up.dob AS dob, 
            (SELECT u.email FROM users u WHERE u.user_id = up.user_id) AS email
        FROM user_profiles up
        WHERE up.user_id = :user_id
    ");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['status' => 'success', 'data' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User profile not found', 'data' => null]);
    }
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage(), 'data' => null]);
}
?>
