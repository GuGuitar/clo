<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_name = $conn->real_escape_string($_POST['company_name']);
    $position = $conn->real_escape_string($_POST['position']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    
    $sql = "INSERT INTO internship_requests (student_id, company_name, position, start_date, end_date, status) 
            VALUES ('$student_id', '$company_name', '$position', '$start_date', '$end_date', 1)";
            
    if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        $error = "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยื่นคำขอฝึกงาน | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; } </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="student_dashboard.php">Internships (Student)</a>
    <div class="d-flex">
        <span class="navbar-text text-white me-3">สวัสดี, <?= $_SESSION['name'] ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">ออกจากระบบ</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white pb-0 border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0 text-primary">ยื่นคำขอฝึกงาน / สหกิจศึกษา</h4>
                </div>
                <div class="card-body p-4">
                    <?php if($success): ?>
                        <div class="alert alert-success" role="alert">
                            บันทึกข้อมูลเรียบร้อยแล้ว <a href="student_dashboard.php" class="alert-link">กลับสู่หน้าหลัก</a>
                        </div>
                    <?php else: ?>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="company_name" class="form-label fw-bold text-muted">ชื่อสถานประกอบการ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="company_name" name="company_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="position" class="form-label fw-bold text-muted">ตำแหน่งที่ต้องการฝึก <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="position" name="position" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label fw-bold text-muted">วันที่เริ่ม <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label fw-bold text-muted">วันที่สิ้นสุด <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="student_dashboard.php" class="btn btn-secondary">ยกเลิก</a>
                                <button type="submit" class="btn btn-primary fw-bold px-4">บันทึกข้อมูล</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
