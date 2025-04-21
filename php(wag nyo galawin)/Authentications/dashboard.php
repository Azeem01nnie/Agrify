<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Authentications/dashboard-style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="dashboard">
      
        <aside class="sidebar">
            <h2>AGRIFY</h2>
            <div class="profile">
                <img src="profile.png" alt="Profile">
                <p>Azeem Abdu <span>Admin</span></p>
            </div>
            <nav>
                <a href="#" class="active">Home</a>
                <a href="#">Livestock Details</a>
                <a href="#">Cages</a>
                <a href="#">Settings</a>
            </nav>
        </aside>

    <div class="main">
        <main class="content">
            <header>
                <h1>Home <span id="weather">Loading weather...</span></h1>
                <a href="#" class="addcage"><button>+ Add Cage</button></a>
                <a href="login.php">Logout</a>
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
                <canvas id="salesChart"></canvas>
            </section>
        </main>
    </div>
    </div>

    <script src="dashboard-script.js"></script>
</body>
</html>
