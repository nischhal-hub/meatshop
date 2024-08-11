<?php
require_once '../conn/connection.php';
// Get the product details from the POST request
$product_id = $_POST['product_id'];
$quantity = 1; // Default quantity to add, can be adjusted

// Check if the product is already in the cart
$query = "SELECT * FROM CartItems WHERE ProductID = $product_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    // If the product is already in the cart, update the quantity
    $row = mysqli_fetch_assoc($result);
    $new_quantity = $row['Quantity'] + $quantity;
    $update_query = "UPDATE CartItems SET Quantity = $new_quantity WHERE ProductID = $product_id";
    mysqli_query($conn, $update_query);
} else {
    // If the product is not in the cart, insert it as a new item
    $insert_query = "INSERT INTO CartItems (ProductID, Quantity) VALUES ($product_id, $quantity)";
    mysqli_query($conn, $insert_query);
}

// Redirect back to the products page or a cart page
header('Location: ../products.php');

// Close the database connection
mysqli_close($conn);
