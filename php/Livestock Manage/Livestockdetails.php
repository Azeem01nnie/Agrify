<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Livestock Manage/livestockdetail.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dashboard">
      
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
        <a href="../php/Authentications/dashboard.php">Home</a>
        <a href="/agrify/php/Livestock Manage/Livestockdetails.php" class="active">Livestock Details</a>
        <a href="../addanimals/index.php">Cages</a>
        <a href="#">Settings</a>
      </nav>
    </aside>

    <div class="main">
        <main class="content">
            <header>
                <h1 class="ld">Livestock Details <span id="weather">Loading weather...</span></h1>
                <a href="login.php" class="logout"><button>Logout</button></a>
            </header>
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
                  <p>December  : <span><strong>70,000.00</strong></span></p>
                  <p>November  : <span><strong>70,000.00</strong></span></p>
                  <p>October   :  <span><strong>70,000.00</strong></span></p>
                  <p>September : <span><strong>70,000.00</strong></span></p>
                  <p>August    : <span><strong>70,000.00</strong></span></p>
                  <p>July      : <span><strong>70,000.00</strong></span></p>
                  <p>June      : <span><strong>70,000.00</strong></span></p>
                  <p>May       : <span><strong>70,000.00</strong></span></p>
                  <p>April     : <span><strong>70,000.00</strong></span></p>
                  <p>March     : <span><strong>70,000.00</strong></span></p>
                  <p>February  : <span><strong>70,000.00</strong></span></p>
                  <p>January   : <span><strong>70,000.00</strong></span></p>
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
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
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
            </section>
        </main>
    </div>
    </div>

    <script>
        
    </script>
</body>
</html>
