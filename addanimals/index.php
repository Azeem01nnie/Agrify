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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="dashboard">
    <aside class="sidebar">
      <h2>AGRIFY</h2>
      <div class="profile">
        <a href="../profilePage/profilePage.php">
          <img src="profile.png" alt="Profile" />
        </a>
        
        <p><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?>
           <span>Admin</span></p>
      </div>
      <nav>
        <a href="/agrify/php/Authentications/dashboard.php" >Home</a>
        <a href="#">Livestock Details</a>
        <a href="/agrify/addanimals/index.php" class="active">Cages</a>
        <a href="#">Settings</a>
      </nav>
    </aside>
    <div class="cont">

    <div class="main-content">
      <header>
        <h1>Cages</h1>
        <button class="add-cage-btn">+ Add Cage</button>
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

  <script src="add-script.js"></script>
</body>
</html>
