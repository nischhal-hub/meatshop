<?php require './admin/includes/toppart.php'; 
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $order_query = "SELECT * FROM Orders WHERE OrderID = $order_id";
    $order_result = mysqli_query($conn, $order_query);
    $order = mysqli_fetch_assoc($order_result);

    // Fetch order items
    $items_query = "SELECT OrderItems.*, Products.ProductName FROM OrderItems 
                    INNER JOIN Products ON OrderItems.ProductID = Products.ProductID 
                    WHERE OrderItems.OrderID = $order_id";
    $items_result = mysqli_query($conn, $items_query);
} else {
    die("Order ID not provided.");
}
?>
<div class="manage-orders">
        <h2>Order Details</h2>
        <p><strong>Order ID:</strong> <?php echo $order['OrderID']; ?></p>
        <p><strong>User ID:</strong> <?php echo $order['UserID']; ?></p>
        <p><strong>Total Amount:</strong> $<?php echo $order['TotalAmount']; ?></p>
        <p><strong>Status:</strong> <?php echo $order['OrderStatus']; ?></p>
        <p><strong>Created At:</strong> <?php echo $order['CreatedAt']; ?></p>

        <h3>Order Items</h3>
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($item = mysqli_fetch_assoc($items_result)) {
                        echo "<tr>";
                        echo "<td>{$item['ProductName']}</td>";
                        echo "<td>{$item['Quantity']}</td>";
                        echo "<td>\${$item['Price']}</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>