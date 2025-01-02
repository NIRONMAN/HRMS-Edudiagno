<?php
require '../vendor/autoload.php';
require '../commonFiles/_init.php';
require '../commonFiles/_db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Database connection is now handled by _db.php
// $conn is already initialized through the connection in _db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    // Get the uploaded file
    $file = $_FILES['excel_file']['tmp_name'];

    // Load the Excel file using PhpSpreadsheet
    $spreadsheet = IOFactory::load($file);

    // Get the first worksheet
    $sheet = $spreadsheet->getActiveSheet();

    // Loop through rows and insert data into the database
    foreach ($sheet->getRowIterator() as $rowIndex => $row) {
        // Skip the header row
        if ($rowIndex === 1) {
            continue;
        }

        // Get cell values for "Name", "In" and "Out"
        $employeeId = (int)($sheet->getCell('A' . $rowIndex)->getValue());
        $clockIn = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell('B' . $rowIndex)->getValue());
        $clockOut = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($sheet->getCell('C' . $rowIndex)->getValue());


        if ($employeeId) {
            $in = $clockIn->format('Y-m-d H:i:s');
            $out = $clockOut->format('Y-m-d H:i:s');
            // Prepare SQL to insert the data into the attendance table
            $stmt = $conn->prepare("INSERT INTO attendance (EmployeeId, InTime, OutTime) VALUES (:employeeId, :inTime, :outTime)");
            $stmt->bindParam(':employeeId', $employeeId);
            $stmt->bindParam(':inTime', $in);
            $stmt->bindParam(':outTime', $out);

            // Execute the statement
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
    <title>Document</title>
</head>
<body>
    <h1>Uploaded</h1>
</body>
</html>