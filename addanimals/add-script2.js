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

    // Cage Details from URL
    const params = new URLSearchParams(window.location.search);
    const cageName = params.get("name") || "Unknown Cage";
    const cageImg = params.get("img") || "default-cage.jpg";
    const cageDesc = params.get("desc") || "No description provided.";

    // Populate Cage Details
    document.getElementById("cage-title").innerText = decodeURIComponent(cageName);
    document.getElementById("cage-img").src = decodeURIComponent(cageImg);
    document.getElementById("cage-description").innerText =
        localStorage.getItem(`cage-desc-${cageName}`) || decodeURIComponent(cageDesc);

    // Popup handlers
    const togglePopup = () => popupContainer.classList.toggle("visible");
    addAnimalBtn.addEventListener("click", togglePopup);
    closeBtn.addEventListener("click", togglePopup);

    // Toggle visibility for 'Other' animal type input
    animalTypeSelect.addEventListener("change", () => {
        otherTypeInput.style.display = animalTypeSelect.value === "Other" ? "block" : "none";
    });

    // Add new animal row
    saveAnimalBtn.addEventListener("click", () => {
        const animalType =
            animalTypeSelect.value === "Other"
                ? otherTypeInput.value || "Unknown"
                : animalTypeSelect.value;

        const dob = dobInput.value || "N/A";

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

        animalCounter++;
        togglePopup();
    });

    // Back button logic
    window.goBack = () => window.history.back();
});
