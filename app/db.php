<?php

$host = "database-1.ckfcwyaa08gj.us-east-1.rds.amazonaws.com";
$user = "admin";
$password = "Shourya28";
$database = "employee_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

echo "RDS connection successful";

?>
