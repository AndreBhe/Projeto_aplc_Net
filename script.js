const cart = [];
const cartModal = document.getElementById('cart-modal');
const cartCount = document.getElementById('cart-count');
const cartItems = document.getElementById('cart-items');

function addToCart(itemName) {
  cart.push(itemName);
  updateCartDisplay();
}

function removeFromCart(index) {
  cart.splice(index, 1);
  updateCartDisplay();
}

function updateCartDisplay() {
  cartCount.textContent = cart.length;
  cartItems.innerHTML = '';
  cart.forEach((item, index) => {
    const li = document.createElement('li');
    li.innerHTML = `${index + 1}. ${item} <button class="remove-btn" onclick="removeFromCart(${index})">x</button>`;
    cartItems.appendChild(li);
  });
}

function toggleCart() {
  cartModal.style.display = cartModal.style.display === 'block' ? 'none' : 'block';
}

function clearCart() {
  cart.length = 0;
  updateCartDisplay();
}
