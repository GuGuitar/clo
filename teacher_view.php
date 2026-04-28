<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: teacher_dashboard.php");
    exit();
}

$request_id = intval($_GET['id']);
$teacher_id = $_SESSION['user_id'];
$success_approve = false;
$success_eval = false;

// การอนุมัติคำขอ
if (isset($_POST['action']) && $_POST['action'] === 'approve') {
    $update_sql = "UPDATE internship_requests SET status = 2 WHERE id = $request_id AND status = 1";
    if ($conn->query($update_sql) === TRUE) {
        $success_approve = true;
    }
}

// การส่งผลการนิเทสน์
if (isset($_POST['action']) && $_POST['action'] === 'evaluate') {
    $comments = $conn->real_escape_string($_POST['supervision_comments']);
    $eval_sql = "INSERT INTO evaluations (request_id, teacher_id, supervision_comments) 
                 VALUES ('$request_id', '$teacher_id', '$comments')";
    if ($conn->query($eval_sql) === TRUE) {
        $success_eval = true;
    }
}

// การดึงรายละเอียดของข้อมูล
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

// ดึงข้อมูลการนิเทศน์ (ถ้ามี)
$eval_result = $conn->query("SELECT * FROM evaluations WHERE request_id = $request_id");
?>
<!-- ส่วนของรายละเอียดคำขอ -->
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

<nav class="navbar navbar-expand-lg navbar-dark bg-info shadow-sm">
  <div class="container">
    <a class="navbar-brand text-dark fw-bold" href="teacher_dashboard.php">Internships (Teacher Dashboard)</a>
    <div class="d-flex">
        <span class="navbar-text text-dark fw-bold me-3">สวัสดี, อาจารย์ <?= $_SESSION['name'] ?></span>
        <a href="logout.php" class="btn btn-outline-dark btn-sm">ออกจากระบบ</a>
    </div>
  </div>
</nav>

<div class="container mt-5 mb-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white pb-0 border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0 text-info">รายละเอียดคำขอเพื่ออนุมัติ</h4>
                    <?= getStatusLabel($row['status']) ?>
                </div>
                <div class="card-body p-4">
                    <?php if($success_approve): ?>
                        <div class="alert alert-success" role="alert">คุณได้อนุมัติคำขอฝึกงานนี้เรียบร้อยแล้ว</div>
                    <?php endif; ?>
                    
                    <h5 class="text-info fw-bold mb-3 mt-2 border-bottom pb-2">ข้อมูลนิสิต</h5>
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
                    
                    <h5 class="text-info fw-bold mb-3 mt-4 border-bottom pb-2">รูปแบบการฝึกงาน</h5>
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
                    
                    <h5 class="text-info fw-bold mb-3 mt-4 border-bottom pb-2">ข้อมูลหน่วยงาน</h5>
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
                    
                    <h5 class="text-info fw-bold mb-3 mt-4 border-bottom pb-2">ข้อมูลการยื่น</h5>
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

                    <?php if ($row['status'] == 1): ?>
                    <hr class="my-4">
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="approve">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success btn-lg fw-bold px-5 py-2 shadow-sm rounded-pill" onclick="return confirm('ยืนยันว่าต้องการอนุมัติการฝึกงานนี้ใช่หรือไม่?');">คลิกเพื่ออนุมัติคำขอนี้</button>
                        </div>
                    </form>
                    <?php endif; ?>

                </div>
            </div>

            <!-- การนิเทศน์ / Evaluation Section -->
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white pt-3 pb-2 px-4">
                    <h5 class="fw-bold mb-0">บันทึกผลการนิเทศน์ / สิ่งที่อาจารย์พบ</h5>
                </div>
                <div class="card-body p-4">
                    <?php if($success_eval): ?>
                        <div class="alert alert-success" role="alert">บันทึกผลการนิเทศน์เรียบร้อยแล้ว</div>
                    <?php endif; ?>

                    <?php if($eval_result->num_rows > 0): ?>
                        <div class="mb-4">
                            <h6 class="fw-bold text-muted border-bottom pb-2">ประวัติการนิเทศน์</h6>
                            <?php while($eval = $eval_result->fetch_assoc()): ?>
                                <div class="p-3 bg-light rounded mb-2 border-start border-4 border-info">
                                    <small class="text-muted d-block mb-1"><i class="bi bi-clock"></i> <?= date('d/m/Y H:i', strtotime($eval['created_at'])) ?></small>
                                    <div><?= nl2br(htmlspecialchars($eval['supervision_comments'])) ?></div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <!-- แบบฟอร์มบันทึกการนิเทศน์ -->
                    <form method="POST" action="">
                        <input type="hidden" name="action" value="evaluate">
                        <div class="mb-3">
                            <label class="form-label fw-bold">เพิ่มบันทึกผลการนิเทศน์ (Supervision Note)</label>
                            <textarea class="form-control" name="supervision_comments" rows="4" required placeholder="พิมพ์ข้อความบันทึกเกี่ยวกับการไปนิเทศน์หรือความเห็นต่างๆ..."></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-dark fw-bold px-4">บันทึกข้อความ</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-4 text-center">
                <a href="teacher_dashboard.php" class="btn btn-outline-secondary">กลับหน้ารวม</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
