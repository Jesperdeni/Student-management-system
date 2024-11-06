<?php
// Retrieve the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Connect to the database (Update with your database credentials)
$conn = new mysqli('localhost', 'root', '', 'dbcrud');

// Check for connection errors
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

// Check if a row was returned
if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $storedPassword);
    $stmt->fetch();

    // Verify the password
    if ($password === $storedPassword) {
        // Successful login
        session_start();
        $_SESSION['user_id'] = $id;
        header('Location: index.php');
        exit();
    }
}

// Invalid credentials, redirect back to the login page
header('Location: login.php');
exit();

// Close statement and database connection
$stmt->close();
$conn->close();
?>
