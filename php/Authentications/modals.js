document.addEventListener('DOMContentLoaded', function() {
    const profileModal = document.getElementById('profileModal');
    const logoutModal = document.getElementById('logoutModal');
    const closeButtons = document.querySelectorAll('.modalbtn.close');
    const confirmLogoutButton = document.getElementById('confirmLogout');

    // Trigger Profile Modal
    document.querySelector('.menu-item:nth-child(1)').addEventListener('click', function() {
        profileModal.style.display = 'flex';
        profileModal.classList.add('active');
    });

    // Trigger Logout Modal
    document.querySelector('.logout-option').addEventListener('click', function() {
        logoutModal.style.display = 'flex';
        logoutModal.classList.add('active');
    });

    // Close modals
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            profileModal.style.display = 'none';
            profileModal.classList.remove('active');
            logoutModal.style.display = 'none';
            logoutModal.classList.remove('active');
        });
    });

    // Confirm Logout
    confirmLogoutButton.addEventListener('click', function() {
        window.location.href = '/agrify/php/Livestock%20Manage/Landingpage.php';
    });
});