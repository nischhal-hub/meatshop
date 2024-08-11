<?php require './admin/includes/toppart.php'; 
$total_products = $total_orders = $completed_orders = 0;

// Fetch total products
$product_query = "SELECT COUNT(*) AS total_products FROM Products";
$product_result = mysqli_query($conn, $product_query);
if ($product_row = mysqli_fetch_assoc($product_result)) {
    $total_products = $product_row['total_products'];
}

// Fetch total orders
$order_query = "SELECT COUNT(*) AS total_orders FROM Orders";
$order_result = mysqli_query($conn, $order_query);
if ($order_row = mysqli_fetch_assoc($order_result)) {
    $total_orders = $order_row['total_orders'];
}

// Fetch completed orders
$completed_query = "SELECT COUNT(*) AS completed_orders FROM Orders WHERE OrderStatus = 'Completed'";
$completed_result = mysqli_query($conn, $completed_query);
if ($completed_row = mysqli_fetch_assoc($completed_result)) {
    $completed_orders = $completed_row['completed_orders'];
}
?>
<main class="admin-panel">
    <section id="dashboard" class="admin-section">
        <h2>Dashboard</h2>
        <div class="stats">
            <div class="stat">
                <h3>Total Products</h3>
                <p id="total-products"><?php echo $total_products; ?></p>
            </div>
            <div class="stat">
                <h3>Total Orders</h3>
                <p id="total-orders"><?php echo $total_orders; ?></p>
            </div>
            <div class="stat">
                <h3>Completed Orders</h3>
                <p id="completed-orders"><?php echo $completed_orders; ?></p>
            </div>
        </div>
    </section>

    <section id="products" class="admin-section">
        <div id="product-form" class="form-popup">
        <div class="table-container">
        <div class="table-header">
            <h2>Product List</h2>
            <button class="add-btn"><a href="add-product.php">Add Product</a></button>
        </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Unit Price</th>
                        <th>Stock</th>
                        <th>Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch products from the Products table
                    $query = "SELECT * FROM Products";
                    $result = mysqli_query($conn, $query);
                    $sn = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $sn++ . "</td>";
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td><img src='" . $row['ImageUrl'] . "' alt='" . $row['Name'] . "' class='product-table-image'></td>";
                        echo "<td>Rs." . number_format($row['Price'], 2) . "</td>";
                        echo "<td>" . $row['Stock'] . "</td>";
                        echo "<td>" . $row['Type'] . "</td>";
                        echo "<td>" . $row['Description'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
    </section>

    <section id="orders" class="admin-section">
        <div class="order-container">
            <h2>Orders Management</h2>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Total Amount</th>
                        <th>Order Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // Fetch orders
                    $query = "SELECT * FROM Orders";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['OrderID']}</td>";
                        echo "<td>{$row['UserID']}</td>";
                        echo "<td>Rs. {$row['TotalAmount']}</td>";
                        echo "<td>{$row['OrderStatus']}</td>";
                        echo "<td>{$row['CreatedAt']}</td>";
                        echo "<td>
                              <a href='./process/update_status.php?order_id={$row['OrderID']}&status=Completed'>Mark as Completed</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

</body>

</html>