<?php
// Include the database connection file
include('../conn/connection.php');

// Simulate user ID (in real applications, you should retrieve this from the session or authentication system)
$user_id = 1;

// Get the total amount from the POST request
$total_amount = $_POST['total_amount'];

// Step 1: Insert the order into the Orders table
$order_query = "INSERT INTO Orders (UserID, TotalAmount, OrderStatus) VALUES ($user_id, $total_amount, 'Pending')";
mysqli_query($conn, $order_query);

// Get the last inserted OrderID
$order_id = mysqli_insert_id($conn);

// Step 2: Insert each cart item into the OrderItems table
$cart_items_query = "SELECT * FROM CartItems";
$cart_items_result = mysqli_query($conn, $cart_items_query);

while ($cart_item = mysqli_fetch_assoc($cart_items_result)) {
    $product_id = $cart_item['ProductID'];
    $quantity = $cart_item['Quantity'];
    
    // Get the product price (to prevent manipulation of prices in the cart)
    $product_query = "SELECT Price FROM Products WHERE ProductID = $product_id";
    $product_result = mysqli_query($conn, $product_query);
    $product = mysqli_fetch_assoc($product_result);
    $price = $product['Price'];
    
    // Insert into OrderItems table
    $order_items_query = "INSERT INTO OrderItems (OrderID, ProductID, Quantity, Price) VALUES ($order_id, $product_id, $quantity, $price)";
    mysqli_query($conn, $order_items_query);
}

// Step 3: Clear the cart
$clear_cart_query = "DELETE FROM CartItems";
mysqli_query($conn, $clear_cart_query);

// Redirect to an order confirmation page or the orders page
header('Location: ../order-confirmation.php?order_id=' . $order_id);

// Close the database connection
mysqli_close($conn);

