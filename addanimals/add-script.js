document.addEventListener("DOMContentLoaded", function () {
    const cageGrid = document.querySelector(".cage-grid");
    const addCageBtn = document.querySelector(".add-cage");
    const filterSelect = document.getElementById("filter");

    const defaultImg = "/addanimals/image.png";

    let cages = [];

    function createCageCard(name, imgSrc) {
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
            window.location.href = `cage-details.html?name=${encodedName}&img=${encodedImg}`;
        });

        return cageCard;
    }

    function renderCages() {
        const existingCards = cageGrid.querySelectorAll(".cage-card:not(.add-cage)");
        existingCards.forEach(card => card.remove());

        cages.forEach(cage => {
            const card = createCageCard(cage.name, cage.imgSrc);
            cageGrid.insertBefore(card, addCageBtn);
        });
    }

    addCageBtn.addEventListener("click", function () {
        const cageName = prompt("Enter the name of the cage:");
        if (!cageName) return;

        let imgUrl = prompt("Enter image URL (or leave blank for default):");
        if (!imgUrl) imgUrl = defaultImg;

        cages.push({ name: cageName, imgSrc: imgUrl, createdAt: Date.now() });
        filterSelect.dispatchEvent(new Event("change")); // apply current filter after adding
    });

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

    // Apply default filter (A-Z) on page load
    filterSelect.dispatchEvent(new Event("change"));
});
