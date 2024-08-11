<?php
// Include the database connection file
include('../conn/connection.php');

// Get the CartItemID from the POST request
$cart_item_id = $_POST['cart_item_id'];

// Delete the item from the CartItems table
$query = "DELETE FROM CartItems WHERE CartItemID = $cart_item_id";
mysqli_query($conn, $query);

// Redirect back to the cart page
header('Location: ../carts.php');

// Close the database connection
mysqli_close($conn);

