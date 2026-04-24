<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดการ Internships</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f8f9fa; }
        .hero { background: linear-gradient(135deg, #000000 0%, #00d5ff 100%); color: white; padding: 4rem 0; border-radius: 0 0 2rem 2rem; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .section-title { margin-bottom: 2rem; border-left: 5px solid #ff0000; padding-left: 15px; font-weight: 600; }
        .card { border: none; box-shadow: 0 4px 6px rgba(16, 16, 16, 0.05); transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .nav-link { font-weight: 500; }
        footer { background-color: #212529; color: white; padding: 2rem 0; margin-top: 4rem; text-align: center; }
    </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">Internships System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#courses">หลักสูตร</a></li>
        <li class="nav-item"><a class="nav-link" href="#pr">ประชาสัมพันธ์</a></li>
        <li class="nav-item"><a class="nav-link" href="#students">ข้อมูลนิสิต</a></li>
        <li class="nav-item"><a class="nav-link" href="#teachers">ข้อมูลอาจารย์</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <li class="nav-item ms-3"><a class="btn btn-outline-light" href="dashboard_redirect.php">เข้าสู่แดชบอร์ด</a></li>
        <?php else: ?>
            <li class="nav-item ms-3"><a class="btn btn-primary" href="login.php">เข้าสู่ระบบ</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- hello -->

<header class="hero text-center position-relative overflow-hidden">
    <div class="container position-relative z-1">
        <h1 class="display-4 fw-bold mb-3">ระบบจัดการ Internships</h1>
        <p class="lead mb-4">ระบบที่ช่วยอำนวยความสะดวกในการฝึกงาน และสหกิจศึกษา สำหรับนิสิต คณาจารย์ และผู้ดูแล</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="btn btn-light btn-lg text-primary fw-bold shadow">เข้าสู่ระบบทันที</a>
        <?php endif; ?>
    </div>
</header>

<main class="container mt-5">
    
    <!-- Showcase ของหลักสูตร -->
    <section id="courses" class="mb-5">
        <h2 class="section-title">Showcase ของหลักสูตร</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">SWU IS222</h4>
                        <p class="card-text text-muted">รายวิชาการเตรียมความพร้อมสำหรับการฝึกประสบการณ์วิชาชีพเบื้องต้น</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">SWU IS223</h4>
                        <p class="card-text text-muted">รายวิชาสหกิจศึกษา เตรียมความพร้อมนิสิตและเข้าฝึกงานในบริษัทชั้นนำ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary">SWU IS224</h4>
                        <p class="card-text text-muted">รายวิชาสำหรับการฝึกงานภาคฤดูร้อน และการประเมินผลการเรียนรู้</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ประชาสัมพันธ์กิจกรรม -->
    <section id="pr" class="mb-5 bg-white p-4 rounded shadow-sm">
        <h2 class="section-title">ประชาสัมพันธ์กิจกรรมต่างๆ</h2>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-bold mb-1">กิจกรรมแนะแนวการเตรียมตัวฝึกงาน ปี 2569</div>
                    <small class="text-muted">เชิญชวนนิสิตชั้นปีที่ 3-4 เข้าร่วมกิจกรรมรับฟังประสบการณ์จากรุ่นพี่</small>
                </div>
                <span class="badge bg-primary rounded-pill mt-2">New</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-bold mb-1">เปิดรับสมัครบริษัทเข้าร่วมโครงการสหกิจศึกษา</div>
                    <small class="text-muted">สำหรับองค์กรที่ต้องการรับนิสิตนักศึกษาเข้าฝึกปฏิบัติงานในภาคการศึกษาต่อไป</small>
                </div>
            </a>
        </div>
    </section>

    <!-- ข้อมูลเกี่ยวกับนิสิต -->
    <section id="students" class="mb-5">
        <h2 class="section-title">ข้อมูลเกี่ยวกับนิสิตปัจจุบัน (ปี 1-4)</h2>
        <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h3 class="text-info fw-bold">68</h3>
                    <div class="text-muted">นิสิตชั้นปีที่ 1</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h3 class="text-info fw-bold">67</h3>
                    <div class="text-muted">นิสิตชั้นปีที่ 2</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h3 class="text-info fw-bold">66</h3>
                    <div class="text-muted">นิสิตชั้นปีที่ 3</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="p-4 bg-white rounded shadow-sm">
                    <h3 class="text-info fw-bold">65</h3>
                    <div class="text-muted">นิสิตชั้นปีที่ 4</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ข้อมูลเกี่ยวกับอาจารย์ -->
    <section id="teachers" class="mb-5 bg-white p-4 rounded shadow-sm">
        <h2 class="section-title">ข้อมูลอาจารย์ที่ปรึกษา</h2>
        <div class="row">
            <?php 
            $stmt = $conn->query("SELECT first_name, last_name, username FROM users WHERE role='teacher'");
            while($teacher = $stmt->fetch_assoc()):
            ?>
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center p-3 border rounded">
                    <div class="bg-secondary rounded-circle d-flex justify-content-center align-items-center text-white fw-bold me-3" style="width: 50px; height: 50px;">
                        <?= mb_substr($teacher['first_name'], 0, 1, 'UTF-8') ?>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">อ. <?= htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']) ?></h6>
                        <small class="text-muted">ID: <?= htmlspecialchars($teacher['username']) ?></small>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

</main>

<footer>
    <div class="container">
        <p class="mb-0">&copy; 2026 Internships System. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
