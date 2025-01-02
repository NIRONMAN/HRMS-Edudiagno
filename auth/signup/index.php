<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
</head>
<body>
    <h2>Signup Form</h2>
    <form method="POST" action="index.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <label for="role">Select Role:</label>
        <br>
        <label>
            <input type="radio" name="role" value="user" checked> User
        </label>
        <br>
        <label>
            <input type="radio" name="role" value="admin"> Admin
        </label>
        <br>
        
        
        <label>
            <input type="radio" name="role" value="superadmin"> Superadmin
        </label>
        <br><br>

        <button type="submit" name="submitButton">Sign Up</button>
    </form>
</body>
</html>
<!-- <?php 
    include("../../commonFiles/_db.php");

            $sql="SELECT * FROM employee";
            $stmt= $conn ->prepare($sql);
            
           $stmt->execute();
           $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            echo $result['Name'] ;
            ?> -->
<?php

    include("../../commonFiles/_db.php");
    $username = $email = $role =$password= "";



    if($_SERVER['REQUEST_METHOD']=="POST" && (isset($_POST['submitButton']))){
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])&& !empty($_POST['role'])){
            $username=htmlspecialchars($_POST['username']);
            $email=htmlspecialchars($_POST['email']);
            $password=htmlspecialchars($_POST['password']);
            $role=htmlspecialchars($_POST['role']);
        }
       
        $hash_pass= password_hash($password,PASSWORD_BCRYPT);

        $sql="INSERT INTO users (username,email,password,role)
        VALUES (:username,:email,:password,:role)
        ";
        try {
            $stmt= $conn->prepare($sql);
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
