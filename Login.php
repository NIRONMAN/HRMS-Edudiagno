<?php
include("./commonFiles/_init.php");

// Initialize variables for error/success messages
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM employee WHERE name = :username AND password = :password");
    $stmt->bindParam(':username', $inputUsername);
    $stmt->bindParam(':password', $inputPassword);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $success = "Login successful! Welcome, " . htmlspecialchars($inputUsername) . ".";
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>
    <div class="container">
        <div class="form-wrapper">
            <h1>Login Page</h1>
            <?php if ($error): ?>
                <p class="message"><?= $error ?></p>
            <?php endif; ?>
            <?php if ($success): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>

            <form method="POST" action="">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
