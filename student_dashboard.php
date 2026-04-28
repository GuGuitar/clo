<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// เก็บ Requests ของ นิสิตคนนี้
$sql = "SELECT * FROM internship_requests WHERE student_id = $student_id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">
    <!-- ส่วนแดชบอร์ดนิสิต -->
<head>
    <meta charset="UTF-8">
    <title>แดชบอร์ดนิสิต | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; } </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Internships (Student)</a>
    <div class="d-flex">
        <span class="navbar-text text-white me-3">สวัสดี, <?= $_SESSION['name'] ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">ออกจากระบบ</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>รายการขอฝึกงานของฉัน</h2>
        <a href="student_request.php" class="btn btn-success fw-bold">+ ยื่นคำขอฝึกงาน/สหกิจ</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ลำดับ</th>
                            <th>สถานประกอบการ</th>
                            <th>ตำแหน่ง</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>สถานะ</th>
                            <th>วันที่ยื่น</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result->num_rows > 0): ?>
                            <?php $i = 1; while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                                    <td><?= htmlspecialchars($row['position']) ?></td>
                                    <td><?= $row['start_date'] ?></td>
                                    <td><?= $row['end_date'] ?></td>
                                    <td><?= getStatusLabel($row['status']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">คุณยังไม่มีข้อมูลการยื่นขอฝึกงาน</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
