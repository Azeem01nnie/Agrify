<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us - Agrify</title>
  <link rel="stylesheet" href="agrifystyle.css">
  <script src="https://cdn.tailwindcss.com"></script>
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

  <section class="bg-green-50 py-16 text-center">
    <h2 class="text-4xl font-extrabold text-green-800 mb-4">About Agrify</h2>
    <p class="text-lg text-gray-700 max-w-3xl mx-auto">Agrify is a farm livestock website that caters to both users and farms 
        at the same time, creating a digital bridge between livestock sellers and buyers. Our platform empowers farmers to 
        showcase their livestock—such as cattle, goats, pigs, and poultry—while enabling consumers, 
        traders, and businesses to browse, compare, and purchase animals directly from trusted sources.</p>
  </section>

  <section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-12 items-center">
      <div>
        <h3 class="text-3xl font-bold mb-4">Our Mission</h3>
        <p class="text-gray-700 text-lg leading-relaxed">Agrify empowers local farmers and buyers by creating a digital space where livestock can be traded with confidence. We aim to simplify farm-to-fork livestock trading with fair pricing, transparency, and trust.</p>
      </div>
      <img src="/agrify/php/Livestock Manage/iconss/polpol.jpg" alt="Farmers with livestock" class="rounded-lg shadow-lg"/>
    </div>
  </section>

  <!-- How It Works -->
  <section class="bg-green-100 py-20 text-center">
    <h3 class="text-3xl font-bold mb-12">How Agrify Works</h3>
    <div class="grid md:grid-cols-3 gap-12 max-w-6xl mx-auto px-4">
      <div>
        <img src="https://img.icons8.com/ios-filled/100/4CAF50/add-user-group-man-man.png" class="mx-auto mb-4"/>
        <h4 class="text-xl font-semibold mb-2">1. Create an Account</h4>
        <p class="text-gray-700">Farmers and buyers sign up to access our secure marketplace.</p>
      </div>
      <div>
        <img src="https://img.icons8.com/ios-filled/100/4CAF50/sheep.png" class="mx-auto mb-4"/>
        <h4 class="text-xl font-semibold mb-2">2. List or Browse Livestock</h4>
        <p class="text-gray-700">Farmers post animals for sale. Buyers browse categories like cows, goats, pigs, and more.</p>
      </div>
      <div>
        <img src="https://img.icons8.com/ios-filled/100/4CAF50/money-transfer.png" class="mx-auto mb-4"/>
        <h4 class="text-xl font-semibold mb-2">3. Make a Deal</h4>
        <p class="text-gray-700">Users connect directly to arrange secure transactions and deliveries.</p>
      </div>
    </div>
  </section>

  <!-- Team Section with Real Photos -->
  <section class="py-20 bg-white text-center">
    <h3 class="text-3xl font-bold mb-12">Meet the Team</h3>
    <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto px-4">
      <div>
        <a href="http://tantaloss.elementfx.com/">
          <img src="/agrify/php/Livestock Manage/iconss/jlprofile.png" alt="John Lloyd Climaco" class="rounded-full w-32 h-32 mx-auto mb-4 object-cover"/>
          <h4 class="text-xl font-semibold">John Lloyd Climaco</h4>
          <p class="text-gray-600">Backend Developer</p>
        </a>
      </div>
      <div>
        <a href="http://ericportfolio12.x10.mx/">
          <img src="/agrify/php/Livestock Manage/iconss/profile5.jpg" alt="Eric Libradilla jr" class="rounded-full w-32 h-32 mx-auto mb-4 object-cover"/>
          <h4 class="text-xl font-semibold">Eric Libradilla jr</h4>
          <p class="text-gray-600">Frontend Developer</p>
        </a>
      </div>
      <div>
        <a href="http://meetazee.elementfx.com">
        <img src="/agrify/php/Livestock Manage/iconss/profile4.jpg" alt="Mohammad Azeem Abdu" class="rounded-full w-32 h-32 mx-auto mb-4 object-cover"/>
        <h4 class="text-xl font-semibold">Mohammad Azeem S. Abdu</h4>
        <p class="text-gray-600">UX Designer</p>
      </div>
      <div>
        <a href="https://dharwebportfolio.infinityfreeapp.com/">
          <img src="/agrify/php/Livestock Manage/iconss/dharProfile.jpg" alt="Dharelle Ebol" class="rounded-full w-32 h-32 mx-auto mb-4 object-cover"/>
          <h4 class="text-xl font-semibold">Dharelle Ebol</h4>
          <p class="text-gray-600">Frontend Developer</p>
        </a>
      </div>
      <div>
        <a href="https://justinjames.x10.mx//connect/home.html">
        <img src="/agrify/php/Livestock Manage/iconss/profile3.jpg" alt="Justin James Alviar" class="rounded-full w-32 h-32 mx-auto mb-4 object-cover"/>
        <h4 class="text-xl font-semibold">Justin James Alviar</h4>
        <p class="text-gray-600">Frontend Developer</p>
      </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="bg-green-700 text-white text-center py-16">
    <div class="max-w-3xl mx-auto px-4">
      <h3 class="text-3xl font-bold mb-4">Ready to Buy or Sell Livestock?</h3>
      <p class="start">Join thousands of farmers and buyers across the country. Start trading livestock the smart way.</p>
      <a href="marketplace.php" class="bg-white text-green-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Visit Marketplace</a>
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
