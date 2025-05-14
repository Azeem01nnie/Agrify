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
            <img src="/agrify/icons/logo.svg" alt="Library Logo">
        </div>
        <p class="username"><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?> | Admin</p>
        <div class="menu">
            <a href="../Authentications/dashboard.php" class="active">
                <img src="/agrify/icons/dashboard_vector.svg" alt="Dashboard">
                Dashboard
            </a>
            <a href="../Livestock%20Manage/Livestockdetails.php">
                <img src="/agrify/icons/details.png" alt="Livestock Details">
                Livestock Details
            </a>
            <a href="../addanimals/index.php">
                <img src="/agrify/icons/cages.png" alt="Cages">
                Cages
            </a>
            <a href="../addanimals/index.php">
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
                    <img src="/agrify/icons/cages.png" alt="AddCage">
                    <span> Add Cage</span>
                </button>
            </div>

            <div class="logout">
                <button class="menu-button">
                    <img src="/agrify/icons/logout.svg" alt="Menu">
                </button>
                <div class="dropdown-menu">
                    <div class="menu-item">
                        <img src="/agrify/icons/Profile (2).svg" alt="Profile">
                        <span>Profile</span>
                    </div>
                    <div class="menu-item">
                        <img src="/agrify/icons/accountsett.svg" alt="Account Settings">
                        <span>Account Settings</span>
                    </div>
                    <div class="menu-item">
                        <img src="/agrify/icons/languageicon.svg" alt="Language">
                        <span>Language</span>
                    </div>
                    <div class="menu-item">
                        <img src="/agrify/icons/darktheme.svg" alt="Dark Theme">
                        <span>Dark Theme</span>
                    </div>
                    <div class="menu-item logout-option">
                        <img src="/agrify/icons/logout.svg" alt="Log Out">
                        <span>Log Out</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="welcome-section">
                <div class="profile-welcome">
                    <img src="/agrify/icons/Profile.svg" alt="Profile">
                    <div class="welcome-text">
                        <h1>Hello, <?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?>!</h1>
                        <div id="date-time" class="date-time-display"></div>
                    </div>
                </div>
            </div>

            <div class="stats-cards">
                <div class="stat-card" data-link="add_animal.php">
                        <p>Cage: Name(1)</p>
                    <div class="stat-info">
                        <h3>230</h3>
                    </div>
                </div>
                <div class="stat-card" data-link="add_animal.php">
                        <p>Cage: Name(2)</p>
                    <div class="stat-info">
                        <h3>90</h3>
                    </div>
                </div>
                <div class="stat-card" data-link="add_animal.php">
                        <p>Cage: Name(3)</p>
                    <div class="stat-info">
                        <h3>20</h3>
                    </div>
                </div>
                <div class="stat-card" data-link="add_animal.php">
                        <p>Cage: Name(1)</p>
                    <div class="stat-info">
                        <h3>36</h3>
                    </div>
                </div>
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
    <script src="timecheck.js"></script>
</body>
</html>