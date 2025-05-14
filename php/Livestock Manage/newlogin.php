<?php
session_start();
require_once '../Config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT user_id, username, password, role FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            
            header("Location: ../Authentications/dashboard.php");
            exit;
        } else {
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'Please enter both username and password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Agrify</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="newlogin.css">
</head>
<body>
  <div class="container">
    <div class="illustration">
        <img src="/agrify/php/Livestock%20Manage/iconss/polpol.jpg" alt="Illustration">
      </div>
      <div class="login-section">
        <?php if ($error): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
      <div class="logo">Agrify</div>
      <div class="title" style="color: #4c7c4c;">Login To Get Started</div>
      <form action="#" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button class="login-button" type="submit" name="login">Login</button>
        <div class="or">OR</div>
      
        <div class="signup">
          Don’t have an account? <a href="/agrify/register/regform.php">Sign Up</a>
        </div>
        <div class="terms">
          By signing in, you agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>, including <a href="#">cookie use</a>.
        </div>
      </form>
      
    </div>
  </div>
</body>
</html>
