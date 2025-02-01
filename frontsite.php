<?php
session_start();
$conn = new mysqli("localhost", "root", "", "login","3307");
?>
<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OceanHarvest - Fresh Seafood</title>
    <link rel="stylesheet" href="frontsite.css"> <!-- Link to the CSS file -->
</head>
<body>

<header>
    <div class="container header-container">
        <div class="brand">
            <h1>OceanHarvest</h1>
        </div>
        <nav class="header-links">
            <a href="Test- User Login with Session Managemen.php" class="login-button">Login</a> <!-- Added Login button -->
            <a href="Test-User Registration.php" class="register-button">Register</a> <!-- Register button -->
            <!-- <a href="cart.html" class="cart-button">Cart (<span id="cart-count">0</span>)</a> Cart button moved to the top -->
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container">
            <h2>Welcome to OceanHarvest</h2>
            <p>At OceanHarvest, we bring you the freshest seafood right to your doorstep. Our extensive selection of high-quality fish is sourced directly from the ocean, ensuring you receive the best catch every time. Whether you're a seafood enthusiast or a chef looking for premium ingredients, OceanHarvest is your go-to store for all things fish!</p>
            <a href="productpage.html" class="home-button">Fish</a> <!-- Button to Product Page -->
        </div>
    </section>
</main>

<footer>
    <div class="container">
        <p>&copy; 2025 OceanHarvest. All rights reserved. by Usesh-Thapa-Magar</p>
    </div>
</footer>

</body>
</html>
