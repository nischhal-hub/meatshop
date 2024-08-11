<?php require './admin/includes/toppart.php'; ?>

<div class="form-container">
    <h2>Product Form</h2>
    <form action="./process/add-product.php" method="POST">
        <div class="form-group">
            <label for="product-title">Product Title</label>
            <input type="text" id="product-title" name="title" required>
        </div>
        <div class="form-group">
            <label for="product-price">Product Price</label>
            <input type="number" id="product-price" name="price" required>
        </div>
        <div class="form-group">
            <label for="product-stock">Product Stock</label>
            <input type="number" id="product-stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="product-category">Product Category</label>
            <select id="product-category" name="category" required>
                <option value="">Select a category</option>
                <option value="Chicken">Chicken</option>
                <option value="Beef">Beef</option>
                <option value="Pork">Pork</option>
                <option value="Fish">Fish</option>
                <option value="Goat">Goat</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product-image">Product Image URL</label>
            <input type="text" id="product-image" name="image" required>
        </div>
        <div class="form-group">
            <label for="product-description">Product Description</label>
            <input type="text" id="product-description" name="description">
        </div>
        <div class="form-btn">
            <button type="submit" name="submit">Save</button>
            <button type="button" class="cancel">Cancel</button>
        </div>
    </form>
</div>
</body>
</html>
