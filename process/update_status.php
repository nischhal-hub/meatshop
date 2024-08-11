_<?php
require_once '../conn/connection.php';

if (isset($_GET['order_id']) && isset($_GET['status'])) {
    $order_id = $_GET['order_id'];
    $status = $_GET['status'];

    // Update order status
    $query = "UPDATE Orders SET OrderStatus = '$status' WHERE OrderID = $order_id";
    if (mysqli_query($conn, $query)) {
        echo "Order status updated successfully.";
    } else {
        echo "Error updating order status: " . mysqli_error($conn);
    }

    // Redirect back to orders page
    header("Location: ../admin.php");
} else {
    die("Order ID or status not provided.");
}
?>
