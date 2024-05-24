function togglePasswordVisibility(button) {
    var passwordInput = button.previousElementSibling;
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      button.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      passwordInput.type = "password";
      button.innerHTML = '<i class="fas fa-eye"></i>';
    }
}