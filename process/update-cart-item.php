<?php
// Include the database connection file
include('../conn/connection.php');

// Get the CartItemID and new quantity from the POST request
$cart_item_id = $_POST['cart_item_id'];
$new_quantity = $_POST['quantity'];

// Update the quantity in the CartItems table
$query = "UPDATE CartItems SET Quantity = $new_quantity WHERE CartItemID = $cart_item_id";
mysqli_query($conn, $query);

// You can send a response back if needed
echo "Quantity updated";

// Close the database connection
mysqli_close($conn);

