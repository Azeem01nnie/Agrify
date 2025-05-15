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
  <style>
    .sidebar {
      width: 250px;
      background: #40513B;
      color: white;
      padding: 20px;
      text-align: center;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
    }
    .sidebar h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="sidebar" id="sidebar">
      <div class="logo-container">
        <img src="/agrify/php/marketplace/baka.png" alt="Library Logo">
      </div>
    <p class="username">
      <?php 
        if (isset($_SESSION['username'])) {
          echo htmlspecialchars($_SESSION['username']);
        } else {
          echo "Guest";
        }
      ?> | Admin
    </p>
    <div class="menu">
      <a href="/agrify/php/Authentications/dashboard.php">
        <img src="/agrify/icons/dashboard_vector.svg" alt="Dashboard">
        Dashboard
      </a>
      <a href="/agrify/addanimals/index.php">
        <img src="/agrify/icons/cages.png" alt="Cages">
        Cages
      </a>
      <a href="/agrify/profilePage/profilePage.php" class="active">
        <img src="/agrify/icons/setting.png" alt="Settings">
        Settings
      </a>
    </div>
    <div class="footer-sidebar">
      <a href="#">About</a>
      <a href="#">Support</a>
      <a href="#">Terms & condition</a>
    </div>
  </div>

  <div class="main-content">
    <div class="topbar">
      <div class="user-info">
        <img src="/agrify/icons/Profile.svg" alt="Profile">
        <div class="user-details">
          <div class="user-name">
            <?php 
              if (isset($_SESSION['username'])) {
                echo htmlspecialchars($_SESSION['username']);
              } else {
                echo "Guest";
              }
            ?>
          </div>
          <div class="user-role">Admin</div>
        </div>
      </div>
      <div class="logout">
        <button class="menu-button">
          <img src="/agrify/icons/logout.svg" alt="Menu">
        </button>
        <div class="dropdown-menu">
          <div class="menu-item">
            <img src="/agrify/icons/Profile (2).svg" alt="Profile">
            <span>Profile</span>
          </div>
          <div class="menu-item">
            <img src="/agrify/icons/accountsett.svg" alt="Account Settings">
            <span>Account Settings</span>
          </div>
          <div class="menu-item">
            <img src="/agrify/icons/languageicon.svg" alt="Language">
            <span>Language</span>
          </div>
          <div class="menu-item">
            <img src="/agrify/icons/darktheme.svg" alt="Dark Theme">
            <span>Dark Theme</span>
          </div>
          <div class="menu-item logout-option">
            <img src="/agrify/icons/logout.svg" alt="Log Out">
            <span>Log Out</span>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <h2>Profile Information</h2>
      <div class="profile-card">
        <div class="left">
<?php
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$img_path = "../addanimals/profile.png"; // fallback

// Point to uploads folder outside profilePage
$upload_dir = dirname(__DIR__) . '/uploads/';
$web_upload_dir = "../uploads/";

foreach (['jpg', 'jpeg', 'png', 'gif'] as $ext) {
    $candidate = $upload_dir . "user_$user_id.$ext";
    if (file_exists($candidate)) {
        $img_path = $web_upload_dir . "user_$user_id.$ext";
        break;
    }
}
?>
          <img src="<?php echo htmlspecialchars($img_path); ?>" alt="User Photo" class="profile-img" id="profileImg" />
          <input type="file" id="profileImageInput" style="display:none;" accept="image/*">
          <label class="change-photo" id="changePhotoBtn">📷 Change Photo</label>
          <div class="info">
            <h3>Barbie B. Batumbakal</h3>
          </div>
        </div>
        <div class="right">
          <h3>Personal Details</h3>
          <p><strong>Full Name:</strong> <span id="fullName"></span></p>
          <p><strong>Email:</strong> <span id="email"></span></p>
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
    </div>
  </div>

  <!-- Edit Profile Modal -->
  <div id="editProfileModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="close-button" id="closeModal">&times;</span>
      <h3>Edit Profile</h3>
      <form id="editProfileForm">
        <label for="fullname">Full Name:</label>
        <input type="text" id="edit_fullname" name="fullname" required>
        <label for="email">Email:</label>
        <input type="email" id="edit_email" name="email" required>
        <label for="address">Address:</label>
        <input type="text" id="edit_address" name="address" required>
        <label for="dob">Date of Birth:</label>
        <input type="date" id="edit_dob" name="dob" required>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>

  <!-- Change Password Modal -->
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