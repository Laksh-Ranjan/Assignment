<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: question6.html"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="sye.css"> <body>
    <div class="container">
        <div class="dashboard">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <!-- Other dashboard content here -->
            <a href="logout.php" class="logout-btn">Logout</a>

        </div>
    </div>
</body>
</html>
