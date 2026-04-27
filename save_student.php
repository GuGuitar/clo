<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $year_level = $_POST['year_level'];
    $role = 'student';
    $password = '1234';

    $sql = "INSERT INTO users (username, password, first_name, last_name, year_level, role) 
            VALUES ('$username', '$password', '$first_name', '$last_name', '$year_level', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='student_list.php?year=$year_level';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>