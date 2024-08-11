<?php require './includes/header.php';

// Get the order_id from the URL
$order_id = $_GET['order_id'];

// Fetch order details
$order_query = "
    SELECT 
        o.OrderID, 
        o.TotalAmount, 
        o.OrderStatus, 
        o.CreatedAt, 
        u.UserID, 
        u.UserName 
    FROM 
        Orders o
    JOIN 
        Users u 
    ON 
        o.UserID = u.UserID 
    WHERE 
        o.OrderID = $order_id";

$order_result = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($order_result);

// Fetch order items
$order_items_query = "
    SELECT 
        oi.Quantity, 
        oi.Price, 
        p.Name 
    FROM 
        OrderItems oi
    JOIN 
        Products p 
    ON 
        oi.ProductID = p.ProductID 
    WHERE 
        oi.OrderID = $order_id";

$order_items_result = mysqli_query($conn, $order_items_query);
?>

<h2>Order Confirmation</h2>
<p>Order ID: <?php echo $order['OrderID']; ?></p>
<p>Total Amount: $<?php echo number_format($order['TotalAmount'], 2); ?></p>
<p>Order Status: <?php echo $order['OrderStatus']; ?></p>
<p>Order Date: <?php echo $order['CreatedAt']; ?></p>

<h3>Order Items</h3>
<ul>
    <?php while ($item = mysqli_fetch_assoc($order_items_result)) { ?>
    <li><?php echo $item['Name']; ?> - Quantity: <?php echo $item['Quantity']; ?> - Price: $<?php echo number_format($item['Price'], 2); ?></li>
    <?php } ?>
</ul>

<a href="products.php">View All Products</a>

<?php
// Close the database connection
mysqli_close($conn);
?>
