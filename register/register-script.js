document.addEventListener("DOMContentLoaded", function () {
    const checkbox = document.querySelector(".agree-checkbox");
    const button = document.querySelector(".create-account-btn");
    const password = document.getElementById("password");
    const repassword = document.getElementById("repassword");
    const warning = document.getElementById("password-warning");
    const form = document.getElementById("registrationForm");

    function validateForm() {
        const inputs = form.querySelectorAll("input[required]");
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });

        const passwordsMatch = password.value === repassword.value;
        const checkboxChecked = checkbox.checked;

        // Show warning if passwords don't match and repassword is not empty
        if (!passwordsMatch && repassword.value !== "") {
            warning.classList.remove("hidden");
        } else {
            warning.classList.add("hidden");
        }

        // Enable button only if all conditions are met
        if (checkboxChecked && passwordsMatch && allFilled) {
            button.disabled = false;
            button.classList.add("enabled");
        } else {
            button.disabled = true;
            button.classList.remove("enabled");
        }
    }

    // Attach event listeners
    checkbox.addEventListener("change", validateForm);
    password.addEventListener("input", validateForm);
    repassword.addEventListener("input", validateForm);

    const requiredInputs = form.querySelectorAll("input[required]");
    requiredInputs.forEach(input => {
        input.addEventListener("input", validateForm);
    });
});
