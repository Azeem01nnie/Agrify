// Removed the Add Cage functionality (as requested)

// Chart.js for Sales Data
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

// Burger Menu Functionality
document.addEventListener("DOMContentLoaded", function() {
    const burgerMenu = document.querySelector('.burger-menu');
    const sidebar = document.querySelector('.sidebar');
    const content = document.querySelector('.content');

    if (burgerMenu && sidebar) {
        burgerMenu.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event bubbling
            sidebar.classList.toggle('active');
            burgerMenu.classList.toggle('active');
            if(content) content.classList.toggle('sidebar-active');
        });

        // Optional: close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !burgerMenu.contains(event.target)) {
                sidebar.classList.remove('active');
                burgerMenu.classList.remove('active');
                if(content) content.classList.remove('sidebar-active');
            }
        });
    }
});



