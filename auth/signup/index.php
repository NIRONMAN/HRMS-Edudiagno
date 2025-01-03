<?php include("../../commonFiles/_init.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../../commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href=<?php echo $CONFIG["ROOT_URL"] . "public/css/signup.css" ?>>
</head>

<body>
    <div class="<?php
                if ($_SERVER['REQUEST_METHOD'] != "POST") {
                    echo "d-flex flex-column active";
                } else {
                    echo "flex-column not-active";
                } ?>">
        <h2 class="p-4">Signup</h2>
        <form class="d-flex flex-column gap-4" method="POST" action="index.php">
            <div class="row">
                <label class="col-6" for="username">Username:</label>
                <input class="col-6" type="text" id="username" name="username" required>
            </div>

            <div class="row">
                <label class="col-6" for="email">Email:</label>
                <input class="col-6" type="email" id="email" name="email" required>
            </div>

            <div class="row">
                <label class="col-6" for="password">Password:</label>
                <input class="col-6" type="password" id="password" name="password" required>
            </div>

            <div class="row">
                <fieldset>
                    <label for="role">Select Role:</label>
                    <div class="d-flex justify-content-around">
                        <div class="d-flex align-items-center">
                            <input id="user" type="radio" name="role" value="user" checked>
                            <label for="user">
                                User
                            </label>
                        </div>
                        <div class="d-flex">
                            <input id="admin" type="radio" name="role" value="admin">
                            <label for="admin">
                                Admin
                            </label>
                        </div>
                        <div class="d-flex">
                            <input id="superadmin" type="radio" name="role" value="superadmin">
                            <label for="superadmin">
                                Superadmin
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <button class="row justify-content-center" type="submit" name="submitButton">Sign Up</button>
        </form>
    </div>
</body>

</html>
<!-- <?php
        include("../../commonFiles/_db.php");

        $sql = "SELECT * FROM employee";
        $stmt = $conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        echo $result['Name'];
        ?> -->
<?php

include("../../commonFiles/_db.php");
$username = $email = $role = $password = "";



if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['submitButton']))) {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);
    }

    $hash_pass = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username,email,password,role)
        VALUES (:username,:email,:password,:role)
        ";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash_pass);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        echo "User Added Successfully!";
        $_POST = array();
        header("Location: ../login");
    } catch (\PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>