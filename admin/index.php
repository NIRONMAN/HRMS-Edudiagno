<?php include("../commonFiles/_init.php") ?>
<?php include("../commonFiles/_db.php") ?>

<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$msg = "";

// Database connection is now handled by _db.php
// $conn is already initialised through the connection in _db.php
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

            header("http://localhost/HRMS-Edudiagno/index.php");
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../commonFiles/htmlHeader.php") ?>
    <link rel="stylesheet" href=<?php echo $CONFIG["ROOT_URL"] . "public/css/admin.css" ?>>
    <title>Upload Attendance</title>
</head>

<body>
    <div class="container d-flex flex-column p-5 gap-2 shadow-none border-0">
        <h2>Upload Attendance</h2>
        <form class="d-flex flex-column gap-2" action="" method="POST" enctype="multipart/form-data">
            <label for="excel_file">Choose an Excel file:</label>
            <input type="file" name="excel_file" id="excel_file" required>
            <small class="form-text text-muted">Only .xlsx files are supported. Please upload a valid Excel worksheet.</small>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>

</html>