<?php
include("C:\xamp\htdocs\New folder\HRMS-Edudiagno\commonFiles\_init.php");

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $employeeName = $_POST['employeeName'];
    $leaveReason = $_POST['leaveReason'];
    $leaveDate = $_POST['leaveDate'];

    try {
        $stmt = $conn->prepare("INSERT INTO leave_requests (employee_name, reason, leave_date, status) VALUES (:employeeName, :leaveReason, :leaveDate, 'Pending')");
        $stmt->bindParam(':employeeName', $employeeName);
        $stmt->bindParam(':leaveReason', $leaveReason);
        $stmt->bindParam(':leaveDate', $leaveDate);
        $stmt->execute();
        $success = "Leave request submitted successfully.";
    } catch (PDOException $e) {
        $error = "Failed to submit leave request: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Leave Request</title>
    <link rel="stylesheet" href="C:\xamp\htdocs\New folder\HRMS-Edudiagno\public\css\leave.css">
</head>
<body>
    <h1>Leave Request Forms</h1>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="employeeName">Employee Name:</label>
        <input type="text" id="employeeName" name="employeeName" required>
        
        <label for="leaveReason">Reason for Leave:</label>
        <textarea id="leaveReason" name="leaveReason" required></textarea>
        
        <label for="leaveDate">Leave Date:</label>
        <input type="date" id="leaveDate" name="leaveDate" required>
        
        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
