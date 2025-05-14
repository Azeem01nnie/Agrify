<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Livestock Manage/livestockdetail.css">
    <link rel="stylesheet" href="/agrify/php/Authentications/modalstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <a href="/agrify/php/Authentications/dashboard.php">
                <img src="/agrify/icons/dashboard_vector.svg" alt="Dashboard">
                Dashboard
            </a>
            <a href="/agrify/php/Livestock%20Manage/Livestockdetails.php" class="active">
                <img src="/agrify/icons/details.png" alt="Livestock Details">
                Livestock Details
            </a>
            <a href="/agrify/addanimals/index.php">
                <img src="/agrify/icons/cages.png" alt="Cages">
                Cages
            </a>
            <a href="/agrify/profilePage/profilePage.php">
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

            <div class="cont">
            <div class="stock">
                <section class="livestock">
                    <h2>Stocks and Details</h2>
                    <div class="progress">
                        <span>Cows</span>
                        <div class="bar" id="cows" style="width: 0;"></div>
                    </div>
                    <div class="infostock">
                        <span>Current sold: 100</span>
                        <span>Sellable stock: 100</span>
                    </div>
                    <div class="progress">
                        <span>Chicken</span>
                        <div class="bar" id="chicken" style="width: 0;"></div>
                    </div>
                    <div class="infostock">
                        <span>Current sold: 100</span>
                        <span>Sellable stock: 100</span>
                    </div>
                    <div class="progress">
                        <span>Goats</span>
                        <div class="bar" id="goats" style="width: 0;"></div>
                    </div>
                    <div class="infostock">
                        <span>Current sold: 100</span>
                        <span>Sellable stock: 100</span>
                    </div>
                    <div class="progress">
                        <span>Ducks</span>
                        <div class="bar" id="ducks" style="width: 0;"></div>
                    </div>
                    <div class="infostock">
                        <span>Current sold: 100</span>
                        <span>Sellable stock: 100</span>
                    </div>
                    <div class="progress">
                        <span>Others</span>
                        <div class="bar" id="ducks" style="width: 0;"></div>
                    </div>
                    <div class="infostock">
                        <span>Current sold: 100</span>
                        <span>Sellable stock: 100</span>
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
                <h2 class="expecter">expected monthly</h2>
                <div class="monthlyflexbox">
                  <p>December: <span><strong>70,000.00</strong></span></p>
                  <p>November: <span><strong>70,000.00</strong></span></p>
                  <p>October:  <span><strong>70,000.00</strong></span></p>
                  <p>September: <span><strong>70,000.00</strong></span></p>
                  <p>August: <span><strong>70,000.00</strong></span></p>
                  <p>July: <span><strong>70,000.00</strong></span></p>
                  <p>June: <span><strong>70,000.00</strong></span></p>
                  <p>May: <span><strong>70,000.00</strong></span></p>
                  <p>April: <span><strong>70,000.00</strong></span></p>
                  <p>March: <span><strong>70,000.00</strong></span></p>
                  <p>February: <span><strong>70,000.00</strong></span></p>
                  <p>January: <span><strong>70,000.00</strong></span></p>
                </div>
            </section>
             </div>
            </div>

            <!-- Sales Chart -->
            <section class="chart-section">
                <h2>Livestock Sales</h2>
                <section class="chart-section">
                <h2>Livestock Sales</h2>
                <canvas id="myChart" style="width:100%;max-width:1000px"></canvas>

<script>
const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "green",
      borderColor: "rgba(114, 114, 126, 0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      yAxes: [{ticks: {min: 6, max:16}}],
    }
  }
});
    </script>
            </section>
                <canvas id="salesChart"></canvas>
            </section>
        </main>
    </div>
    </div>

     <div id="logoutModal" class="viewmodal" role="dialog" aria-modal="true" tabindex="-1">
        <div class="modal-content2">
            <img src="/images/logov4.svg" class="modal-logo">
            <div class="modal-header">
                <h2>Logout Confirmation</h2>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-actions">
                <button class="modalbtn proceed" id="confirmLogout">Yes</button>
                <button class="modalbtn close">No</button>
            </div>
        </div>
    </div>

    <script src="modals.js"></script>
    <script src="livestockdet.js"></script>
</body>
</html>
