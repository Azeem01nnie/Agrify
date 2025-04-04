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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Neo+ Login</title>
    <link rel="stylesheet" href="login-style.css">
</head>
<body>
    <div class="login-container">
        <h2>AGRIFY</h2>
        <form action="login.php" method="POST">
            <label>USERNAME</label>
            <input type="text" name="username" required>
            <label>PASSWORD</label>
            <input type="password" name="password" required>
            <button type="submit" class="login-btn">LOGIN</button>
        </form>
    </div>
</body>
</html>
