// Variables to store cart data
let cart = JSON.parse(localStorage.getItem('cart')) || []; // Load cart from localStorage or initialize an empty array
const cartCountElement = document.getElementById("cart-count");

// Function to update the cart count display
function updateCartCount() {
    let totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
    cartCountElement.textContent = totalItems;
}

// Function to save the cart to localStorage
function saveCartToLocalStorage() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to add product to the cart
function addToCart(productName, productPrice, productImage) {
    // Check if the product already exists in the cart
    const productIndex = cart.findIndex(item => item.name === productName);

    if (productIndex === -1) {
        // If product doesn't exist in the cart, add it with its image
        cart.push({
            name: productName,
            price: productPrice,
            quantity: 1,
            image: productImage // Store product image
        });
    } else {
        // If product already exists, increase the quantity
        cart[productIndex].quantity++;
    }

    // Save updated cart to localStorage
    saveCartToLocalStorage();

    // Update cart count after adding the product
    updateCartCount();
}

// Function to handle the "Add to Cart" button click
function handleAddToCartButtonClick(event) {
    const productElement = event.target.closest('.product');
    const productName = productElement.getAttribute('data-name');
    const productPrice = parseInt(productElement.getAttribute('data-price'));
    const productImage = productElement.querySelector('img').src; // Get the image source

    addToCart(productName, productPrice, productImage);
}

// Add event listeners to all "Add to Cart" buttons
document.querySelectorAll('.buy-button').forEach(button => {
    button.addEventListener('click', handleAddToCartButtonClick);
});

// Initial cart count update on page load
updateCartCount();
