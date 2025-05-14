<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us - Agrify</title>
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

    <!-- Navigation Links -->
    <nav id="navMenu" class="nav-links">
      <ul>
        <li><a href="LandingPage.php">Home</a></li>
        <li><a href="newlogin.php">Marketplace</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>


  <!-- Contact Header -->
  <section class="bg-green-50 py-16 text-center">
    <h2 class="text-4xl font-extrabold text-green-800 mb-4">Contact Us</h2>
    <p class="text-lg text-gray-700 max-w-2xl mx-auto">Got questions or need help? We're here for you. Reach out to Agrify through the form or visit our office.</p>
  </section>

  <!-- Contact Form + Info -->
  <section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-2 gap-12">
      
      <!-- Contact Form -->
      <form class="space-y-6" action="mailto:your@email.com" method="POST">
        <div>
          <label class="block text-lg font-medium">Your Name</label>
          <input type="text" name="name" required class="w-full border border-gray-300 p-3 rounded-md mt-1" placeholder="Your Name">
        </div>
        <div>
          <label class="block text-lg font-medium">Email Address</label>
          <input type="email" name="email" required class="w-full border border-gray-300 p-3 rounded-md mt-1" placeholder="Your Email">
        </div>
        <div>
          <label class="block text-lg font-medium">Message</label>
          <textarea name="message" rows="5" required class="w-full border border-gray-300 p-3 rounded-md mt-1" placeholder="Your message here..."></textarea>
        </div>
        <button type="submit" class="bg-green-700 text-white px-6 py-3 rounded-md hover:bg-green-800 transition">Send Message</button>
      </form>

      <!-- Contact Info -->
      <div class="space-y-6">
        <div>
          <h4 class="text-xl font-semibold mb-2">Visit Us</h4>
          <p>Brgy. Baliwasan, Aquino Drive,<br>Zambnoanga, Philippines</p>
        </div>
        <div>
          <h4 class="text-xl font-semibold mb-2">Call Us</h4>
          <p>+63 912 345 6789</p>
        </div>
        <div>
          <h4 class="text-xl font-semibold mb-2">Email</h4>
          <p>support@agrify.com</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Google Map -->
  <section class="h-80">
    <iframe 
      class="w-full h-full"
      frameborder="0"
      style="border:0"
      <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d990.200212857562!2d122.05531543396316!3d6.914398408553178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2sph!4v1747104581822!5m2!1sen!2sph" 
        width="400" height="450" style="border:0;" allowfullscreen 
        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </iframe>
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
