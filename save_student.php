<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $student_year = $_POST['student_year'];
    $role = 'student';

    $sql = "INSERT INTO users (username, first_name, last_name, student_year, role) 
            VALUES ('$username', '$first_name', '$last_name', '$student_year', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location='student_list.php?year=$student_year';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>