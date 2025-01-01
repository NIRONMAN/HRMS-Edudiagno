<?php
$servername = $CONFIG["DB_SERVER_NAME"];
$username = $CONFIG["DB_USER_NAME"];
$password = $CONFIG["DB_PASSWORD"];


$conn = new PDO("mysql:host=$servername;dbname=hrms", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>