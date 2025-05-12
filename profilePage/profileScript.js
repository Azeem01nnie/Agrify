document.addEventListener("DOMContentLoaded", () => {
    const openModalBtn = document.getElementById("openEditModal");
    const modal = document.getElementById("editProfileModal");
    const closeModalBtn = document.getElementById("closeModal");

    const openChangePasswordBtn = document.getElementById("openChangePasswordBtn");
    const changePasswordModal = document.getElementById("changePasswordModal");
    const closeChangePasswordBtn = document.getElementById("closeChangePasswordModal");

    if (openModalBtn && modal && closeModalBtn) {
        openModalBtn.addEventListener("click", () => {
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
    
});
