// Function to navigate to different pages
function navigateToPage(pageName) {
  switch (pageName) {
    case "favourates":
      window.location.href = "favourates.html";
      break;
    case "Shop":
      window.location.href = "shop.html";
      break;
    case "contact":
      window.location.href = "contact.html";
      break;
    case "cart":
      window.location.href = "cart.html";
      break;
    case "product":
      window.location.href = "product.html";
      break;
    case "buy":
      window.location.href = "pay.html";
      break;
    case "s-pay":
      window.location.href = "s-pay.html";
      break;
    case "signup":
      window.location.href = "signup.html";
      break;
    case "login":
      window.location.href = "login.html";
      break;
    case "s-index":
      window.location.href = "login.html";
      break;
    default:
      console.error("Page not found");
  }
}
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("button").forEach((button) => {
    if (
      [
        "favourates",
        "Shop",
        "contact",
        "cart",
        "product",
        "buy",
        "s-pay",
        "signup",
        "login",
        "s-login",
        "s-index",
      ].includes(button.id)
    ) {
      button.addEventListener("click", function () {
        navigateToPage(button.id);
      });
    }
  });
});
