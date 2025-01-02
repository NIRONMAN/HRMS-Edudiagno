<?php include("../commonFiles/_init.php") ?>
<?php include("../commonFiles/_db.php") ?>

<?php
if (!isset($_GET['month'])) {
    $_GET['month'] = 0;
}

$month = $_GET['month'];

$stmt = $conn->prepare("SELECT * FROM employee WHERE id = :employeeId");
$stmt->bindParam(':employeeId', $_GET['employeeId']);
$stmt->execute();
$employeeData = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href=<?php echo $CONFIG["ROOT_URL"] . "public/css/styles.css" ?>>
</head>

<body>
    <div class="container">
        <div class="col text-center">
            <?php if (isset($_GET['employeeId'])): ?>

                <div class="container">
                    <div class="month-list col-1">
                        <?php
                        $currentMonth = new DateTime();
                        $employeeId = $employeeData["Id"];

                        for ($i = 0; $i < 12; $i++) {
                            $active = (isset($_GET['month']) && $month == $i) ? 'active' : '';

                            echo "<div class='month-item text-start text-nowrap overflow-clip text-truncate $active' onclick=\"window.location.href='?month=$i&employeeId=$employeeId'\">" . $currentMonth->format("F Y") . "</div>";

                            $currentMonth->modify("-1 month");
                        }
                        ?>
                    </div>

                    <div id="payslip" class="payslip-display col-3 d-flex flex-column">
                        <h1>
                            <?php
                            echo $employeeData["Name"];
                            ?>
                        </h1>
                        <div class="container">
                            <div class="row">
                                <div class="col-3 p-4">Employee Id: <?php echo $employeeData["Id"] ?></div>
                                <div class="col-3 p-4">Date Joined: <?php echo $employeeData["DateJoined"] ?></div>
                                <div class="col-3 p-4">Department: <?php echo $employeeData["Department"] ?></div>
                                <div class="col-3 p-4">Sub Department: <?php echo $employeeData["SubDepartment"] ?></div>
                                <div class="col-3 p-4">Designation: <?php echo $employeeData["Designation"] ?></div>
                                <div class="col-3 p-4">Payment Mode: <?php echo $employeeData["PaymentMode"] ?></div>
                                <div class="col-3 p-4">Bank: <?php echo $employeeData["Bank"] ?></div>
                                <div class="col-3 p-4">Bank IFSC: <?php echo $employeeData["BankIFSC"] ?></div>
                                <div class="col-3 p-4">Bank Account: <?php echo $employeeData["BankAccount"] ?></div>
                                <div class="col-3 p-4">UAN: <?php echo $employeeData["UAN"] ?></div>
                                <div class="col-3 p-4">PF Number: <?php echo $employeeData["PFNumber"] ?></div>
                                <div class="col-3 p-4">PAN Number: <?php echo $employeeData["PANNumber"] ?></div>
                            </div>
                        </div>

                        <div class="container flex-grow-1 gap-4 d-flex flex-column my-2 p-3">
                            <h3 class="">Salary Details</h3>
                            <div class="d-flex justify-content-center">
                                Total Working Hours:
                                <?php

                                // // Fetch payslip details for the selected month
                                $stmt = $conn->prepare("SELECT * FROM attendance WHERE employeeId = :employeeId AND InTime BETWEEN :monthStart AND :monthEnd");

                                $monthStart = new DateTime();
                                $monthStart->modify("-$month month");
                                $monthStart->modify("first day of this month 00:00:00");

                                $monthEnd = new DateTime();
                                $monthEnd->modify("-$month month");
                                $monthEnd->modify("last day of this month 23:59:59");

                                $stmt->bindParam("employeeId", $employeeData["Id"]);
                                $stmt->bindParam("monthStart", $monthStart->format("Y-m-d H:i:s"));
                                $stmt->bindParam("monthEnd", $monthEnd->format("Y-m-d H:i:s"));
                                $stmt->execute();
                                $result = $stmt->fetchAll();

                                $totalWorkHours = 0;

                                foreach ($result as $row) {
                                    $interval = (new DateTime($row["InTime"]))->diff(new DateTime($row["OutTime"]));

                                    $totalWorkHours += $interval->h * 3600 + $interval->i * 60 + $interval->s;
                                }

                                echo $totalWorkHours / 3600;
                                ?>
                            </div>
                            <div class="d-flex justify-content-center">Total Earning: <?php echo $totalWorkHours / 3600 * 100 ?></div>
                        </div>
                        <button id="print" class="mt-auto ms-auto no-print">Print</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        let printBtn = document.querySelector("#print");
        printBtn.addEventListener("click", (e) => {
            let paySlip = document.querySelector("payslip");
            window.print();
        });
    </script>
</body>

</html>