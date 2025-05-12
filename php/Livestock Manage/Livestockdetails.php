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
       <div class="profile">
                <a href="../../profilePage/profilePage.php">
                    <img src="profile.png" alt="Profile" />
                </a>
                <p><?php 
                if (isset($_SESSION['username'])) {
                    echo htmlspecialchars($_SESSION['username']);
                } else {
                    echo "Guest";
                }?>
            <span>Admin</span></p>
        </div>
      <nav class="nav">
        <a href="/agrify/php/Authentications/dashboard.php">Home</a>
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
                        <div class="bar" id="others" style="width: 0;"></div>
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
                <canvas id="salesChart"></canvas>
            </section>
        </main>
    </div>
    </div>

    <!-- Make sure Chart.js is included -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // 📊 Chart Initialization
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
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // 📶 Animate Progress Bars
    setTimeout(() => {
        document.getElementById("cows").style.width = "40%";
        document.getElementById("chicken").style.width = "35%";
        document.getElementById("goats").style.width = "25%";
        document.getElementById("ducks").style.width = "15%";
    }, 500);

    // 🔵 Circular Progress Animation
    const circleProgress = document.querySelector(".circle-progress");
    if (circleProgress) {
        const radius1 = 45;
        const circumference1 = 2 * Math.PI * radius1;
        const percentage1 = 78;

        circleProgress.style.strokeDasharray = `${circumference1}`;
        circleProgress.style.strokeDashoffset = `${circumference1}`;

        setTimeout(() => {
            const offset = circumference1 - (percentage1 / 100) * circumference1;
            circleProgress.style.strokeDashoffset = `${offset}`;
        }, 300);
    }

    // 🌦️ Weather Detection via OpenWeatherMap
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const apiKey = 'fea287f3fa31ebc969dfa9916be7f0d5';

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

    // 🎯 Interactive Circular Progress (with range input)
    const container = document.querySelector('.circular-progress-78');
    if (container) {
        const circle2 = container.querySelector('.progress-ring__circle');
        const percentageDisplay = container.querySelector('#percentage');
        const rangeInput = document.getElementById('rangeInput');

        const radius2 = 78;
        const circumference2 = 2 * Math.PI * radius2;

        circle2.style.strokeDasharray = `${circumference2} ${circumference2}`;
        circle2.style.strokeDashoffset = `${circumference2}`;

        function setProgress(percent) {
            const offset = circumference2 - (percent / 100) * circumference2;
            circle2.style.strokeDashoffset = offset;
            percentageDisplay.textContent = `${percent}%`;
        }

        rangeInput.addEventListener('input', () => {
            setProgress(rangeInput.value);
        });

        setProgress(rangeInput.value);
    }
});
</script>
    <script src="livestockdet.js"></script>
</body>
</html>
