<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

// เลือก Requests กับรายชื่อของนิสิตทั้งหมด
$sql = "SELECT ir.*, u.first_name, u.last_name, u.username as student_id_code 
        FROM internship_requests ir 
        JOIN users u ON ir.student_id = u.id 
        ORDER BY ir.created_at DESC";
$result = $conn->query($sql);
?>
<!-- ส่วนแดชบอร์ดของอาจารย์ -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ฝ่ายอาจารย์ที่ปรึกษา | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; } </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-dark" href="index.php">Internships (Teacher Dashboard)</a>
    <div class="d-flex">
        <span class="navbar-text text-dark fw-bold me-3">สวัสดี, อาจารย์ <?= $_SESSION['name'] ?></span>
        <a href="logout.php" class="btn btn-outline-dark btn-sm">ออกจากระบบ</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="mb-4 text-dark fw-bold border-bottom pb-2">รายการขอฝึกงานของนิสิต (สำหรับอาจารย์)</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>ID คำขอ</th>
                            <th>รหัสนิสิต</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>สถานประกอบการ</th>
                            <th>สถานะ</th>
                            <th>วันที่ยื่น</th>
                            <th>จัดการ/ประเมิน</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="fw-bold text-muted">#<?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['student_id_code']) ?></td>
                                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                    <td><?= htmlspecialchars($row['company_name']) ?></td>
                                    <td><?= getStatusLabel($row['status']) ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td>
                                        <a href="teacher_view.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info fw-bold">ดูรายละเอียด <br>& อนุมัติ/นิเทศน์</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">ยังไม่มีรายการคำขอ</td>
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
