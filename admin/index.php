<?php include("../commonFiles/_init.php") ?>
<?php include("../commonFiles/_db.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href="../public/css/admin.css">
    <title>Upload Attendance</title>
</head>
<body>

<h2>Upload Attendance Excel File</h2>
<form action="upload_attendance.php" method="POST" enctype="multipart/form-data">
    <label for="excel_file">Choose an Excel file:</label>
    <input type="file" name="excel_file" id="excel_file" required>
    <small class="form-text text-muted">Only .xlsx files are supported. Please upload a valid Excel worksheet.</small>
    <button type="submit">Upload</button>
</form>

</body>
</html> 
