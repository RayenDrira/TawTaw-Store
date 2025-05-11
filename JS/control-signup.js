document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form"); // Select the form element

  form.addEventListener("submit", function (e) {
    const fields = {
      email: document.querySelector("input[name='email']").value.trim(),
      password: document.querySelector("input[name='password']").value.trim(),
      confirmPassword: document
        .querySelector("input[name='confirm_password']")
        .value.trim(),
    };

    const regex = {
      email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, // Regex to validate email format
      specialChar: /[.@\-_/*$]/, // Updated to include * and $
      upperCase: /[A-Z]/,
      lowerCase: /[a-z]/,
    };

    const messages = {
      email: "Please enter a valid email address.",
      passwordEmpty: "Please enter your password.",
      passwordLength: "Password must be at least 8 characters long.",
      passwordSecurity:
        "Password must contain at least one special character (.@-/*$), one uppercase letter, and one lowercase letter.",
      confirmPassword: "Passwords do not match.",
    };

    // Validate email
    if (!fields.email || !regex.email.test(fields.email)) {
      alert(messages.email);
      e.preventDefault();
      return;
    }

    // Validate password
    if (!fields.password) {
      alert(messages.passwordEmpty);
      e.preventDefault();
      return;
    }

    if (fields.password.length < 8) {
      alert(messages.passwordLength);
      e.preventDefault();
      return;
    }

    if (
      !regex.specialChar.test(fields.password) ||
      !regex.upperCase.test(fields.password) ||
      !regex.lowerCase.test(fields.password)
    ) {
      alert(messages.passwordSecurity);
      e.preventDefault();
      return;
    }

    // Validate confirm password
    if (fields.password !== fields.confirmPassword) {
      alert(messages.confirmPassword);
      e.preventDefault();
      return;
    }
  });
});
