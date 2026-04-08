<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];

switch ($role) {
    case 'student':
        header("Location: student_dashboard.php");
        break;
    case 'staff':
        header("Location: staff_dashboard.php");
        break;
    case 'teacher':
        header("Location: teacher_dashboard.php");
        break;
    default:
        // Fallback
        header("Location: index.php");
        break;
}
exit();
?>
