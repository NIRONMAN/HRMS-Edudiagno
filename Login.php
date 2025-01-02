<?php
// Include the init.php file for configuration
include("./commonFiles/_init.php");

$CONFIG = [
    "ROOT_URL" => "http://localhost/website/",
    "DB_SERVER_NAME" => "localhost",
    "DB_USER_NAME" => "root",
    "DB_PASSWORD" => "",
    "DB_NAME" => "hrms" // Add your database name here
];

// Establish database connection using config details
try {
    $conn = new PDO(
        "mysql:host=" . $CONFIG['DB_SERVER_NAME'] . ";dbname=" . $CONFIG['DB_NAME'],
        $CONFIG['DB_USER_NAME'],
        $CONFIG['DB_PASSWORD']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables for error/success messages
$error = $success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = md5($_POST['password']); // Use MD5 for simplicity; prefer password_hash() in production

    // Query to check credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .message {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>

<body>
    <div>
        <div>Login Page</div>
    </div>

    <div>
        <?php if ($error): ?>
            <p class="message"><?= $error ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
