<?php
// Include the database connection file

// Fetch cart items along with product details
$query = "
    SELECT 
        ci.CartItemID, 
        ci.Quantity, 
        p.Name, 
        p.Price, 
        p.ImageUrl 
    FROM 
        CartItems ci 
    JOIN 
        Products p 
    ON 
        ci.ProductID = p.ProductID";

$result = mysqli_query($conn, $query);

$total = 0; // Initialize total amount
?>

<section class="cart">
    <h2>Your Cart</h2>
    <div class="cart-items">
        <?php while ($row = mysqli_fetch_assoc($result)) { 
            $item_total = $row['Price'] * $row['Quantity'];
            $total += $item_total;
        ?>
        <div class="cart-item">
            <img src="<?php echo $row['ImageUrl']; ?>" alt="Product Image" class="cart-item-image">
            <div class="cart-item-info">
                <h3 class="cart-item-title"><?php echo $row['Name']; ?></h3>
                <p class="cart-item-price">Rs.<?php echo number_format($row['Price'], 2); ?></p>
                <div class="cart-item-quantity">
                    <label for="quantity<?php echo $row['CartItemID']; ?>">Quantity:</label>
                    <input type="number" id="quantity<?php echo $row['CartItemID']; ?>" name="quantity<?php echo $row['CartItemID']; ?>" min="1" value="<?php echo $row['Quantity']; ?>" onchange="updateQuantity(<?php echo $row['CartItemID']; ?>, this.value)">
                </div>
            </div>
            <form action="./process/remove-cart-item.php" method="POST">
                <input type="hidden" name="cart_item_id" value="<?php echo $row['CartItemID']; ?>">
                <button type="submit" class="remove-item-btn">Remove</button>
            </form>
        </div>
        <?php } ?>
    </div>
    <div class="cart-summary">
        <h3>Summary</h3>
        <p>Total: Rs. <?php echo number_format($total, 2); ?></p>
        <form action="./process/create-order.php" method="POST">
            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
            <button type="submit" class="checkout-btn">Proceed to Checkout</button>
        </form>
    </div>
</section>
<script>
    function updateQuantity(cartItemID, newQuantity) {
    if (newQuantity < 1) return;

    fetch('./process/update-cart-item.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cart_item_id=${cartItemID}&quantity=${newQuantity}`
    })
    .then(response => response.text())
    .then(data => {
        // Optionally, you can refresh the page or update the cart total dynamically
        location.reload(); // Simple approach: reload the page to reflect changes
    })
    .catch(error => console.error('Error:', error));
}

</script>
<?php
// Close the database connection
mysqli_close($conn);
?>
