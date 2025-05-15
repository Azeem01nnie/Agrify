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
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="brand">
      <a href="marketplace.php"><img src="baka.png" alt="Agrify" width="60" height="60" class="lugu" /></a>
      <div class="nav-links">
        <a href="#">Marketplace</a>
        <a href="#">Cage</a>
        <a href="#">Settings</a>
        <a href="#">Logout</a>
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
          <button class="buy-now">📱 Contact</button>
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
      <p><strong>🛖 Baliawsan Grande Zamboanga City</strong></p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d247
