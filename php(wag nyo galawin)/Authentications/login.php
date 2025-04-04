<?php
ob_start();
session_start();
require_once '../Config/database.php';

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)){
        $error_message = "Username and Password are required.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: ../Authentications/dashboard.php");
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Neo+ Login</title>
    <link rel="stylesheet" href="../Authentications/login-style.css">
</head>
<body>
    <div class="login-container">
        <h2>AGRIFY</h2>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form action="register.php" method="POST">
            <label>USERNAME</label>
            <input type="text" name="username" required>
            <label>PASSWORD</label>
            <input type="password" name="password" required>
            <button type="submit" class="login-btn" name="signUp">LOGIN</button>
        </form>
    </div>
</body>
</html>
