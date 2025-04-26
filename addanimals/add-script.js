document.addEventListener("DOMContentLoaded", function () {
    const cageGrid = document.querySelector(".cage-grid");
    const addCageBtn = document.querySelector(".add-cage");
    console.log(addCageBtn);
    const filterSelect = document.getElementById("filter");

    const modal = document.getElementById("cageModal");
    const closeBtn = document.querySelector(".close-btn");
    const saveBtn = document.getElementById("saveCageBtn");

    const defaultImg = "../addanimals/image.png";

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

    function fetchAndRenderCages() {
        fetch("/agrify/php/Authentications/get_cages.php")
            .then(response => response.json())
            .then(data => {
                cages = data.map(cage => ({
                    ...cage,
                    createdAt: Date.now()  // temporary for sorting
                }));
                filterSelect.dispatchEvent(new Event("change"));
            })
            .catch(error => {
                console.error("Failed to load cages:", error);
            });

    }

    function renderCages() {
        const cageGrid = document.querySelector('.cage-grid');
    
        // Clear existing cage cards except the "Add Cage" button
        cageGrid.innerHTML = `
            <div class="cage-card add-cage"><span>+</span><p>Add Cage</p></div>
        `;
    
        cages.forEach(cage => {
            const card = document.createElement('div');
            card.className = 'cage-card';
            card.dataset.cage_id = cage.cage_id;
    
            card.innerHTML = `
                <img src="${cage.image_path || '../uploads/default_image.png'}" alt="Cage Image">
                <h3>${cage.cage_name}</h3>
                <p>${cage.cage_desc || ''}</p>
                <div class="card-actions">
                    <button class="edit-cage">Edit</button>
                    <button class="delete-cage">Delete</button>
                </div>
            `;

            // Add event listener for the edit button to redirect to cage-details.html with relevant query parameters
            card.querySelector('.edit-cage').addEventListener('click', function() {
                const encodedName = encodeURIComponent(cage.cage_name);
                const encodedDesc = encodeURIComponent(cage.cage_desc || '');
                const encodedImg = encodeURIComponent(cage.image_path || '');

                window.location.href = `cage-details.php?cage_id=${cage.cage_id}&name=${encodedName}&desc=${encodedDesc}&img=${encodedImg}`;
            });
    
            cageGrid.appendChild(card);
        });
    }

    cageGrid.addEventListener('click', function (e) {
        const card = e.target.closest('.cage-card');
        if (!card || card.classList.contains('add-cage')) return;
        
        const cageId = card.dataset.cage_id;
        
        if (e.target.classList.contains('delete-cage')) {
            handleDeleteCage(cageId);
        }
    });
    
    // 🟩 Edit Handler
    function handleEditCage(cageId, card) {
    
        fetch("/agrify/php/Authentications/edit_cage.php", {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cage_id: cageId, cage_name: name.trim(), cage_desc: desc.trim() })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Cage updated successfully.");
                fetchAndRenderCages();
            } else {
                alert("Failed to update cage: " + data.message);
            }
        })
        .catch(err => {
            console.error("Edit error:", err);
            alert("An error occurred while editing the cage.");
        });
    }
    
    // 🟩 Delete Handler
    function handleDeleteCage(cageId) {
        if (!confirm("Are you sure you want to delete this cage?")) return;
    
        fetch("/agrify/php/Authentications/delete_cage.php", {
            method: "POST",
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ cage_id: cageId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Cage deleted successfully.");
                fetchAndRenderCages();
            } else {
                alert("Failed to delete cage: " + data.message);
            }
        })
        .catch(err => {
            console.error("Delete error:", err);
            alert("An error occurred while deleting the cage.");
        });
    }

    // Open modal
    cageGrid.addEventListener("click", function (e) {
        if (e.target.closest(".add-cage")) {
            console.log("Add Cage clicked!");
            modal.style.display = "flex";
        }
    });

    // Close modal
    closeBtn.addEventListener("click", function () {
        modal.style.display = "none";
    });

    // Save cage
    saveBtn.addEventListener("click", function () {
        console.log("Save button clicked!");
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
    
        const formData = new FormData();
        formData.append("cage_name", name);
        formData.append("cage_desc", description);
        if (file) {
            formData.append("cage_image", file);
        }
    
        // ✅ Post the form data to add_cages.php
        fetch("/agrify/php/Authentications/add_cages.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Cage added successfully.");
                modal.style.display = "none";
                fetchAndRenderCages(); // Reload cages to show the new one
            } else {
                alert("Failed to add cage: " + data.message);
            }
        })
        .catch(error => {
            console.error("Error saving cage:", error);
            alert("An error occurred while saving the cage.");
        });
    });

    filterSelect.addEventListener("change", function () {
        const val = filterSelect.value;

        if (val === "A-Z") {
            cages.sort((a, b) => a.cage_name.localeCompare(b.cage_name));
        } else if (val === "Z-A") {
            cages.sort((a, b) => b.cage_name.localeCompare(a.cage_name));
        } else if (val === "Newest") {
            cages.sort((a, b) => b.createdAt - a.createdAt);
        } else if (val === "Oldest") {
            cages.sort((a, b) => a.createdAt - b.createdAt);
        } else if (val === "Favorites") {
            alert("Favorites filtering not implemented yet.");
        }

        renderCages();
    });

    // 🟢 Load from DB on page load
    fetchAndRenderCages();
});