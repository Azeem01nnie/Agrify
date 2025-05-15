document.addEventListener('DOMContentLoaded', function() {
    const logoutModal = document.getElementById('logoutModal');
    const closeButtons = document.querySelectorAll('.modalbtn.close');
    const confirmLogoutButton = document.getElementById('confirmLogout');
    
    // Trigger Logout Modal
    const logoutButton = document.querySelector('.logout button.menu-button'); 
    if (logoutButton) {
        logoutButton.addEventListener('click', function () {
            logoutModal.style.display = 'flex'; 
        });
    }

    // Close modals
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            logoutModal.style.display = 'none'; 
        });
    });

    // Confirm Logout
    confirmLogoutButton.addEventListener('click', function() {
        window.location.href = '/agrify/php/Livestock%20Manage/logout.php'; 
    });
});
