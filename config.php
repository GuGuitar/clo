<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "internships";

// Create connection
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select database
if (!$conn->select_db($dbname)) {
    // If database doesn't exist, we could try to create it, but we rely on the database.sql setup
    die("Database '$dbname' not selected. Please ensure you have imported database.sql. Error: " . $conn->error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Helper function to format status
function getStatusLabel($status_code) {
    switch ($status_code) {
        case 1: return '<span class="badge bg-secondary">รับเรื่องเข้าระบบ</span>';
        case 2: return '<span class="badge bg-primary">อาจารย์ที่ปรึกษาอนุมัติ</span>';
        case 3: return '<span class="badge bg-info">ออกใบส่งตัวแล้ว</span>';
        case 4: return '<span class="badge bg-success">ฝึกงานเสร็จสิ้น</span>';
        case 9: return '<span class="badge bg-danger">ยกเลิก</span>';
        default: return '<span class="badge bg-dark">ไม่ทราบสถานะ</span>';
    }
}
?>
