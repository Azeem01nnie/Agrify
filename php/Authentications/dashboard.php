<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Authentications/dashboard-style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>
<style>
    .sidebar {
    width: 250px;
    background: #4CAF50;
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
    <div class="dashboard">
        <div class="burger-menu">
            <div></div>
            <div></div>
            <div></div>
        </div>
      
        <aside class="sidebar">
      <h1 class="logo">AGRIFY</h1>
      <img src="" style="opacity: 0.5;" class="profile-img"/>
      <p class="username"><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?> | Admin</p>
      <nav class="nav">
        <a href="../php/Authentications/dashboard.php" class="active">Home</a>
        <a href="../Livestock%20Manage/Livestockdetails.php">Livestock Details</a>
        <a href="../addanimals/index.php">Cages</a>
        <a href="#">Settings</a>
      </nav>
    </aside>

    <div class="main">
        <main class="content">
            <header>
                <h1>Home <span id="weather">Loading weather...</span></h1>
                <a href="/agrify/addanimals/index.php" class="addcage"><button>+ Add Cage</button></a>
                <a href="login.php" class="logout"><button>Logout</button></a>
            </header>

            <div id="cages" class="cages">
                <div class="cage">CAGE 1</div>
                <div class="cage">CAGE 2 CHICKEN</div>
                <div class="cage">CAGE 3</div>
            </div>
            <div class="cont">
            <div class="stock">
                <section class="livestock">
                    <h2>Livestock Details</h2>
                    <div class="progress">
                        <span>Cows</span>
                        <div class="bar" id="cows" style="width: 0;"></div>
                    </div>
                    <div class="progress">
                        <span>Chicken</span>
                        <div class="bar" id="chicken" style="width: 0;"></div>
                    </div>
                    <div class="progress">
                        <span>Goats</span>
                        <div class="bar" id="goats" style="width: 0;"></div>
                    </div>
                    <div class="progress">
                        <span>Ducks</span>
                        <div class="bar" id="ducks" style="width: 0;"></div>
                    </div>
                </section>
             </div>
            <div class="finance">
            <section class="financial">
                <h2>Financial Statistics</h2>
                <div class="flex">
                    <div class="circular-progress-78">
                        <svg class="progress-ring" width="250" height="250">
                          <circle class="progress-ring__background" cx="135" cy="105" r="100" />
                          <circle class="progress-ring__circle" cx="135" cy="105" r="100" />
                        </svg>
                        <div class="progress-text">
                          <div class="label">Achieved</div>
                          <div id="percentage">78%</div>
                        </div>
                      </div>
                      
                      
                      
                      
                <div class="expect">
                <p>Expected Profit: <strong>700,000.00</strong></p>
                <p>Current Profit: <strong>150,000.00</strong></p>
               </div>
                </div>
            </section>
             </div>
            </div>

            <!-- Sales Chart -->
            <section class="chart-section">
                <h2>Livestock Sales</h2>
                <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>

<script>
var xValues = ["2021", "2022", "2023", "2024", "2025"];
var yValues = [55, 49, 44, 24, 15];
var barColors = ["#4CAF50", "#4CAF50","#4CAF50","#4CAF50","#4CAF50"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      lineTension: 0,
      backgroundColor: "#4CAF50",
      borderColor: "#4CAF50",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Livestock Graph"
    }
  }
});
</script>
            </section>
        </main>
    </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const burgerMenu = document.querySelector('.burger-menu');
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        burgerMenu.addEventListener('click', function() {
            console.log('Burger menu clicked'); // Debugging line
            sidebar.classList.toggle('active');
            burgerMenu.classList.toggle('active');
            content.classList.toggle('sidebar-active');
        });
    });
    </script>
</body>
</html>
