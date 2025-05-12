<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrify Dashboard</title>
    <link rel="stylesheet" href="../Livestock Manage/livestockdetail.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <canvas id="salesChart"></canvas>
            </section>
        </main>
    </div>
    </div>

    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales',
            data: [50, 62, 100, 110, 150, 200],
            backgroundColor: '#4CAF50'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});

// Animate Progress Bars
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        document.getElementById("cows").style.width = "40%";
        document.getElementById("chicken").style.width = "35%";
        document.getElementById("goats").style.width = "25%";
        document.getElementById("ducks").style.width = "15%";
    }, 500);

    // 🔵 Circular Progress Animation
    const circle = document.querySelector(".circle-progress");
    const radius = 45;
    const circumference = 2 * Math.PI * radius;
    const percentage = 78; // Set your value here

    if (circle) {
        circle.style.strokeDasharray = `${circumference}`;
        circle.style.strokeDashoffset = circumference;

        setTimeout(() => {
            const offset = circumference - (percentage / 100) * circumference;
            circle.style.strokeDashoffset = offset;
        }, 300);
    }
});

// 🌦️ Auto-Detect Weather using OpenWeatherMap API
document.addEventListener("DOMContentLoaded", function () {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const apiKey = 'YOUR_API_KEY'; // 🔑 Replace with your OpenWeatherMap API key

            fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&appid=${apiKey}`)
                .then(res => res.json())
                .then(data => {
                    const temp = Math.round(data.main.temp);
                    const condition = data.weather[0].main;
                    const icon = weatherEmoji(condition);

                    document.getElementById('weather').textContent = `${icon} ${temp}°C ${condition}`;
                })
                .catch(err => {
                    console.error("Weather error:", err);
                    document.getElementById('weather').textContent = '☁️ Weather unavailable';
                });
        });
    } else {
        document.getElementById('weather').textContent = '🌍 Location unavailable';
    }

    function weatherEmoji(condition) {
        const icons = {
            Clear: "☀️",
            Clouds: "☁️",
            Rain: "🌧️",
            Drizzle: "🌦️",
            Thunderstorm: "⛈️",
            Snow: "❄️",
            Mist: "🌫️",
            Smoke: "🌫️",
            Haze: "🌫️",
            Dust: "🌬️",
            Fog: "🌫️",
            Sand: "🌬️",
            Ash: "🌋",
            Squall: "🌬️",
            Tornado: "🌪️"
        };
        return icons[condition] || "🌡️";
    }
});
const container = document.querySelector('.circular-progress-78');
const circle = container.querySelector('.progress-ring__circle');
const percentageDisplay = container.querySelector('#percentage');

const radius = 78;
const circumference = 2 * Math.PI * radius;

circle.style.strokeDasharray = `${circumference} ${circumference}`;
circle.style.strokeDashoffset = circumference;

function setProgress(percent) {
  const offset = circumference - (percent / 100) * circumference;
  circle.style.strokeDashoffset = offset;
  percentageDisplay.textContent = `${percent}%`;
}

const rangeInput = document.getElementById('rangeInput');
rangeInput.addEventListener('input', () => {
  setProgress(rangeInput.value);
});

setProgress(rangeInput.value);


    </script>
</body>
</html>
