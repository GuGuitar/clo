<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: staff_dashboard.php");
    exit();
}

$request_id = intval($_GET['id']);
$success = false;

// การเปลี่ยนสถานะของ การขอฝึกงาน
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['status'])) {
    $new_status = intval($_POST['status']);
    $update_sql = "UPDATE internship_requests SET status = $new_status WHERE id = $request_id";
    if ($conn->query($update_sql) === TRUE) {
        $success = true;
    }
}

// ดึงรายละเอียดของข้อมูลนิสิต
$sql = "SELECT ir.*, u.first_name, u.last_name, u.username as student_id_code, u.year_level 
        FROM internship_requests ir 
        JOIN users u ON ir.student_id = u.id 
        WHERE ir.id = $request_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "ไม่พบข้อมูล";
    exit();
}
$row = $result->fetch_assoc();
?>
<!-- ดูรายละเอียดขำคอ -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดคำขอ | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; } </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="staff_dashboard.php">Internships (Staff Dashboard)</a>
    <div class="d-flex">
        <span class="navbar-text text-white me-3">สวัสดี, เจ้าหน้าที่ <?= $_SESSION['name'] ?></span>
        <a href="logout.php" class="btn btn-outline-light btn-sm">ออกจากระบบ</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white pb-0 border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0">รายละเอียดคำขอ ID: #<?= $row['id'] ?></h4>
                    <?= getStatusLabel($row['status']) ?>
                </div>
                <div class="card-body p-4">
                    <?php if($success): ?>
                        <div class="alert alert-success" role="alert">อัปเดตสถานะเรียบร้อยแล้ว</div>
                    <?php endif; ?>
                    
                    <h5 class="text-primary fw-bold mb-3 mt-2 border-bottom pb-2">ข้อมูลนิสิต</h5>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">รหัสนิสิต :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['student_id_code'] ?? '') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ชื่อ - นามสกุล :</div>
                        <div class="col-md-8"><?= htmlspecialchars(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? '')) ?> (ปี <?= htmlspecialchars($row['year_level'] ?? '') ?>)</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">หลักสูตร / สาขาวิชา :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['program_type'] ?? '') ?> / <?= htmlspecialchars($row['major'] ?? '') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ข้อมูลติดต่อ :</div>
                        <div class="col-md-8">โทร: <?= htmlspecialchars($row['student_phone'] ?? '-') ?> | อีเมล: <?= htmlspecialchars($row['student_email'] ?? '-') ?></div>
                    </div>
                    
                    <h5 class="text-primary fw-bold mb-3 mt-4 border-bottom pb-2">รูปแบบการฝึกงาน</h5>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">รูปแบบ :</div>
                        <div class="col-md-8"><?= ($row['internship_type'] ?? '') == 'course' ? 'ในรายวิชา' : 'เพื่อหาประสบการณ์' ?></div>
                    </div>
                    <?php if(($row['internship_type'] ?? '') == 'course'): ?>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">รหัส/ชื่อวิชา :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['course_code'] ?? '') ?> <?= htmlspecialchars($row['course_name'] ?? '') ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">สถานที่ / ประเทศ :</div>
                        <div class="col-md-8"><?= ($row['location_type'] ?? '') == 'domestic' ? 'ในประเทศ' : 'ต่างประเทศ' ?> <?= ($row['location_type'] ?? '') == 'international' ? '('.htmlspecialchars($row['country'] ?? '').')' : '' ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ประเภทเอกสาร :</div>
                        <div class="col-md-8">
                            <?= ($row['doc_language'] ?? '') == 'thai' ? 'ภาษาไทย' : 'ภาษาอังกฤษ' ?> | 
                            <?= ($row['doc_type'] ?? '') == 'consideration' ? 'หนังสือขอความอนุเคราะห์' : 'หนังสือขอความอนุเคราะห์ + หนังสือส่งตัว' ?>
                        </div>
                    </div>
                    
                    <h5 class="text-primary fw-bold mb-3 mt-4 border-bottom pb-2">ข้อมูลหน่วยงาน</h5>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">สถานประกอบการ :</div>
                        <div class="col-md-8 fw-bold text-dark"><?= htmlspecialchars($row['company_name'] ?? '') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ตำแหน่ง :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['position'] ?? '') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ผู้ประสานงาน :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['coordinator_name'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ติดต่อหน่วยงาน :</div>
                        <div class="col-md-8">โทร: <?= htmlspecialchars($row['agency_phone'] ?? '-') ?> | อีเมล: <?= htmlspecialchars($row['agency_email'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ระยะเวลา :</div>
                        <div class="col-md-8">
                            <?php if (!empty($row['start_date']) && !empty($row['end_date'])): ?>
                                <?= date('d/m/Y', strtotime($row['start_date'])) ?> ถึง <?= date('d/m/Y', strtotime($row['end_date'])) ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ภาคเรียน/ปีการศึกษา :</div>
                        <div class="col-md-8"><?= htmlspecialchars($row['semester'] ?? '') ?> / <?= htmlspecialchars($row['academic_year'] ?? '') ?></div>
                    </div>
                    
                    <h5 class="text-primary fw-bold mb-3 mt-4 border-bottom pb-2">ข้อมูลการยื่น</h5>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">ยื่นครั้งที่ :</div>
                        <div class="col-md-8"><span class="badge bg-secondary"><?= htmlspecialchars($row['attempt_number'] ?? '1') ?></span></div>
                    </div>
                    <?php if(($row['attempt_number'] ?? 1) > 1): ?>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">หน่วยงานเดิม :</div>
                        <div class="col-md-8 text-danger"><?= htmlspecialchars($row['previous_agency'] ?? '-') ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4 text-muted fw-bold">เหตุผลการเปลี่ยน :</div>
                        <div class="col-md-8"><?= nl2br(htmlspecialchars($row['reason_for_change'] ?? '-')) ?></div>
                    </div>
                    <?php endif; ?>

                    <hr class="my-4">
                    
                    <h5 class="fw-bold text-dark mb-3">อัปเดตสถานะ (สำหรับเจ้าหน้าที่)</h5>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <select class="form-select form-select-lg" name="status" required>
                                <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>1: รับเรื่องเข้าระบบ</option>
                                <option value="2" <?= $row['status'] == 2 ? 'selected' : '' ?>>2: อาจารย์ที่ปรึกษาอนุมัติ</option>
                                <option value="3" <?= $row['status'] == 3 ? 'selected' : '' ?>>3: ออกใบส่งตัวแล้ว</option>
                                <option value="4" <?= $row['status'] == 4 ? 'selected' : '' ?>>4: ฝึกงานเสร็จสิ้น</option>
                                <option value="9" <?= $row['status'] == 9 ? 'selected' : '' ?>>9: ยกเลิก</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="staff_dashboard.php" class="btn btn-outline-secondary">กลับหน้าหลัก</a>
                            <button type="submit" class="btn btn-warning fw-bold px-4 shadow-sm">บันทึกสถานะ</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
