<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile Page</title>
  <link rel="stylesheet" href="profileStyle.css" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h1 class="logo">AGRIFY</h1>
      <img src="" style="opacity: 0.5;" class="profile-img"/>
      <p class="username"><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?> | Admin</p>

      <nav class="nav">
        <a href="../php/Authentications/dashboard.php">Home</a>
        <a href="#">livestock Details</a>
        <a href="../addanimals/index.php">Cages</a>
        <a href="#">Settings</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <h2>Profile Information</h2>
      <div class="profile-card">
        <div class="left">
          <img src="../addanimals/profile.png" alt="User Photo" class="profile-img"  />
          <label class="change-photo">📷 Change Photo</label>
          <div class="info">
            <h3>Barbie B. Batumbakal</h3>
          </div>
        </div>
        <div class="right">
          <h3>Personal Details</h3>
        <p><strong>Full Name:</strong> <span id="fullName"></span></p>
        <p><strong>Address:</strong> <span id="address"></span></p>
        <p><strong>Date of Birth:</strong> <span id="dob"></span></p>

        <button id="openEditModal" class="edit-btn">✏️ Edit Profile</button>
        </div>
      </div>

      <div class="account-settings">
        <h3>Account Settings</h3>
        <p><strong>Password:</strong> ******** <a href="#" class="change-link" id="openChangePasswordBtn">Change Password</a></p>
        <p>Manage your account security settings.</p>
      </div>
    </main>
  </div>


    <!-- Andito yung modal ng edit and change pass, mag add ako modal pero wala pa yan sya backend -->
     <div id="editProfileModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-button" id="closeModal">&times;</span>
            <h3>Edit Profile</h3>
            <form id="editProfileForm">
            <label for="fullname">Full Name:</label>
            <input type="text" id="edit_fullname" name="fullname" required>

            <label for="email">Address:</label>
            <input type="text" id="edit_address" name="address" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="edit_dob" name="dob" required>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <div id="changePasswordModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close-button" id="closeChangePasswordModal">&times;</span>
            <h3>Change Password</h3>
            <form id="changePasswordForm">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>

            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

  <script src="ProfileScript.js"></script>
</body>
</html>
