<?php include("./commonFiles/_init.php"); ?>

<?php
// Determine role from URL parameter
$role = isset($_GET['role']) ? $_GET['role'] : 'employee'; // Default to employee if no role is provided
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./commonFiles/htmlHeader.php"); ?>
    <link rel="stylesheet" href="public/css/signup.css">
</head>

<body>
    <div class="container">
        <div class="form-wrapper">
            <h1><?php echo ucfirst($role); ?> Sign-Up</h1>
            
            <?php if ($role === 'employee'): ?>
                <form method="post" action="processSignup.php">
                    <input type="hidden" name="role" value="employee">
                    <label for="empName">Employee Name:</label>
                    <input type="text" id="empName" name="empName" required>
                    <label for="empEmail">Email:</label>
                    <input type="email" id="empEmail" name="empEmail" required>
                    <label for="empPassword">Password:</label>
                    <input type="password" id="empPassword" name="empPassword" required>
                    <button type="submit">Sign Up as Employee</button>
                </form>
            <?php elseif ($role === 'admin'): ?>
                <form method="post" action="processSignup.php">
                    <input type="hidden" name="role" value="admin">
                    <label for="adminName">Admin Name:</label>
                    <input type="text" id="adminName" name="adminName" required>
                    <label for="adminEmail">Email:</label>
                    <input type="email" id="adminEmail" name="adminEmail" required>
                    <label for="adminPassword">Password:</label>
                    <input type="password" id="adminPassword" name="adminPassword" required>
                    <button type="submit">Sign Up as Admin</button>
                </form>
            <?php else: ?>
                <p>Invalid role specified. Please select a valid role.</p>
            <?php endif; ?>
            
            <div class="toggle-links">
                <a href="SignUp.php?role=employee">Employee Signup</a> | 
                <a href="SignUp.php?role=admin">Admin Signup</a>
            </div>
        </div>
    </div>
</body>

</html>
