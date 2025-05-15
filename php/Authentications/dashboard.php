<?php
session_start();
require_once '../Config/database.php';
require_once 'DashboardCageManager.php'; // Adjust path if needed

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or show error if needed
    die("User not logged in.");
}

$userId = $_SESSION['user_id'];
$cageManager = new DashboardCageManager($pdo);
$cageStats = $cageManager->getTopCagesWithAnimals($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Authentications/dashboard-style.css">
    <link rel="stylesheet" href="/agrify/php/Authentications/modalstyle.css">
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
            <a href="/agrify/php/Authentications/dashboard.php" class="active">
                <img src="/agrify/icons/dashboard_vector.svg" alt="Dashboard">
                Dashboard
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
                        <img src="/agrify/icons/languageicon.svg" alt="Language">
                        <span>Language</span>
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
                    <img src="/agrify/icons/Profile 1.svg" alt="Profile">
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
            <?php if (count($cageStats) === 0): ?>
                <div class="stat-card">
                    <p>No cages found</p>
                    <div class="stat-info">
                        <h3>0</h3>
                    </div>
                </div>
            <?php else: ?>
                    <?php foreach ($cageStats as $cage): ?>
                        <div class="stat-card" data-link="add_animal.php">
                            <p>Cage: <?php echo htmlspecialchars($cage['cage_name']); ?></p>
                            <div class="stat-info">
                                <h3><?php echo htmlspecialchars($cage['animal_count']); ?></h3>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="dashboard-grid">
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
                    <div class="circular-progress-wrapper">
                        <canvas id="profitChart"></canvas>
                        <div class="progress-text-overlay">
                            <div class="label">Achieved</div>
                            <div id="percentage">0%</div>
                        </div>
                    </div>
                    
                      
                <div class="expect">
                    <div class="input-section">
                            <label for="currentProfit">Enter Current Profit: </label>
                            <input type="number" id="currentProfit" placeholder="Enter amount" />
                            <button onclick="updateChart()">Update Chart</button>
                    </div>
                        
                    <div class="expect">
                        <p>Expected Profit: <strong>700,000.00</strong></p>
                    </div>
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

    <div id="logoutModal" class="viewmodal" role="dialog" aria-modal="true" tabindex="-1">
        <div class="modal-content2">
            <img src="/agrify/icons/warning_vector.svg" class="modal-logo">
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
    <script src="timecheck.js"></script>
    <script src="datalink.js"></script>


    <script>
    // Set expected profit value
    const expectedProfit = 700000;

    // Initialize values
    let currentProfit = 10;
    let percentageAchieved = 0;

    // Get chart context
    const ctx = document.getElementById('profitChart').getContext('2d');

    // Create the Chart.js doughnut chart
    const profitChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Achieved', 'Remaining'],
            datasets: [{
                data: [percentageAchieved, 100 - percentageAchieved],
                backgroundColor: ['#4CAF50', '#e0e0e0'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '80%', // Use this instead of cutoutPercentage in Chart.js 3+
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        }
    });

    // Update function
    function updateChart() {
        const userInput = document.getElementById('currentProfit').value;
        currentProfit = parseFloat(userInput);

        if (isNaN(currentProfit) || currentProfit < 0) {
            alert("Please enter a valid number.");
            return;
        }

        // Calculate percentage, clamp at 100
        percentageAchieved = Math.min((currentProfit / expectedProfit) * 100, 100);

        // Update chart data
        profitChart.data.datasets[0].data = [percentageAchieved, 100 - percentageAchieved];
        profitChart.update();

        // Update text inside the doughnut
        document.getElementById('percentage').innerText = percentageAchieved.toFixed(2) + '%';
    }
</script>
</body>
</html>