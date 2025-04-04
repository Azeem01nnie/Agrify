document.addEventListener("DOMContentLoaded", () => {
    // Cached DOM Elements
    const addAnimalBtn = document.querySelector(".add-animal-btn");
    const popupContainer = document.querySelector(".popup-container");
    const closeBtn = document.querySelector(".close-btn");
    const saveAnimalBtn = document.getElementById("saveAnimal");
    const animalTypeSelect = document.getElementById("animalType");
    const otherTypeInput = document.getElementById("otherType");
    const dobInput = document.getElementById("dob");
    const tbody = document.querySelector(".livestock-body");

    let animalCounter = 1; // Start from 1 and increment

    // Cage Details
    const params = new URLSearchParams(window.location.search);
    const cageName = params.get("name") || "Unknown Cage";
    const cageImg = params.get("img") || "default-cage.jpg";
    const cageDesc = params.get("desc") || "Click to edit description...";

    const titleElement = document.getElementById("cage-title");
    const imgElement = document.getElementById("cage-img");
    const descElement = document.getElementById("cage-description");
    const saveBtn = document.getElementById("save-description");

    // Load Cage Details
    titleElement.innerText = decodeURIComponent(cageName);
    imgElement.src = decodeURIComponent(cageImg);
    descElement.innerText = localStorage.getItem(`cage-desc-${cageName}`) || decodeURIComponent(cageDesc);

    // Toggle Popup Visibility
    const togglePopup = () => popupContainer.classList.toggle("visible");

    addAnimalBtn.addEventListener("click", togglePopup);
    closeBtn.addEventListener("click", togglePopup);

    // Show Input if "Other" is Selected
    animalTypeSelect.addEventListener("change", () => {
        otherTypeInput.style.display = animalTypeSelect.value === "Other" ? "block" : "none";
    });

    // Add Animal to Table
    saveAnimalBtn.addEventListener("click", () => {
        let animalType = animalTypeSelect.value === "Other"
            ? otherTypeInput.value || "Unknown"
            : animalTypeSelect.value;

        const dob = dobInput.value || "N/A";

        // Append Row
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${animalCounter}</td>
            <td>${animalType}</td>
            <td>${dob}</td>
            <td><input type="checkbox"></td>
            <td><input type="text" class="price-input" placeholder="Enter amount"></td>
            <td><input type="checkbox"></td>
        `;
        tbody.appendChild(row);

        animalCounter++; // Increment for next ID
        togglePopup();   // Close popup
    });

    // Save Cage Description
    saveBtn.addEventListener("click", () => {
        localStorage.setItem(`cage-desc-${cageName}`, descElement.innerText);
        alert("Description saved!");
    });

    // Go Back Function
    window.goBack = () => window.history.back();
});
