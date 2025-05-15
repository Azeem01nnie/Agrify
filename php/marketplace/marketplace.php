<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agrify Marketplace</title>
  <link rel="stylesheet" href="marketplace.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="navbar">
    <div class="brand">
      <a href="marketplace.css"><img src="baka.png" alt="Agrify" width="60" height="60" class="lugu" /></a>
      <div class="nav-links">
      <a href="#">Marketplace</a>
      <a href="#">Livestock Food</a>
      <a href="#">Settings</a>
      <a href="/agrify/php/Livestock%20Manage/newlogin.php">Login</a>
      </div>
    </div>
    </div>
  </div>

  <div class="container">
    <main class="market">
<div class="carousel-container">
  <div class="carousel-track">
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/DIARIES.png" alt="Ad 1" /></div>
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/whales.png" alt="Ad 2" /></div>
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/BESTBUY.png" alt="Ad 3" /></div>
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/DIARIES.png" alt="Ad 1" /></div>
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/sale.png" alt="Ad 2" /></div>
    <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/DIARIES.png" alt="Ad 3" /></div>
  </div>
</div>
      <div class="top-bar">
        <div class="logo">Marketplace</div>
        <input type="text" placeholder="Search animals..." class="search-input" />
      </div>
      <div class="filter-group">
        <label>Animal Type:</label>
        <label><input type="checkbox" value="Goats" checked /> Goats</label>
        <label><input type="checkbox" value="Cows" checked /> Cows</label>
        <label><input type="checkbox" value="Chickens" checked /> Chickens</label>
        <label><input type="checkbox" value="Ducks" checked /> Ducks</label>
        <label><input type="checkbox" value="Plant" checked /> Others</label>
      </div>

      <h1>Agrify marketplace</h1>
      <div id="card-container" class="card-grid">
        <!-- JS will insert cards here -->
      </div>
    </main>
  </div>

  <script src="marketplace.js"></script>
</body>

</html>
