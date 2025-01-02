<?php include("../commonFiles/_init.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../commonFiles/htmlHeader.php") ?>
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

