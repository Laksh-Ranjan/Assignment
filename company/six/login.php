<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "six"; // Change to your database name
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to check user credentials
        $sql = "SELECT * FROM log WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // User found, start session
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard
        } else {
            // Invalid credentials
            echo "Invalid username or password";
        }
    } else {
        // Username or password fields are empty
        echo "Please enter both username and password";
    }
}

$conn->close();
?>
