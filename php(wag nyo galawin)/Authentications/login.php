<?php
session_start();
require_once '../Config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)){
        die("Username and Password are required.");
    }
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch();

if($user && password_verify($password, $user['password'])){
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    header("Location ../dashboard.php");
    exit();
}else{
    die("Invalid username or password");
}