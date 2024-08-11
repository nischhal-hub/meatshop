<?php require './conn/connection.php'; 
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['username'])) {
    // If not authenticated, redirect to login.php
    header("Location: login.php");
    exit();
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="navbar">
        <div class="navbar-left">
            <img src="./assets/meatshop.png" alt="Logo" class="logo">
            <span class="brand-name">Butcher Shop Admin</span>
        </div>
        <div class="navbar-right">
            <a href="admin.php">Dashboard</a>
            <a href="add-product.php">Products</a>
            <a href="./process/logout.php">Logout</a>
        </div>
    </header>