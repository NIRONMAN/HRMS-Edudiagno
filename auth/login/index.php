<?php include("../../commonFiles/_db.php");
session_start(); 
$error = $success = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
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

            <form method="POST" action="index.php">
                <label for="username">Username:</label>
                <br>

                <input type="text" id="username" name="username" required>
                <br>
                <br>


                <label for="password">Password:</label>
                <br>

                <input type="password" id="password" name="password" required>
                <br>
                <br>


                <button name="submitButton" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php


if($_SERVER['REQUEST_METHOD']=="POST" && (isset($_POST['submitButton']))){
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];
    $sql = "SELECT id, password FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":username", $inputUsername, PDO::PARAM_STR);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($inputPassword, $row['password'])) {
            $_SESSION["userId"] = $row['id'];
            $_SESSION["username"] = $inputUsername;
            $success = "Login successful! Welcome, " . htmlspecialchars($inputUsername) . ".";
        } else {
            $error = "<br>Password is invalid.";
        }
    } else {
        $error = "<br>Did not find $inputUsername.";
    }
    echo $success;
    echo $error;
}
?>
