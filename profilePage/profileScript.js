document.addEventListener("DOMContentLoaded", () => {
    const openModalBtn = document.getElementById("openEditModal");
    const modal = document.getElementById("editProfileModal");
    const closeModalBtn = document.getElementById("closeModal");

    const openChangePasswordBtn = document.getElementById("openChangePasswordBtn");
    const changePasswordModal = document.getElementById("changePasswordModal");
    const closeChangePasswordBtn = document.getElementById("closeChangePasswordModal");

    // Burger Menu Functionality
    const burgerMenu = document.querySelector('.burger-menu');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (burgerMenu && sidebar && mainContent) {
        burgerMenu.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            burgerMenu.classList.toggle('active');
            mainContent.classList.toggle('sidebar-active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            if (!sidebar.contains(event.target) && !burgerMenu.contains(event.target)) {
                sidebar.classList.remove('active');
                burgerMenu.classList.remove('active');
                mainContent.classList.remove('sidebar-active');
            }
        });
    }

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
                    document.getElementById("email").textContent = data.data.email;
                    document.getElementById("address").textContent = data.data.address;
                    document.getElementById("dob").textContent = formatDate(data.data.dob); 
                    document.querySelector(".profile-card .left h3").textContent = data.data.full_name;
                    // Add this line to display the email
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
            
            // Safely parse the date string
            const dobText = document.getElementById("dob").textContent;
            const dobDate = new Date(dobText);
            let dobValue = "";
            if (!isNaN(dobDate.getTime())) {
                dobValue = dobDate.toISOString().split('T')[0];
            }
            document.getElementById("edit_dob").value = dobValue;

            // Pre-fill email
            document.getElementById("edit_email").value = document.getElementById("email").textContent;

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
    if (openChangePasswordBtn && changePasswordModal && closeChangePasswordBtn) {
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
    }

    // Handle change password form submission
    const changePasswordForm = document.getElementById("changePasswordForm");
    if (changePasswordForm) {
        changePasswordForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const currentPassword = document.getElementById("currentPassword").value;
            const newPassword = document.getElementById("newPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            // Basic validation for matching new passwords
            if (newPassword !== confirmPassword) {
                alert("The new passwords do not match.");
                return;
            }

            // Send the password change request to the backend
            fetch("backends/changePass.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    currentPassword: currentPassword,
                    newPassword: newPassword
                })
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === "success") {
                    alert("Password changed successfully!");
                    changePasswordModal.style.display = "none";
                } else {
                    alert("Error changing password: " + result.message);
                }
            })
            .catch(error => {
                console.error("Error changing password:", error);
                alert("An error occurred while changing the password.");
            });
        });
    }

    // Handle profile edit form submission
    const editProfileForm = document.getElementById("editProfileForm");
    if (editProfileForm) {
        editProfileForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const fullname = document.getElementById("edit_fullname").value;
            const address = document.getElementById("edit_address").value;
            const dob = document.getElementById("edit_dob").value;
            const email = document.getElementById("edit_email").value;

            fetch("backends/editProfile.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    fullname: fullname,
                    address: address,
                    dob: dob,
                    email: email
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
    }

    // Profile image change functionality
    const changePhotoBtn = document.getElementById("changePhotoBtn");
    const profileImageInput = document.getElementById("profileImageInput");
    const profileImg = document.getElementById("profileImg");

    if (changePhotoBtn && profileImageInput && profileImg) {
        changePhotoBtn.addEventListener("click", () => {
            profileImageInput.click();
        });

        profileImageInput.addEventListener("change", function() {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append("profile_image", this.files[0]);

                fetch("backends/uploadProfileImage.php", {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                .then(result => {
                    if (result === "success") {
                        // Force reload image (cache bust)
                        profileImg.src = profileImg.src.split('?')[0] + '?t=' + new Date().getTime();
                    } else {
                        alert("Failed to upload image: " + result);
                    }
                })
                .catch(() => {
                    alert("Error uploading image.");
                });
            }
        });
    }
});
