// Load cart data from localStorage or initialize default values
let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
let cartCount = cartItems.reduce((acc, item) => acc + item.quantity, 0);
let totalAmount = cartItems.reduce((acc, item) => acc + (item.price * item.quantity), 0);

// Function to display cart items on the cart page
function displayCartItems() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear previous items

    if (cartItems.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>'; // Show empty message if no items
    } else {
        // Display each cart item in a row format with image
        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('cart-item');
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                <div><strong>${item.name}</strong></div>
                <div>Price: रू ${item.price}</div>
                <div>Quantity: ${item.quantity}</div>
            `;
            cartItemsContainer.appendChild(itemElement);
        });
    }

    // Update the total products and total amount in the cart summary
    document.getElementById('total-products').innerText = cartCount;
    document.getElementById('total-amount').innerText = totalAmount;
}

// Function to save cart data to localStorage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cartItems));
}

// Function to handle the "Continue to Purchase" button (reset cart)
function resetCart() {
    cartCount = 0;
    totalAmount = 0;
    cartItems = [];
    
    // Clear localStorage for the cart data
    localStorage.removeItem('cart');
    
    // Update the cart display after reset
    displayCartItems();
}

// Initialize cart items and display on page load
function initCartPage() {
    displayCartItems(); // Display the cart items when the cart page is loaded
}

// Add event listener to the "Continue to Purchase" button to reset the cart
const continuePurchaseButton = document.getElementById('continue-purchase');
if (continuePurchaseButton) {
    continuePurchaseButton.addEventListener('click', resetCart);
}

// Initialize the cart page with items
initCartPage();
