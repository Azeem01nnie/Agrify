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
        <a href="/Authentications/login.php" class="back-arrow">&larr;</a>

        <form id="registrationForm">
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

            <label for="password">Password <span class="hint">(make it unique)</span></label>
            <input type="password" id="password" name="password" required>

            <label for="repassword">Re-type Password <span class="hint">(make it unique)</span></label>
            <input type="password" id="repassword" name="repassword" required>
            <p id="password-warning" class="warning hidden">Passwords do not match!</p>
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
            <div class="checkbox-container">
                <input type="checkbox" id="agreeCheckbox" class="agree-checkbox">
                <label for="agreeCheckbox">Agree to the Terms and Condition</label>
            </div>
            <button class="create-account-btn" id="createAccountBtn" disabled>Create Account</button>
        </div>
    </div>
    <script src="register-script.js"></script>
</body>
</html>
