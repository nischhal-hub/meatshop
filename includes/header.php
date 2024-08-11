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
    <link rel="stylesheet" href="style.css">
    <title>Basanti ko masu pasal</title>
</head>

<body>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="assets/meatshop.png" alt="Logo" class="logo">
            <span class="brand-name">The Butcher <span class="styled-word">Shop.</span></span>
        </div>
        <div class="navbar-center">
            <a href="index.php">Home</a>
            <a href="products.php">Products</a>
            <a href="carts.php">Carts</a>
        </div>
        <div class="navbar-right">
        <!-- <a href="#profile">Profile</a> -->
        <a href="./process/logout.php">Logout</a>
        </div>
    </nav>