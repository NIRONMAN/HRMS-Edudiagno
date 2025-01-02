<?php
require '../vendor/autoload.php';
require '../commonFiles/_init.php';
require '../commonFiles/_db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
 
    $file = $_FILES['excel_file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);

    $sheet = $spreadsheet->getActiveSheet();

    foreach ($sheet->getRowIterator() as $rowIndex => $row) {
        if ($rowIndex === 1) {
            continue;
        }

        $employeeId = (int)($sheet->getCell('A' . $rowIndex)->getValue());
        $clockIn = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell('B' . $rowIndex)->getValue());
        $clockOut = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell('C' . $rowIndex)->getValue());


        if ($employeeId) {
            $in = $clockIn->format('Y-m-d H:i:s');
            $out = $clockOut->format('Y-m-d H:i:s');

            $stmt = $conn->prepare("INSERT INTO attendance (EmployeeId, InTime, OutTime) VALUES (:employeeId, :inTime, :outTime)");
            $stmt->bindParam(':employeeId', $employeeId);
            $stmt->bindParam(':inTime', $in);
            $stmt->bindParam(':outTime', $out);

            $stmt->execute();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Success</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        /* Container Styles */
        .container {
            text-align: center;
            background: #ffffff;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        /* Heading Styles */
        h1 {
            font-size: 2rem;
            color: #28a745;
            margin-bottom: 20px;
        }

        /* Button Styles */
        button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Uploaded Data Successfully!</h1>
        <button onclick="redirectToHome()">Ok</button>
    </div>

    <script>
        // Redirect to the home page
        function redirectToHome() {
            window.location.href = "http://localhost/HRMS-Edudiagno/index.php"; // Update path for local server
        }
    </script>
</body>
</html>
