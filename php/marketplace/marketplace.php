<?php
session_start();
require_once '../Config/database.php';
require_once 'MarketplaceManager.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=Agrify", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $marketplaceManager = new MarketplaceManager($pdo);
    $animals = $marketplaceManager->getAllAnimalsWithOwners();
} catch (PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    $animals = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agrify Marketplace</title>
  <link rel="stylesheet" href="marketplace.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin: 10px;
      width: 200px;
      height:400px;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      
      
    }
    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 4px;
    }
    .card-content {
      margin-top: 10px;
      border: 1px solid whitesmoke;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-title {
      font-size: 1.2em;
      font-weight: bold;
      margin-bottom: 5px;
      padding-bottom: 10px;
    }
    .card-info {
      color: #666;
      font-size: 0.9em;
      
    }
    .card-owner {
      font-style: italic;
      color: #888;
      margin-bottom: 20px;
      font-weight: 700;
    }
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <div class="brand">
      <a href="marketplace.css"><img src="baka.png" alt="Agrify" width="60" height="60" class="lugu" /></a>
      <div class="nav-links">
        <a href="/agrify/php/marketplace/marketplace.php">Marketplace</a>
        <a href="/agrify/php/marketplace/feed.html">Livestock Food</a>
        <a href="/agrify/php/Livestock Manage/LandingPage.php">Home</a>
        <a href="/agrify/php/Livestock%20Manage/newlogin.php">Login</a>
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
          <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/whales.png" alt="Ad 2" /></div>
          <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/DIARIES.png" alt="Ad 3" /></div>
          <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/whales.png" alt="Ad 2" /></div>
          <div class="carousel-item"><img src="/agrify/php/Livestock Manage/iconss/sale.png" alt="Ad 2" /></div>
        </div>
      </div>

      <div class="top-bar">
        <div class="logo">Marketplace</div>
        <form id="searchForm" onsubmit="return false;">
          <input type="text" placeholder="Search animals..." class="search-input" id="searchInput" />
        </form>
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
        <?php if (empty($animals)): ?>
          <p>No animals available in the marketplace at the moment.</p>
        <?php else: ?>
          <?php foreach ($animals as $animal): ?>
            <?php
              $type = strtolower(trim($animal['animal_type'] ?? ''));
              $defaultImages = [
                  'goat' => 'images/goat.png',
                  'cow' => 'images/cow.png',
                  'chicken' => 'images/chicken.png',
                  'duck' => 'images/duck.png',
                  'horse' => 'images/horse.png',
                  'goats' => 'images/goat.png',
                  'cows' => 'images/cow.png',
                  'chickens' => 'images/chicken.png',
                  'ducks' => 'images/duck.png',
                  'horses' => 'images/horse.png'
              ];
              $imagePath = $defaultImages[$type] ?? 'images/default-animal.png';
              $animalId = htmlspecialchars($animal['animal_id'] ?? 0);
            ?>
            <a href="animaldescription.php?id=<?php echo $animalId; ?>" class="card-link" style="text-decoration: none; color: inherit;">
              <div class="card" id="animal-<?php echo $animalId; ?>" data-animal-type="<?php echo htmlspecialchars($animal['animal_type'] ?? ''); ?>">
                <img src="<?php echo htmlspecialchars($imagePath); ?>"
                    alt="<?php echo htmlspecialchars($animal['animal_type'] ?? 'Animal'); ?>"
                    onerror="this.src='images/default-animal.png'">
                <div class="card-content">
                  <div class="card-title"><?php echo htmlspecialchars($animal['animal_type'] ?? 'Unnamed Animal'); ?></div>
                  <div class="card-owner">
                    Owner: <?php echo htmlspecialchars($animal['owner_name'] ?? 'Anonymous'); ?>
                  </div>
                  <div class="card-info">
                    <p>Date of Birth: <?php echo htmlspecialchars($animal['date_of_birth'] ?? 'Unknown'); ?></p>
                    <p>Cage: <?php echo htmlspecialchars($animal['cage_name'] ?? 'Unassigned'); ?></p>
                  </div>
                </div>
              </div>
            </a>
          <?php endforeach; ?>

        <?php endif; ?>
      </div>
    </main>
  </div>

  <script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
      e.preventDefault();
    });

    document.getElementById('searchInput').addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase();
      const cards = document.querySelectorAll('.card');
      
      cards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const type = card.querySelector('.card-info').textContent.toLowerCase();
        const owner = card.querySelector('.card-owner').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || type.includes(searchTerm) || owner.includes(searchTerm)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });

    document.querySelectorAll('.filter-group input[type="checkbox"]').forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const checkedTypes = Array.from(document.querySelectorAll('.filter-group input[type="checkbox"]:checked'))
          .map(cb => cb.value.toLowerCase());
        
        document.querySelectorAll('.card').forEach(card => {
          const animalType = card.dataset.animalType.toLowerCase();
          if (checkedTypes.includes(animalType) || checkedTypes.includes('others')) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  </script>

</body>
</html>