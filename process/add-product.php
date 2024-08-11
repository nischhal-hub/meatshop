<?php
// Include the database connection file
include('../conn/connection.php');

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $title = $_POST['title'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];
    $image = $_POST['image'];
    $description = $_POST['description'];

    // Insert the product into the Products table
    $query = "INSERT INTO Products (Name, Price, Stock, Type, ImageUrl,Description) 
              VALUES ('$title', $price, $stock, '$category', '$image' ,'$description')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Product added successfully!";
        // Redirect to the product list page or another page
        header("Location: ../add-product.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "Form not submitted!";
}

