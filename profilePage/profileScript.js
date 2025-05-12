document.addEventListener("DOMContentLoaded", () => {
  const openModalBtn = document.getElementById("openEditModal");
  const modal = document.getElementById("editProfileModal");
  const closeModalBtn = document.getElementById("closeModal");

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
});
