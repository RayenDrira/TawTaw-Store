document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.querySelector(".product-wrapper"); // The container holding the product cards
  const rightArrow = document.querySelector(".arrow-right"); // Right arrow button
  const leftArrow = document.querySelector(".arrow-left"); // Left arrow button

  let currentIndex = 0; // Index of the first visible product
  const visibleCount = 3; // Number of visible products at a time
  const totalProducts = wrapper.children.length; // Total number of products

  // Function to handle scrolling to the right
  function scrollRight() {
    if (currentIndex + visibleCount < totalProducts) {
      // Hide the far-left product
      wrapper.children[currentIndex].style.display = "none";

      // Show the next product that was not initially visible
      wrapper.children[currentIndex + visibleCount].style.display = "flex";

      // Update the index of the first visible product
      currentIndex++;
    }
  }

  // Function to handle scrolling to the left
  function scrollLeft() {
    if (currentIndex > 0) {
      // Hide the far-right product
      wrapper.children[currentIndex + visibleCount - 1].style.display = "none";

      // Show the previous product that was hidden
      wrapper.children[currentIndex - 1].style.display = "flex";

      // Update the index of the first visible product
      currentIndex--;
    }
  }

  // Attach the scroll functions to the arrow buttons
  rightArrow.addEventListener("click", scrollRight);
  leftArrow.addEventListener("click", scrollLeft);

  // Initialize the product visibility
  Array.from(wrapper.children).forEach((card, index) => {
    if (index >= visibleCount) {
      card.style.display = "none"; // Hide all products except the first three
    }
  });
});
