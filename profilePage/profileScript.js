document.addEventListener("DOMContentLoaded", () => {
    const openModalBtn = document.getElementById("openEditModal");
    const modal = document.getElementById("editProfileModal");
    const closeModalBtn = document.getElementById("closeModal");

    const openChangePasswordBtn = document.getElementById("openChangePasswordBtn");
    const changePasswordModal = document.getElementById("changePasswordModal");
    const closeChangePasswordBtn = document.getElementById("closeChangePasswordModal");

    // Function to load profile data dynamically into the page
    function loadProfileData() {
        fetch("backends/loadProfile.php")
            .then(response => response.json())
            .then(data => {
                console.log(data); // Log the fetched data to the console
                if (data.status === 'error') {
                    alert("Error fetching profile data: " + data.message);
                } else {
                    // Dynamically populate the profile details
                    document.getElementById("fullName").textContent = data.data.full_name;
                    document.getElementById("address").textContent = data.data.address;
                    document.getElementById("dob").textContent = formatDate(data.data.dob); // Format DOB if necessary
                }
            })
            .catch(error => {
                console.error("Error fetching profile data:", error);
            });
    }

    // Function to format the date (if necessary)
    function formatDate(dateString) {
        const date = new Date(dateString);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    // Call the loadProfileData function on page load
    loadProfileData();

    // Modal functionality for editing profile
    if (openModalBtn && modal && closeModalBtn) {
        openModalBtn.addEventListener("click", () => {
            // Pre-fill the modal input fields with current profile values
            document.getElementById("edit_fullname").value = document.getElementById("fullName").textContent;
            document.getElementById("edit_address").value = document.getElementById("address").textContent;
            document.getElementById("edit_dob").value = new Date(document.getElementById("dob").textContent).toISOString().split('T')[0];

            modal.style.display = "flex";
        });

        closeModalBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    }

    // Change password modal
    openChangePasswordBtn.addEventListener("click", (e) => {
        e.preventDefault(); // Prevent default anchor behavior
        changePasswordModal.style.display = "flex";
    });

    closeChangePasswordBtn.addEventListener("click", () => {
        changePasswordModal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === changePasswordModal) {
            changePasswordModal.style.display = "none";
        }
    });

    document.getElementById("editProfileForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const fullname = document.getElementById("edit_fullname").value;
        const address = document.getElementById("edit_address").value;
        const dob = document.getElementById("edit_dob").value;

        fetch("backends/editProfile.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                fullname: fullname,
                address: address,
                dob: dob
            })
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === "success") {
                alert("Profile updated successfully!");
                modal.style.display = "none";
                loadProfileData(); // Refresh profile info on the page
            } else {
                alert("Update failed: " + result.message);
            }
        })
        .catch(error => {
            console.error("Error updating profile:", error);
            alert("An error occurred while updating the profile.");
        });
    });

});
