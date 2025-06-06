<?php 
session_start();
require_once '../php/Config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agrify Dashboard</title>
  <link rel="stylesheet" href="add-style.css" />
  <link rel="stylesheet" href="/agrify/php/Authentications/modalstyle.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
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
<body>
    <div class="sidebar" id="sidebar">
        <div class="logo-container">
            <img src="/agrify/php/marketplace/baka.png" alt="Library Logo">
        </div>
        <p class="username"><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?> | Admin</p>
        <div class="menu">
            <a href="/agrify/php/Authentications/dashboard.php">
                <img src="/agrify/icons/dashboard_vector.svg" alt="Dashboard">
                Dashboard
            </a>
            <a href="/agrify/addanimals/index.php">
                <img src="/agrify/icons/cages.png" alt="Cages">
                Cages
            </a>
            <a href="/agrify/profilePage/profilePage.php">
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
                    <div class="user-name"><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?></div>
                    <div class="user-role">Admin</div>
                </div>
            </div>
            
            <div class="logout">
                <button class="menu-button">
                    <img src="/agrify/icons/logout.svg" alt="Menu">
                </button>
            </div>
        </div>

        <div class="content">
    <div class="cont">
      <header>
        <h1>Cages</h1>
        <br>
      </header>
      <hr>

      <div class="filter-bar">
        <label for="filter">Filter by:</label>
        <select id="filter">
          <option>Newest</option>
          <option>Oldest</option>
          <option>A-Z</option>
          <option>Z-A</option>
          <option>Favorites</option>
        </select>
      </div>

      <div class="cage-grid">
        
        <div class="cage-card add-cage"><span>+</span><p>Add Cage</p></div>
      </div>
    </div>
  </div>
</div>

<div id="cageModal" class="modal">
  <div class="modal-content">
    <span class="close-btn">&times;</span>
    <h2>Add New Cage</h2>

    <div class="form-group">
      <label for="cageName">Cage name</label>
      <input type="text" id="cageName" name="cage_name" required />
      <span class="required-note">required</span>
    </div>

    <div class="form-group">
      <label for="thumbnail">Cage thumbnail (Optional)</label>
      <input type="file" id="thumbnail" name="cage_image" />
    </div>

    <div class="form-group">
      <label for="description">Cage description (Optional)</label>
      <textarea id="description" rows="4" name="cage_desc"></textarea>
    </div>

    <button id="saveCageBtn" class="create-button">Create</button>
  </div>
</div>

  <div id="logoutModal" class="viewmodal" role="dialog" aria-modal="true" tabindex="-1">
          <div class="modal-content2">
              <img src="/agrify/icons/warning_vector.svg" class="modal-logo">
              <div class="modal-header">
                  <h2>Logout Confirmation</h2>
              </div>
              <div class="modal-body">
                  <p>Are you sure you want to log out?</p>
              </div>
              <div class="modal-actions">
                  <button class="modalbtn proceed" id="confirmLogout">Yes</button>
                  <button class="modalbtn close">No</button>
              </div>
          </div>
      </div>

  <script src="/agrify/php/Authentications/modals.js"></script>
  <script src="add-script.js"></script>
</body>
</html>
