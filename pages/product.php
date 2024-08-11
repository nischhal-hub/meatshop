<?php

// Fetch all products from the database
$query = "SELECT * FROM Products";
$result = mysqli_query($conn, $query);
?>

<h2 class="product-title">Products</h2>
<section class="grid-container">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="product-card">
            <img src="<?php echo $row['ImageUrl']; ?>" alt="Product Image" class="product-image">
            <div class="product-info">
                <h3 class="product-title"><?php echo $row['Name']; ?></h3>
                <p class="product-stock"><?php echo $row['Stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?></p>
                <form action="./process/add-to-cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['ProductID']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['Name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['Price']; ?>">
                    <button type="submit" class="add-to-cart-btn" <?php echo $row['Stock'] > 0 ? '' : 'disabled'; ?>>Add to Cart</button>
                </form>
            </div>
        </div>
    <?php } ?>
</section>

<?php
// Close the database connection
mysqli_close($conn);
?>
