<?php
require_once '../Config/database.php';

$username = 'testuser';
$password = 'mypassword';
$email = 'testuser@example.com';
$role = 'admin';

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
$stmt->execute(['username' => $username, 'email' => $email]);
$exists = $stmt->fetchColumn();

if ($exists == 0) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (:username, :email, :password, :role, NOW())");
    $insert->execute([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => $role
    ]);

    echo "Admin user created successfully.";
} else {
    echo "User already exists. Skipping insertion.";
}
?>