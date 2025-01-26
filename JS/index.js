// Function to navigate to different pages
function navigateToPage(pageName) {
  switch (pageName) {
    case "favourates":
      window.location.href = "favourates.html";
      break;
    case "shop":
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
    default:
      console.error("Page not found");
  }
}
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("button").forEach((button) => {
    if (
      ["favourates", "shop", "contact", "cart", "product", "buy"].includes(
        button.id
      )
    ) {
      button.addEventListener("click", function () {
        navigateToPage(button.id);
      });
    }
  });
});
