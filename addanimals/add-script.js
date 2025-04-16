document.addEventListener("DOMContentLoaded", function () {
    const cageGrid = document.querySelector(".cage-grid");
    const addCageBtn = document.querySelector(".add-cage");
    const filterSelect = document.getElementById("filter");

    const modal = document.getElementById("cageModal");
    const closeBtn = document.querySelector(".close-btn");
    const saveBtn = document.getElementById("saveCageBtn");

    const defaultImg = "/addanimals/image.png";

    let cages = [];

    function createCageCard(name, imgSrc, description) {
        const cageCard = document.createElement("div");
        cageCard.classList.add("cage-card");

        const img = document.createElement("img");
        img.src = imgSrc || defaultImg;
        img.alt = name;

        const p = document.createElement("p");
        p.innerText = name;

        cageCard.appendChild(img);
        cageCard.appendChild(p);

        cageCard.addEventListener("click", function () {
            const encodedName = encodeURIComponent(name);
            const encodedImg = encodeURIComponent(img.src);
            const encodedDesc = encodeURIComponent(description || "");
            window.location.href = `cage-details.html?name=${encodedName}&img=${encodedImg}&desc=${encodedDesc}`;
        });

        return cageCard;
    }

    function renderCages() {
        const existingCards = cageGrid.querySelectorAll(".cage-card:not(.add-cage)");
        existingCards.forEach(card => card.remove());

        cages.forEach(cage => {
            const card = createCageCard(cage.name, cage.imgSrc, cage.description);
            cageGrid.insertBefore(card, addCageBtn);
        });
    }

    // Open modal
    addCageBtn.addEventListener("click", function () {
        modal.style.display = "flex";
    });

    // Close modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Save cage
    saveBtn.addEventListener("click", function () {
        const cageNameInput = document.getElementById("cageName");
        const cageDescInput = document.getElementById("description");
        const cageImgInput = document.getElementById("thumbnail");

        const name = cageNameInput.value.trim();
        const description = cageDescInput.value.trim();
        const file = cageImgInput.files[0];

        if (!name) {
            alert("Cage name is required.");
            return;
        }

        const addCageToList = (imgSrc) => {
            const cage = {
                name,
                imgSrc: imgSrc || defaultImg,
                description,
                createdAt: Date.now()
            };

            cages.push(cage);
            filterSelect.dispatchEvent(new Event("change"));
            modal.style.display = "none";

            // Reset form
            cageNameInput.value = "";
            cageDescInput.value = "";
            cageImgInput.value = "";
        };

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                addCageToList(e.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            addCageToList(defaultImg);
        }
    });

    // Filtering logic
    filterSelect.addEventListener("change", function () {
        const val = filterSelect.value;

        if (val === "A-Z") {
            cages.sort((a, b) => a.name.localeCompare(b.name));
        } else if (val === "Z-A") {
            cages.sort((a, b) => b.name.localeCompare(a.name));
        } else if (val === "Newest") {
            cages.sort((a, b) => b.createdAt - a.createdAt);
        } else if (val === "Oldest") {
            cages.sort((a, b) => a.createdAt - b.createdAt);
        } else if (val === "Favorites") {
            alert("Favorites filtering not implemented yet.");
        }

        renderCages();
    });

    // Default sort on load
    filterSelect.dispatchEvent(new Event("change"));
});
