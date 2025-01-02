<?php
include("../commonFiles/_init.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approve'])) {
    $leaveId = $_POST['leaveId'];
    try {
        $stmt = $conn->prepare("UPDATE leave_requests SET status = 'Approved' WHERE id = :leaveId");
        $stmt->bindParam(':leaveId', $leaveId);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$leaveRequests = [];
try {
    $stmt = $conn->query("SELECT * FROM leave_requests");
    $leaveRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../public/css/admin.css">
</head>
<body>
    <h1>Leave Management - Admin Panel</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Reason</th>
                <th>Leave Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leaveRequests as $request): ?>
                <tr>
                    <td><?= $request['id'] ?></td>
                    <td><?= htmlspecialchars($request['employee_name']) ?></td>
                    <td><?= htmlspecialchars($request['reason']) ?></td>
                    <td><?= htmlspecialchars($request['leave_date']) ?></td>
                    <td><?= htmlspecialchars($request['status']) ?></td>
                    <td>
                        <?php if ($request['status'] === 'Pending'): ?>
                            <form method="POST" action="">
                                <input type="hidden" name="leaveId" value="<?= $request['id'] ?>">
                                <button type="submit" name="approve">Approve</button>
                            </form>
                        <?php else: ?>
                            Approved
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
