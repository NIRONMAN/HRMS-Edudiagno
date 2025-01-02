<?php include("../commonFiles/_init.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../commonFiles/htmlHeader.php") ?>
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthwise Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 80%;
            height: 80%;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .month-list {
            width: 30%;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
            overflow-y: auto;
        }

        .month-item {
            padding: 15px;
            text-align: left;
            cursor: pointer;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        .month-item:hover {
            background-color: #f0f0f0;
        }

        .month-item.active {
            background-color: #ffcdd2;
            font-weight: bold;
        }

        .payslip-display {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            overflow-y: auto;
        }

        .payslip-display h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            color: #333;
        }

        .payslip-details {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .payslip-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .payslip-details th, .payslip-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .payslip-details th {
            background-color: #f4f4f4;
        }
   
    </style>
</head>
<body>
    <div class="container">
        <div class="month-list">
            <?php
            // Connect to the database
            $conn = new mysqli("localhost", "root", "", "payslip_db");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $months = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];

            foreach ($months as $index => $month) {
                $active = (isset($_GET['month']) && $_GET['month'] === $month) ? 'active' : '';
                echo "<div class='month-item $active' onclick=\"window.location.href='?month=$month'\">$month</div>";
            }

            ?>
        </div>

        <div class="payslip-display">
            <?php
            $selectedMonth = isset($_GET['month']) ? $_GET['month'] : 'January';

            // Fetch payslip details for the selected month
            $stmt = $conn->prepare("SELECT * FROM payslips WHERE month = ?");
            $stmt->bind_param("s", $selectedMonth);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<h2>Payslip for $selectedMonth</h2>";
                echo "<div class='payslip-details'>";
                echo "<table>";
                echo "<tr><th>Employee Number</th><td>{$row['employee_number']}</td></tr>";
                echo "<tr><th>Date Joined</th><td>{$row['date_joined']}</td></tr>";
                echo "<tr><th>Department</th><td>{$row['department']}</td></tr>";
                echo "<tr><th>Designation</th><td>{$row['designation']}</td></tr>";
                echo "<tr><th>Bank Account</th><td>{$row['bank_account']}</td></tr>";
                echo "<tr><th>Net Salary</th><td>{$row['net_salary']}</td></tr>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<h2>No Payslip Found for $selectedMonth</h2>";
            }

            $stmt->close();
            $conn->close();
            ?>
        </div>
    </div>
</body>
    
</html>

