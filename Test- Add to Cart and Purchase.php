<?php
// Include the database connection file using dirname(__FILE__) to ensure correct path
require_once 'db.php'; 
session_start();

if (!isset($_SESSION['userid'])) {
    echo "Please log in to make a purchase.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['userid'];
    $fish_type = $conn->real_escape_string($_POST['fish_type']);
    $quantity = (int) $_POST['quantity'];
    $total_price = (float) $_POST['total_price'];

    // SQL to insert the purchase data into the 'orders' table
    $sql = "INSERT INTO orders (user_id, fish_type, quantity, total_price) VALUES ('$user_id', '$fish_type', '$quantity', '$total_price')";

    // Execute the query and handle errors
    if ($conn->query($sql) === TRUE) {
        echo "Purchase successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- Simple purchase form -->
<form method="POST" action="">
    Fish Type: <input type="text" name="fish_type" required><br>
    Quantity: <input type="number" name="quantity" required><br>
    Total Price: <input type="number" name="total_price" required><br>
    <input type="submit" value="Purchase">
</form>
