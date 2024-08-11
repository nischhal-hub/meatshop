<?php
session_start();
require '../conn/connection.php';
// Start the session
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to fetch user
    $sql = "SELECT * FROM Users WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['PasswordHash'])) {
            // Set session variables
            $_SESSION['username'] = $username;
            
            // Redirect based on username
            if ($username === 'admin') {
                header("Location: ../admin.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
    
    $stmt->close();
}

$conn->close();