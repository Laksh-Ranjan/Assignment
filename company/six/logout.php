<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session data

// Redirect to the login page
header("Location: question6.html");
exit();
?>
