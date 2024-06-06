<?php
$servername = "localhost"; // Change to your MySQL server name
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "five"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST["username"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $password = htmlspecialchars(trim($_POST["password"]));

    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM registration WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Username or email already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO registration (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "<p>Registration successful. Welcome, $username!</p>";
            } else {
                echo "<p>There was an error registering your account. Please try again later.</p>";
            }
        }

        $stmt->close();
    }

    if (!empty($errors)) {
        echo "<p>The following errors occurred:</p><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><p>Please go back and correct the errors.</p>";
    }
}

$conn->close();
?>