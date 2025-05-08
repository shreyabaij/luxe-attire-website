const cartIcon = document.querySelector("#cart-icon");
const cart = document.querySelector(".cart");
const cartClose = document.querySelector("#cart-close");
cartIcon.addEventListener("click", () => cart.classList.add("active"));
cartClose.addEventListener("click", () => cart.classList.remove("active"));

const addCardButtons = document.querySelectorAll(".add-cart");
addCardButtons.forEach((button) => {
  button.addEventListener("click", (event) => {
    const productBox = event.target.closest(".product-box");
    addToCart(productBox);
  });
});
const cartContent = document.querySelector(".cart-content");
const addToCart = (productBox) => {
  const productImgSrc = productBox.querySelector("img").src;
  const productTitle = productBox.querySelector(".product-title").textContent;
  const productPrice = productBox.querySelector(".price").textContent;

  const cartItems = cartContent.querySelectorAll(".cart-product-title");
  for (let item of cartItems) {
    if (item.textContent === productTitle) {
      alert("This item is already in cart.");
      return;
    }
  }

  const cartBox = document.createElement("div");
  cartBox.classList.add("cart-box");
  cartBox.innerHTML = `
 <img src="${productImgSrc}" class="cart-img">
          <div class="cart-details">
            <h2 class="cart-product-title">${productTitle}</h2>
            <span class="cart-price">${productPrice}</span>
            <div class="cart-quantity">
              <button id="decrement">-</button>
              <span class="number">1</span>
              <button id="increment">+</button>
            </div>
          </div>
          <i class="ri-delete-bin-line cart-remove"></i>
         

`;
  cartContent.appendChild(cartBox);

  cartBox.querySelector(".cart-remove").addEventListener("click", () => {
    cartBox.remove();
    updateCartCount(-1);
    updateTotalPrice();
  });

  cartBox.querySelector(".cart-quantity").addEventListener("click", (event) => {
    const numberElement = cartBox.querySelector(".number");
    const decrementButton = cartBox.querySelector("#decrement");
    let quantity = numberElement.textContent;

    if (event.target.id === "decrement" && quantity > 1) {
      quantity--;
      if (quantity === 1) {
        decrementButton.style.color = "#999";
      }
    } else if (event.target.id === "increment") {
      quantity++;
      decrementButton.style.color = "#333";
    }
    numberElement.textContent = quantity;
    updateTotalPrice();
  });
  updateCartCount(1);
  updateTotalPrice();
};
const updateTotalPrice = () => {
  const totalPriceElement = document.querySelector(".total-price");
  const cartBoxes = cartContent.querySelectorAll(".cart-box");
  let total = 0;
  cartBoxes.forEach((cartBox) => {
    const priceElement = cartBox.querySelector(".cart-price");
    const quantityElement = cartBox.querySelector(".number");
    const price = priceElement.textContent.replace("Rs.", "");
    const quantity = quantityElement.textContent;
    total += price * quantity;
  });
  totalPriceElement.textContent = `Rs.${total}`;
};
let cartItemCount = 0;

const updateCartCount = (change) => {
  const cartItemCountBadge = document.querySelector(".cart-item-count");
  cartItemCount += change;
  if (cartItemCount > 0) {
    cartItemCountBadge.style.visibility = "visible";
    cartItemCountBadge.textContent = cartItemCount;
  } else {
    cartItemCountBadge.style.visibility = "hidden";
    cartItemCountBadge.textContent = "";
  }
};

document.addEventListener("DOMContentLoaded", function () {
  const buyNowButton = document.querySelector(".btn-buy");
  const cartContent = document.querySelector(".cart-content");

  if (!buyNowButton || !cartContent) return;

  buyNowButton.addEventListener("click", () => {
      const cartBoxes = cartContent.querySelectorAll(".cart-box");

      if (cartBoxes.length === 0) {
          alert("Your cart is empty. Please add items before buying.");
          return;
      }

      let orderDetails = [];
      let totalPrice = 0;

      cartBoxes.forEach(cartBox => {
          const title = cartBox.querySelector(".cart-product-title").innerText;
          const priceText = cartBox.querySelector(".cart-price").innerText.replace("Rs.", "").trim();
          const quantityText = cartBox.querySelector(".number").innerText.trim();
          const imageSrc = cartBox.querySelector(".cart-img").src;

          const price = parseFloat(priceText);
          const quantity = parseInt(quantityText);

          totalPrice += price * quantity;

          // Using "|" as separator to avoid issues with hyphens
          orderDetails.push(`${encodeURIComponent(title)}|${price}|${quantity}|${encodeURIComponent(imageSrc)}`);
      });

      const orderString = encodeURIComponent(orderDetails.join(","));
      const totalString = encodeURIComponent(totalPrice);

      window.location.href = `checkout.php?order=${orderString}&total=${totalString}`;
  });
});


