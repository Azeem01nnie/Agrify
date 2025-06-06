<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agrify - Farm Livestock Marketplace</title>
  <link rel="stylesheet" href="agrifystyle.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .aspect-w-16 {
      position: relative;
      width: 100%;
      padding-bottom: 56.25%;
    }
    .aspect-w-16 iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <header>
  <div class="container">
    <h1 class="logo">Agrify</h1>
    
    <!-- Hamburger Icon -->
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
      &#9776;
    </button>

    <!-- Navigation Links -->
    <nav id="navMenu" class="nav-links">
      <ul>
        <li><a href="LandingPage.php">Home</a></li>
        <li><a href="/agrify/php/marketplace/marketplace.php">Marketplace</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>


  <!-- Hero Section -->
  <section class="bg-green-50 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-green-800">Buy & Sell Livestock with Ease</h2>
      <p class="text-xl mb-8 text-gray-700">Agrify is your trusted marketplace for farm animals — connecting buyers and sellers across the country.</p>
      <a href="/agrify/php/marketplace/marketplace.php" class="bg-green-700 text-white px-6 py-3 rounded-full text-lg hover:bg-green-800 transition">Browse Marketplace</a>
    </div>
  </section>

  <!-- Features Section -->
  <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h3 class="text-3xl font-bold mb-12">Why Choose Agrify?</h3>
      <div class="grid md:grid-cols-3 gap-12">
        <div>
          <img src="/agrify/php/Livestock Manage/iconss/icons8-sheep-96.png" alt="Cow Icon" class="mx-auto mb-4" />
          <h4 class="text-xl font-semibold mb-2">Wide Selection</h4>
          <p>Choose from cows, goats, chickens, pigs, and more from trusted farms.</p>
        </div>
        <div>
          <img src="/agrify//php/Livestock Manage/iconss/icons8-money-bag-96.png" alt="Money Icon" class="mx-auto mb-4" />
          <h4 class="text-xl font-semibold mb-2">Fair Pricing</h4>
          <p>Compare prices from different sellers and find the best deals.</p>
        </div>
        <div>
          <img src="/agrify//php/Livestock Manage/iconss/icons8-secure-100.png" alt="Trust Icon" class="mx-auto mb-4" />
          <h4 class="text-xl font-semibold mb-2">Secure Transactions</h4>
          <p>We help ensure both buyer and seller satisfaction through secure deals.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Livestock Categories -->
  <section class="bg-green-50 py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <h3 class="text-3xl font-bold mb-12">Livestock Categories</h3>
      <div class="grid md:grid-cols-4 gap-8">
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
          <img src="https://img.icons8.com/emoji/96/000000/cow-emoji.png" alt="Cow" class="mx-auto mb-2" />
          <h4 class="text-lg font-semibold">Cows</h4>
        </div>
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
          <img src="https://img.icons8.com/emoji/96/000000/goat-emoji.png" alt="Goat" class="mx-auto mb-2" />
          <h4 class="text-lg font-semibold">Goats</h4>
        </div>
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
          <img src="https://img.icons8.com/emoji/96/000000/pig-emoji.png" alt="Pig" class="mx-auto mb-2" />
          <h4 class="text-lg font-semibold">Pigs</h4>
        </div>
        <div class="bg-white p-6 rounded shadow hover:shadow-lg transition">
          <img src="https://img.icons8.com/emoji/96/000000/chicken-emoji.png" alt="Chicken" class="mx-auto mb-2" />
          <h4 class="text-lg font-semibold">Chickens</h4>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="bg-green-700 py-16 text-white text-center">
    <div class="max-w-4xl mx-auto px-4">
      <h3 class="text-3xl font-bold mb-4">Join Agrify Today</h3>
      <p class="start">Start browsing, buying, or selling livestock now on the most trusted online marketplace for farmers.</p>
      <a href="/agrify/php/Livestock%20Manage/newlogin.php" class="bg-white text-green-700 px-6 py-3 rounded-full text-lg font-semibold hover:bg-gray-100 transition">Get Started</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-gray-300 py-6">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
      <p>&copy; 2025 Agrify. All rights reserved.</p>
      <div class="flex space-x-4 mt-4 md:mt-0">
        <a href="#" class="hover:text-white">Privacy Policy</a>
        <a href="#" class="hover:text-white">Terms</a>
      </div>
    </div>
  </footer>

  <script>
  const toggle = document.getElementById('navToggle');
  const menu = document.getElementById('navMenu');

  toggle.addEventListener('click', () => {
    menu.classList.toggle('show');
  });
</script>


</body>
</html>
