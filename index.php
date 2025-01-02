<?php include("./commonFiles/_init.php") ?>
<?php include("./commonFiles/_db.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./commonFiles/htmlHeader.php") ?>
</head>

<body>
    <form action="index.php" method="POST" >
        <div>Home Page</div>
        <button name="login"> Log in </button>
        <button name="signup"> Sign up </button>

    </form>
</body>

</html>

<?php 
if(isset($_POST["login"])){
    header("Location: ./auth/login");
}
if(isset($_POST["signup"])){
    header("Location: ./auth/signup");
}

?>