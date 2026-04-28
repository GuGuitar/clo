<?php
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$success = false;

// ดึงข้อมูลจากฐานข้อมูลมาแสดง
$user_sql = "SELECT * FROM users WHERE id = '$student_id'";
$user_res = $conn->query($user_sql);
$user_data = $user_res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_type = $conn->real_escape_string($_POST['program_type'] ?? '');
    $major = $conn->real_escape_string($_POST['major'] ?? '');
    $student_phone = $conn->real_escape_string($_POST['student_phone'] ?? '');
    $student_email = $conn->real_escape_string($_POST['student_email'] ?? '');
    $internship_type = $conn->real_escape_string($_POST['internship_type'] ?? '');
    $course_code = $internship_type == 'course' ? $conn->real_escape_string($_POST['course_code'] ?? '') : NULL;
    $course_name = $internship_type == 'course' ? $conn->real_escape_string($_POST['course_name'] ?? '') : NULL;
    $location_type = $conn->real_escape_string($_POST['location_type'] ?? '');
    $country = $location_type == 'international' ? $conn->real_escape_string($_POST['country'] ?? '') : NULL;
    $doc_language = $conn->real_escape_string($_POST['doc_language'] ?? '');
    $doc_type = $conn->real_escape_string($_POST['doc_type'] ?? '');
    
    $company_name = $conn->real_escape_string($_POST['company_name'] ?? '');
    $position = $conn->real_escape_string($_POST['position'] ?? '');
    $coordinator_name = $conn->real_escape_string($_POST['coordinator_name'] ?? '');
    $agency_phone = $conn->real_escape_string($_POST['agency_phone'] ?? '');
    $agency_email = $conn->real_escape_string($_POST['agency_email'] ?? '');
    $start_date = $conn->real_escape_string($_POST['start_date'] ?? '');
    $end_date = $conn->real_escape_string($_POST['end_date'] ?? '');
    $semester = $conn->real_escape_string($_POST['semester'] ?? '');
    $academic_year = $conn->real_escape_string($_POST['academic_year'] ?? '');
    
    $attempt_number = intval($_POST['attempt_number'] ?? 1);
    $previous_agency = $attempt_number > 1 ? $conn->real_escape_string($_POST['previous_agency'] ?? '') : NULL;
    $reason_for_change = $attempt_number > 1 ? $conn->real_escape_string($_POST['reason_for_change'] ?? '') : NULL;

    $sql = "INSERT INTO internship_requests (
                student_id, program_type, major, student_phone, student_email, 
                internship_type, course_code, course_name, location_type, country, 
                doc_language, doc_type, company_name, position, coordinator_name, 
                agency_phone, agency_email, start_date, end_date, semester, academic_year, 
                attempt_number, previous_agency, reason_for_change, status
            ) VALUES (
                '$student_id', '$program_type', '$major', '$student_phone', '$student_email',
                '$internship_type', " . ($course_code ? "'$course_code'" : "NULL") . ", " . ($course_name ? "'$course_name'" : "NULL") . ", '$location_type', " . ($country ? "'$country'" : "NULL") . ",
                '$doc_language', '$doc_type', '$company_name', '$position', '$coordinator_name',
                '$agency_phone', '$agency_email', '$start_date', '$end_date', '$semester', '$academic_year',
                $attempt_number, " . ($previous_agency ? "'$previous_agency'" : "NULL") . ", " . ($reason_for_change ? "'$reason_for_change'" : "NULL") . ", 1
            )";
            
    if ($conn->query($sql) === TRUE) {
        $success = true;
    } else {
        $error = "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>
<!-- ระบบยื่นขอฝึกงาน -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยื่นคำขอฝึกงาน | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style> 
        body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; }
        .form-section-title {
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 8px;
            margin-bottom: 20px;
            color: #0d6efd;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        .form-section-title i { margin-right: 10px; }
        .card-custom { border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .card-header-custom { background: linear-gradient(135deg, #0d6efd, #0dcaf0); color: white; padding: 20px; }
    </style>
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
<!-- หน้าแบบฟอร์มขอฝึกงาน -->
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h3 class="fw-bold mb-0 text-center"><i class="bi bi-file-earmark-text"></i> ข้อมูลการฝึกงานในรายวิชา/หาประสบการณ์</h3>
                    <p class="text-center mb-0 mt-2 opacity-75">คณะมนุษยศาสตร์</p>
                </div>
                <div class="card-body p-5">
                    <?php if($success): ?>
                        <div class="alert alert-success text-center py-4" role="alert">
                            <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i><br>
                            <h4 class="mt-3">บันทึกข้อมูลเรียบร้อยแล้ว</h4>
                            <a href="student_dashboard.php" class="btn btn-success mt-3 px-4">กลับสู่หน้าหลัก</a>
                        </div>
                    <?php else: ?>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill"></i> <?= $error ?></div>
                        <?php endif; ?>
                        
                        <form method="POST" action="" class="needs-validation" novalidate>
                            
                            <!-- Section 1 -->
                            <h5 class="form-section-title"><i class="bi bi-person-badge"></i> ข้อมูลนิสิต</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label text-muted">ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user_data['first_name'] . ' ' . $user_data['last_name']) ?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">รหัสนิสิต</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user_data['username']) ?>" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-muted">ชั้นปี</label>
                                    <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($user_data['year_level']) ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">หลักสูตร <span class="text-danger">*</span></label>
                                    <select name="program_type" class="form-select" required>
                                        <option value="" disabled selected>เลือกหลักสูตร</option>
                                        <option value="ศศ.บ.">ศิลปศาสตรบัณฑิต (ศศ.บ.)</option>
                                        <option value="วท.บ.">วิทยาศาสตรบัณฑิต (วท.บ.)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">สาขาวิชา <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="major" required placeholder="ระบุสาขาวิชา">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">เบอร์โทรศัพท์นิสิต <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="student_phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">อีเมลนิสิต <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="student_email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">รูปแบบการฝึกงาน <span class="text-danger">*</span></label>
                                    <div class="d-flex gap-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="internship_type" id="type_course" value="course" required onchange="toggleCourseFields()">
                                            <label class="form-check-label" for="type_course">ในรายวิชา</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="internship_type" id="type_experience" value="experience" required onchange="toggleCourseFields()">
                                            <label class="form-check-label" for="type_experience">เพื่อหาประสบการณ์</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 p-3 bg-light rounded" id="course_fields" style="display: none;">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold text-dark">รหัสวิชา</label>
                                    <input type="text" class="form-control" id="course_code" name="course_code" placeholder="เช่น EN401">
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label fw-bold text-dark">ชื่อรายวิชา</label>
                                    <input type="text" class="form-control" id="course_name" name="course_name" placeholder="ชื่อวิชาการฝึกงาน">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">สถานที่ฝึกงาน <span class="text-danger">*</span></label>
                                    <select name="location_type" id="location_type" class="form-select" required onchange="toggleCountryField()">
                                        <option value="" disabled selected>เลือกสถานที่</option>
                                        <option value="domestic">ในประเทศ</option>
                                        <option value="international">ต่างประเทศ</option>
                                    </select>
                                </div>
                                <div class="col-md-6" id="country_field" style="display: none;">
                                    <label class="form-label fw-bold text-dark">ระบุประเทศ <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="country" name="country">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ภาษาของเอกสาร <span class="text-danger">*</span></label>
                                    <select name="doc_language" class="form-select" required>
                                        <option value="thai">ภาษาไทย</option>
                                        <option value="english">ภาษาอังกฤษ</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ประเภทเอกสาร <span class="text-danger">*</span></label>
                                    <select name="doc_type" class="form-select" required>
                                        <option value="consideration">ขอความอนุเคราะห์</option>
                                        <option value="consideration_and_referral">ขอความอนุเคราะห์ + หนังสือส่งตัว</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Section 2 -->
                            <h5 class="form-section-title mt-5"><i class="bi bi-building"></i> ข้อมูลหน่วยงานที่ขอฝึกงาน</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">ชื่อสถานประกอบการ/หน่วยงาน <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="company_name" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ตำแหน่งที่ต้องการฝึก <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="position" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ชื่อผู้ประสานงาน <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="coordinator_name" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">เบอร์โทรศัพท์หน่วยงาน <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="agency_phone" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">อีเมลหน่วยงาน <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="agency_email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">วันที่เริ่มฝึกงาน <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">วันที่สิ้นสุด <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ในภาคเรียนที่ <span class="text-danger">*</span></label>
                                    <select name="semester" class="form-select" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">ฤดูร้อน</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark">ปีการศึกษา <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="academic_year" required placeholder="เช่น 2568">
                                </div>
                            </div>

                            <!-- Section 3 -->
                            <h5 class="form-section-title mt-5"><i class="bi bi-clock-history"></i> ข้อมูลการขอฝึกงาน</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-dark">การยื่นขอฝึกงานครั้งนี้เป็นการยื่นครั้งที่ <span class="text-danger">*</span></label>
                                    <select name="attempt_number" id="attempt_number" class="form-select w-25" required onchange="toggleAttemptFields()">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>

                            <div id="attempt_fields" style="display: none;">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-dark">ชื่อหน่วยงานเดิม (ถ้ามี)</label>
                                        <input type="text" class="form-control" id="previous_agency" name="previous_agency">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold text-dark">เหตุผลที่ขอเปลี่ยนแปลงสถานที่ฝึกงาน</label>
                                        <textarea class="form-control" id="reason_for_change" name="reason_for_change" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-5 pt-3 border-top">
                                <a href="student_dashboard.php" class="btn btn-secondary px-4"><i class="bi bi-arrow-left"></i> ยกเลิก</a>
                                <button type="submit" class="btn btn-primary fw-bold px-5"><i class="bi bi-save"></i> บันทึกข้อมูลและยื่นคำขอ</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleCourseFields() {
    const isCourse = document.getElementById('type_course').checked;
    const courseFields = document.getElementById('course_fields');
    const cCode = document.getElementById('course_code');
    const cName = document.getElementById('course_name');
    
    if (isCourse) {
        courseFields.style.display = 'flex';
        cCode.required = true;
        cName.required = true;
    } else {
        courseFields.style.display = 'none';
        cCode.required = false;
        cName.required = false;
    }
}

function toggleCountryField() {
    const isInternational = document.getElementById('location_type').value === 'international';
    const countryField = document.getElementById('country_field');
    const countryInput = document.getElementById('country');
    
    if (isInternational) {
        countryField.style.display = 'block';
        countryInput.required = true;
    } else {
        countryField.style.display = 'none';
        countryInput.required = false;
    }
}

function toggleAttemptFields() {
    const attemptNum = parseInt(document.getElementById('attempt_number').value);
    const attemptFields = document.getElementById('attempt_fields');
    const prevAgency = document.getElementById('previous_agency');
    const reason = document.getElementById('reason_for_change');
    
    if (attemptNum > 1) {
        attemptFields.style.display = 'block';
        prevAgency.required = true;
        reason.required = true;
    } else {
        attemptFields.style.display = 'none';
        prevAgency.required = false;
        reason.required = false;
    }
}

// Enable Bootstrap forms validation
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
