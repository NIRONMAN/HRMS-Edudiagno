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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }

        .container {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .month-list {
            display: flex;
            flex-direction: column;
            width: 150px;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
        }

        .month-item {
            padding: 15px;
            text-align: center;
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
        }

        .payslip-display h2 {
            margin: 0 0 20px 0;
        }

        .payslip-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .payslip-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .payslip-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <?php
        $payslipData = [
            "Jan" => ["Payslip 1 for Jan", "Payslip 2 for Jan"],
            "Feb" => ["Payslip 1 for Feb", "Payslip 2 for Feb"],
            "March" => ["Payslip 1 for March", "Payslip 2 for March"],
            "Apr" => ["Payslip 1 for Apr", "Payslip 2 for Apr"],
            "May" => ["Payslip 1 for May", "Payslip 2 for May"],
            "Jun" => ["Payslip 1 for Jun", "Payslip 2 for Jun"],
            "Jul" => ["Payslip 1 for Jul", "Payslip 2 for Jul"],
            "Aug" => ["Payslip 1 for Aug", "Payslip 2 for Aug"],
            "Sep" => ["Payslip 1 for Sep", "Payslip 2 for Sep"],
            "Oct" => ["Payslip 1 for Oct", "Payslip 2 for Oct"],
            "Nov" => ["Payslip 1 for Nov", "Payslip 2 for Nov"],
            "Dec" => ["Payslip 1 for Dec", "Payslip 2 for Dec"]
        ];

        $currentMonth = isset($_GET['month']) ? $_GET['month'] : 'Jan';
    ?>

    <div class="container">
        <div class="month-list">
            <?php foreach ($payslipData as $month => $payslips): ?>
                <a href="?month=<?php echo $month; ?>" class="month-item <?php echo $currentMonth === $month ? 'active' : ''; ?>">
                    <?php echo $month; ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="payslip-display">
            <h2><?php echo $currentMonth; ?> Payslip</h2>
            <ul class="payslip-list">
                <?php foreach ($payslipData[$currentMonth] as $payslip): ?>
                    <li class="payslip-item"> <?php echo $payslip; ?> </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>

