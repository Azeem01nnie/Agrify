<?php
session_start();
require_once '../php/Config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $dob = $_POST['dob'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';
    $agreeTerms = isset($_POST['agreeTerms']);

    if (!empty($name) && !empty($address) && !empty($dob) && !empty($contact) &&
        !empty($username) && !empty($email) && !empty($password) && !empty($repassword)) {

        if ($password !== $repassword) {
            $error = 'Passwords do not match.';
        } elseif (!$agreeTerms) {
            $error = 'You must agree to the Terms and Conditions.';
        } else {
            $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = :username OR email = :email LIMIT 1");
            $stmt->execute(['username' => $username, 'email' => $email]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                $error = 'Username or email already taken.';
            } else {
                try {
                    $pdo->beginTransaction();

                    // Insert into users table
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role, created_at)
                                           VALUES (:username, :email, :password, 'farmer', NOW())");
                    $stmt->execute([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashedPassword
                    ]);

                    $userId = $pdo->lastInsertId();

                    // Insert into user_profiles table
                    $stmt = $pdo->prepare("INSERT INTO user_profiles (user_id, name, address, dob, contact)
                                           VALUES (:user_id, :name, :address, :dob, :contact)");
                    $stmt->execute([
                        'user_id' => $userId,
                        'name' => $name,
                        'address' => $address,
                        'dob' => $dob,
                        'contact' => $contact
                    ]);

                    $pdo->commit();

                    header("Location:/agrify/php/Livestock%20Manage/newlogin.php");
                    exit;
                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $error = 'An error occurred: ' . $e->getMessage();
                }
            }
        }
    } else {
        $error = 'Please fill in all fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGRIFY Registration</title>
    <link rel="stylesheet" href="register-style.css"> 
</head>
<body>
    <div class="container">
        <h1>Welcome to AGRIFY</h1>
        <a href="/agrify/php/Livestock%20Manage/newlogin.php" class="back-arrow">&larr;</a>

        <?php if ($error): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form id="registrationForm" method="POST" action="">
            <label for="name">Name <span>(Last name, First name, M.I.)</span></label>
            <input type="text" id="name" name="name" required>

            <label for="address">Address <span>(Street name, City, Province)</span></label>
            <input type="text" id="address" name="address" required>

            <label for="dob">Date of birth</label>
            <input type="date" id="dob" name="dob" required>

            <label for="contact">Contact No.</label>
            <input type="text" id="contact" name="contact" required>

            <label for="username">Username <span class="hint">(make it unique)</span></label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password <span class="hint">(make it unique)</span></label>
            <input type="password" id="password" name="password" required>

            <label for="repassword">Re-type Password <span class="hint">(make it unique)</span></label>
            <input type="password" id="repassword" name="repassword" required>
            <p id="password-warning" class="warning hidden">Passwords do not match!</p>
            
            <div class="checkbox-container">
                <input type="checkbox" id="agreeCheckbox" name="agreeTerms" class="agree-checkbox">
                <label for="agreeCheckbox">Agree to the Terms and Conditions</label>
            </div>

            <button type="submit" class="create-account-btn" id="createAccountBtn" <?php echo isset($error) ? 'disabled' : ''; ?>>Create Account</button>
        </form>

        <div class="container2">
            <h2>Terms and Condition</h2>
            <div class="terms-box">
                <p>Welcome to Agrify!, a livestock management system designed to help farmers and businesses efficiently manage and track livestock operations. By accessing or using our platform, you agree to be bound by the following Terms and Conditions. If you do not agree with any part of these terms, please do not use our services.
                   <br><br>
                    1. Acceptance of Terms
                    By creating an account or using any part of the system, you acknowledge that you have read, understood, and agree to these Terms and Conditions.
                    <br><br>
                    2. Use of the System
                    You must be at least 18 years old to use this system.
                    
                    You agree to use the system only for lawful purposes and in accordance with these terms.
                    
                    You are responsible for maintaining the confidentiality of your account credentials and for all activities under your account.
                    <br><br>
                    3. System Features
                    Our livestock management system may include the following features:
                    
                    Animal registration and tracking
                    
                    Health and vaccination records
                    
                    Breeding and reproduction data
                    
                    Sales and inventory tracking
                    
                    Financial reporting and analytics
                    
                    We reserve the right to update or modify features at any time.
                    <br><br>
                    4. User Data
                    You retain ownership of the data you input into the system.
                    
                    We may use aggregated and anonymized data for research, analytics, or system improvement.
                    
                    Personal and farm-related data will be stored securely and will not be shared with third parties without your consent, except as required by law.
                    <br><br>
                    5. Payment and Subscription (if applicable)
                    Some features may require a paid subscription.
                    
                    All fees are non-refundable unless otherwise stated.
                    
                    We reserve the right to change pricing at any time with prior notice.
                    <br><br>
                    6. Intellectual Property
                    All content, trademarks, and software associated with the system are owned by [Your Company Name] or its licensors.
                    
                    You may not copy, reproduce, or distribute any part of the system without our written permission.
                    <br><br>
                    7. Limitation of Liability
                    We are not liable for any direct, indirect, or incidental damages resulting from:
                    
                    Loss of data
                    
                    Downtime or system errors
                    
                    User errors or inaccurate data entries
                    
                    Mismanagement or misuse of livestock information
                    
                    Use of the system is at your own risk.
                    <br><br>
                    8. Termination
                    We reserve the right to suspend or terminate your account at any time if you violate these terms.
                    <br><br>
                    9. Changes to Terms
                    We may update these Terms and Conditions at any time. Continued use of the system after changes are posted will constitute your acceptance of the new terms.
                    <br><br>
                    10. Governing Law
                    These terms are governed by the laws of [Your Country/State]. Any disputes shall be resolved in the courts of [Your Jurisdiction].
                    <br><br>
                    <h3>>Contact Us</h3>
                    <br><br>
                    If you have any questions about these Terms and Conditions, please contact us at:
                    <li>Azeem@gmail.com</li>
                   <li>091111111</li>
                    <li>baliwasan</li>
                    </p>
            </div>
        </div>
    </div>

    <script src="register-script.js"></script>
</body>
</html>
