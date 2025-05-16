<?php
require_once '../Config/database.php';
require_once 'MarketplaceManager.php';

$animal = null;

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=Agrify", 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $marketplaceManager = new MarketplaceManager($pdo);
        $animal = $marketplaceManager->getAnimalById($_GET['id']);

    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Agrify</title>
  <link rel="stylesheet" href="description.css">
  <style>
    /* Contact Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      padding-top: 100px;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      position: relative;
    }

    .close {
      color: #aaa;
      font-size: 28px;
      font-weight: bold;
      position: absolute;
      top: 10px;
      right: 20px;
      cursor: pointer;
    }

    .close:hover {
      color: black;
    }

    iframe {
      margin-top: 10px;
      width: 100%;
      border: 0;
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">
      <a href="marketplace.php"><img src="baka.png" alt="Agrify" width="60" height="60" class="lugu" /></a>
      <div class="nav-links">
        <a href="/agrify/php/marketplace/marketplace.php">Marketplace</a>
        <a href="/agrify/php/marketplace/feed.html">Livestock Food</a>
        <a href="/agrify/php/Livestock Manage/LandingPage.php">Home</a>
        <a href="/agrify/php/Livestock%20Manage/newlogin.php">Login</a>
      </div>
    </div>
  </div>

  <!-- Back button -->
  <div class="back-button">
    <button onclick="history.back()">← Back</button>
  </div>

  <!-- Product -->
  <div class="product-container">
    <?php if ($animal): ?>
      <div class="product-image">
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
        <img src="<?php echo htmlspecialchars($imagePath); ?>"
                    alt="<?php echo htmlspecialchars($animal['animal_type'] ?? 'Animal'); ?>"

                    onerror="this.src='images/default-animal.png'">
      </div>
      <div class="product-details">
        <h1><?php echo htmlspecialchars($animal['animal_type']); ?></h1>
        <div class="price">₱<?php echo htmlspecialchars($animal['price']); ?></div>
        <div class="info"><strong>Cage Description</strong></div>
        <p><?php echo htmlspecialchars($animal['cage_desc'] ?? 'No description available.'); ?></p>
        <div class="info"><strong>Breedable: </strong><?php echo $animal['breedable'] ? 'Yes' : 'No'; ?></div>
        <div class="info"><strong>Date of Birth: </strong><?php echo htmlspecialchars($animal['date_of_birth']); ?></div>
        <div class="buttons">
          <button class="buy-now" onclick="openModal()">📱 Contact</button>
        </div>
      </div>
    <?php else: ?>
      <p style="padding: 20px; font-size: 1.2em;">Animal not found or invalid ID.</p>
    <?php endif; ?>
  </div>

  <!-- Contact Modal -->
  <div id="contactModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Contact Seller</h2>
      <p>You can reach the seller at:</p>
      <p><strong>📞 0912 345 6789</strong></p>
      <p><strong>🛖 Baliawsan Grande, Zamboanga City</strong></p>
      
      <!-- Google Maps Embed -->
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125397.1767106281!2d122.00000000000001!3d6.910278000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x325041bb9f5c4c65%3A0xa4206d0fc9e9aa6f!2sBaliwasan%20Grande%2C%20Zamboanga%2C%20Zamboanga%20Sibugay!5e0!3m2!1sen!2sph!4v1715856750000!5m2!1sen!2sph"
        height="250"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>

  <!-- JavaScript for modal -->
  <script>
    function openModal() {
      document.getElementById("contactModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("contactModal").style.display = "none";
    }

    // Close modal if user clicks outside of it
    window.onclick = function(event) {
      const modal = document.getElementById("contactModal");
      if (event.target == modal) {
        closeModal();
      }
    }
  </script>

</body>
</html>
