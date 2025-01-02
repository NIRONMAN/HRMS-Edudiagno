<?php include("./commonFiles/_init.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("./commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href="<?php echo $CONFIG["ROOT_URL"] . "public/css/signup.css"; ?>">
</head>

<body>
    <div class="container">
        <div class="form-header">
            <h1>Sign Up</h1>
        </div>

        
        <div class="form-switch">
            <button id="employeeBtn" class="active" onclick="switchForm('employee')">Employee</button>
            <button id="adminBtn" onclick="switchForm('admin')">Admin</button>
        </div>

        
        <form id="employeeForm" class="active" method="post" action="processSignup.php">
            <div class="form-group">
                <label for="empName">Full Name</label>
                <input type="text" id="empName" name="empName" required>
            </div>
            <div class="form-group">
                <label for="empEmail">Email</label>
                <input type="email" id="empEmail" name="empEmail" required>
            </div>
            <div class="form-group">
                <label for="empPassword">Password</label>
                <input type="password" id="empPassword" name="empPassword" required>
            </div>
            <div class="form-group">
                <button type="submit" name="role" value="employee">Sign Up as Employee</button>
            </div>
        </form>

        
        <form id="adminForm" method="post" action="processSignup.php">
            <div class="form-group">
                <label for="adminName">Full Name</label>
                <input type="text" id="adminName" name="adminName" required>
            </div>
            <div class="form-group">
                <label for="adminEmail">Email</label>
                <input type="email" id="adminEmail" name="adminEmail" required>
            </div>
            <div class="form-group">
                <label for="adminPassword">Password</label>
                <input type="password" id="adminPassword" name="adminPassword" required>
            </div>
            <div class="form-group">
                <button type="submit" name="role" value="admin">Sign Up as Admin</button>
            </div>
        </form>
    </div>

    <script>
        function switchForm(role) {
            document.getElementById('employeeForm').classList.remove('active');
            document.getElementById('adminForm').classList.remove('active');
            document.getElementById('employeeBtn').classList.remove('active');
            document.getElementById('adminBtn').classList.remove('active');

            if (role === 'employee') {
                document.getElementById('employeeForm').classList.add('active');
                document.getElementById('employeeBtn').classList.add('active');
            } else {
                document.getElementById('adminForm').classList.add('active');
                document.getElementById('adminBtn').classList.add('active');
            }
        }
    </script>
</body>

</html>
