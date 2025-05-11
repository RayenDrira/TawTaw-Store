document.addEventListener("DOMContentLoaded", function () {
  // Wait for the page to load before executing the JS
  const form = document.querySelector("form"); // Select the form element
  form.addEventListener("submit", function (e) {
    const email = document.querySelector("input[name='email']").value.trim();
    const password = document
      .querySelector("input[name='password']")
      .value.trim();

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex to validate email format

    // Check if both inputs are empty
    if (email === "" && password === "") {
      alert("Please enter your email and password.");
      e.preventDefault(); // Prevent form submission
      return;
    }

    // Validate email format
    if (!emailRegex.test(email)) {
      alert("Please enter a valid email address.");
      e.preventDefault();
      return;
    }

    // Check if password is empty
    if (password === "") {
      alert("Please enter your password.");
      e.preventDefault();
      return;
    }
  });
});
