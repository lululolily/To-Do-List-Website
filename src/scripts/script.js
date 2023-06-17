document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("register-form");
  const passwordInput = document.getElementById("password");
  const confirmPasswordInput = document.getElementById("confirmpassword");

  form.addEventListener("submit", function(event) {
    const password = passwordInput.value;
    const confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
      event.preventDefault(); // Prevent form submission
      alert("Passwords do not match!");
    }
  });
});

