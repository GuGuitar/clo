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
        html { scroll-behavior: smooth; scroll-padding-top: 100px; }
        body { font-family: 'Kanit', sans-serif; background-color: #f4f4f4; }
        section { scroll-margin-top: 100px; }
        .section-title { margin-bottom: 2rem; border-left: 5px solid #ff0000; padding-left: 15px; font-weight: 600; }
        .card { border: none; box-shadow: 0 4px 6px rgba(16, 16, 16, 0.05); transition: transform 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); }
        .nav-link { font-weight: 500; }
        footer { background-color: #212529; color: white; padding: 2rem 0; margin-top: 4rem; text-align: center; }

        /* Teacher Card Styles */
        .teacher-card {
            transition: all 0.3s ease;
            border-radius: 1rem !important;
        }
        .teacher-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(218, 33, 40, 0.15) !important;
        }
        .teacher-photo-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #e9ecef;
            transition: border-color 0.3s ease;
        }
        .teacher-card:hover .teacher-photo-wrapper {
            border-color: var(--swu-red, #DA2128);
        }
        .teacher-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .teacher-photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0f0f0, #e0e0e0);
            color: #bbb;
            border: 2px dashed #ccc;
            border-radius: 50%;
        }
        .edu-item {
            transition: transform 0.2s ease;
        }
        .edu-item:hover {
            transform: translateX(5px);
        }
    </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
  <img src="https://supreme.swu.ac.th/img/logo_color.png" alt="Logo" width="30" height="30" class="me-2">
  Internships System
</a>
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

<div id="heroCarousel" class="carousel slide carousel-fade shadow" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button> </div>

    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="5000">
            <div class="hero-slide" style="background-image:  url('https://www.sangfor.com/sites/default/files/inline-images/Srinakharinwirot-University-(SWU).jpg');">
                <div class="container text-white text-start">
                    <h1 class="display-4 fw-bold mb-2">Learning University for Society</h1>
                    <p class="lead mb-4">Srinakharinwirot University, Prasarnmit</p>
                </div>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <div class="hero-slide" style="background-image: url('https://storage.googleapis.com/tripniceday/uploads/places/1657879291243.jpeg');">
                <div class="container text-white text-start">
                    <h1 class="display-4 fw-bold mb-2">ระบบจัดการ Internships</h1>
                    <p class="lead mb-4">อำนวยความสะดวกในการฝึกงานสำหรับนิสิตและคณาจารย์</p>
                </div>
            </div>
        </div>

        <div class="carousel-item" data-bs-interval="5000">
            <div class="hero-slide" style="background-image: url('https://i.ytimg.com/vi/WMF0XgDGmQw/maxresdefault.jpg');">
                <div class="container text-white text-start">
                </div>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<main class="container mt-5">
    
    <!-- Showcase ของหลักสูตร -->
    <section id="courses" class="mb-5">
        <h2 class="section-title">Showcase ของหลักสูตร</h2>
        <div class="row g-4">
            <!-- Course 1 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-primary">SWU IS222</h4>
                        <p class="card-text text-muted flex-grow-1">รายวิชาระบบจัดการฐานข้อมูล <br>(Database Management System)</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#courseModal1">ดูรายละเอียด</button>
                    </div>
                </div>
            </div>
            <!-- Course 2 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-primary">SWU IS223</h4>
                        <p class="card-text text-muted flex-grow-1">รายวิชาการพัฒนาและการบริหารเว็บไซต์ <br>(Web Development and Management)</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#courseModal2">ดูรายละเอียด</button>
                    </div>
                </div>
            </div>
            <!-- Course 3 -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center d-flex flex-column">
                        <h4 class="card-title text-primary">SWU IS224</h4>
                        <p class="card-text text-muted flex-grow-1">รายวิชาการพัฒนาแพลตฟอร์มดิจิทัล <br>(Digital Platform Development)</p>
                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#courseModal3">ดูรายละเอียด</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals สำหรับแต่ละหลักสูตร -->
        <!-- Modal 1 -->
        <div class="modal fade" id="courseModal1" tabindex="-1" aria-labelledby="courseModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="courseModal1Label">รายละเอียดรายวิชา SWU IS222</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ใส่ข้อมูลของหลักสูตร SWU IS222 ที่นี่ -->
                        <h6>รายวิชาระบบจัดการฐานข้อมูล (Database Management System)</h6>
                        <p>แนวคิดพื้นฐานเกี่ยวกับข้อมูลและฐานข้อมูล ประเภทและโครงสร้างของฐานข้อมูลการ
จัดการข้อมูลและระบบจัดการฐานข้อมูล โปรแกรมฐานข้อมูล การวิเคราะห์ ฝึกทักษะการออกแบบ
และพัฒนาฐานข้อมูลด้วยโปรแกรมจัดการฐานข้อมูล การประยุกต์ฐานข้อมูลสำหรับงานสารสนเทศ
และการจัดการสารสนเทศในองค์กร ฝึกปฏิบัติการที่สอดคล้องกับเนื้อหาภาคบรรยาย</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 2 -->
        <div class="modal fade" id="courseModal2" tabindex="-1" aria-labelledby="courseModal2Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="courseModal2Label">รายละเอียดรายวิชา SWU IS223</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ใส่ข้อมูลของหลักสูตร SWU IS223 ที่นี่ -->
                        <h6>รายวิชาการพัฒนาและการบริหารเว็บไซต์ (Web Development and Management)</h6>
                        <p>หลักการออกแบบ องค์ประกอบ โครงสร้างเว็บด้วยภาษาเอชทีเอ็มแอล ซีเอสเอส
จาวา สคริปต์และรูปแบบภาษาอื่น การประยุกต์ใช้เทคโนโลยีในการพัฒนาเว็บ ประโยชน์และ
การประยุกต์ใช้งานเว็บ การบริหารจัดการ และการเผยแพร่สารสนเทศบนเว็บ การคัดเลือก และ
ประเมินคุณค่าเว็บไซต์</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal 3 -->
        <div class="modal fade" id="courseModal3" tabindex="-1" aria-labelledby="courseModal3Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="courseModal3Label">รายละเอียดรายวิชา SWU IS224</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- ใส่ข้อมูลของหลักสูตร SWU IS224 ที่นี่ -->
                        <h6>รายวิชาการพัฒนาแพลตฟอร์มดิจิทัล (Digital Platform Development)</h6>
                        <p>ระบบนิเวศน์ดิจิทัล กระบวนการพัฒนาแพลตฟอร์มดิจิทัล ขั้นตอนในการพัฒนา
แพลตฟอร์มดิจิทัลสำหรับองค์กร การวิเคราะห์ความต้องการ การออกแบบระบบข้ามแพลตฟอร์มให้มี
การทำงานร่วมกันได้ หลักการควบคุมการทำงานข้ามแพลตฟอร์มระบบ รูปแบบการต่อเชื่อมระบบข้าม
แฟลตฟอร์มการทดสอบ การติดตั้งและปรับใช้ในองค์กร</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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
        <div class="row g-4">
            <?php 
            $stmt = $conn->query("SELECT id, first_name, last_name, title, username, profile_image, education FROM users WHERE role='teacher'");
            $teacherIndex = 0;
            while($teacher = $stmt->fetch_assoc()):
                $teacherIndex++;
            ?>
            <div class="col-md-4 col-lg-3 mb-3">
                <div class="card teacher-card h-100 text-center p-3 border-0 shadow-sm">
                    <!-- รูปอาจารย์ -->
                    <div class="teacher-photo-wrapper mx-auto mb-3">
                        <?php if(!empty($teacher['profile_image']) && file_exists('uploads/teachers/' . $teacher['profile_image'])): ?>
                            <img src="uploads/teachers/<?= htmlspecialchars($teacher['profile_image']) ?>" 
                                 alt="รูป อ.<?= htmlspecialchars($teacher['first_name']) ?>" 
                                 class="teacher-photo">
                        <?php else: ?>
                            <div class="teacher-photo-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>
                                <div class="mt-1" style="font-size: 0.7rem; color: #aaa;">เว้นที่ใส่รูป</div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- ชื่ออาจารย์ -->
                    <h6 class="fw-bold mb-1"><?= htmlspecialchars(($teacher['title'] ?? 'อ.') . ' ' . $teacher['first_name'] . ' ' . $teacher['last_name']) ?></h6>
                    <small class="text-muted d-block mb-2">ID: <?= htmlspecialchars($teacher['username']) ?></small>
                    <!-- ลิ้งค์ดูวุฒิการศึกษา -->
                    <a href="#" class="btn btn-outline-primary btn-sm mt-auto" data-bs-toggle="modal" data-bs-target="#eduModal<?= $teacherIndex ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032z"/>
                        </svg>
                        ดูวุฒิการศึกษา
                    </a>
                </div>
            </div>

            <!-- Modal วุฒิการศึกษา -->
            <div class="modal fade" id="eduModal<?= $teacherIndex ?>" tabindex="-1" aria-labelledby="eduModalLabel<?= $teacherIndex ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, var(--swu-red, #DA2128) 0%, #8b1318 100%); color: white;">
                            <h5 class="modal-title" id="eduModalLabel<?= $teacherIndex ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032z"/>
                                </svg>
                                วุฒิการศึกษา — <?= htmlspecialchars(($teacher['title'] ?? 'อ.') . ' ' . $teacher['first_name'] . ' ' . $teacher['last_name']) ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if(!empty($teacher['education'])): ?>
                                <?php 
                                $eduLines = explode("\\n", $teacher['education']);
                                foreach($eduLines as $line):
                                    $line = trim($line);
                                    if(empty($line)) continue;
                                    // Split at the colon to highlight the degree level
                                    $parts = explode(':', $line, 2);
                                ?>
                                <div class="edu-item d-flex align-items-start mb-3 p-2 rounded" style="background: #f8f9fa;">
                                    <div class="edu-icon me-3 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="var(--swu-red, #DA2128)" viewBox="0 0 16 16">
                                            <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                                            <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <?php if(count($parts) >= 2): ?>
                                            <strong class="text-primary"><?= htmlspecialchars(trim($parts[0])) ?></strong><br>
                                            <span><?= htmlspecialchars(trim($parts[1])) ?></span>
                                        <?php else: ?>
                                            <span><?= htmlspecialchars($line) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-muted text-center mb-0">ยังไม่มีข้อมูลวุฒิการศึกษา</p>
                            <?php endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php endwhile; ?>
        </div>
    </section>

    <!-- ข้อมูลผู้จัดทำ -->
    <section id="creators" class="mb-5 bg-white p-4 rounded shadow-sm">
        <h2 class="section-title">ข้อมูลผู้จัดทำ</h2>
        <div class="row justify-content-center g-4">
            <!-- Creator 1 -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center">
                    <div class="teacher-photo-wrapper mx-auto mb-3" style="width: 80px; height: 80px;">
                        <div class="teacher-photo-placeholder" style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2); color: #00838f; border-color: #00bcd4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">นางสาว กมลพัชร ดวงมณี</h6>
                    <small class="text-muted">รหัสนิสิต: 67101010610</small>
                </div>
            </div>
            <!-- Creator 2 -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center">
                    <div class="teacher-photo-wrapper mx-auto mb-3" style="width: 80px; height: 80px;">
                        <div class="teacher-photo-placeholder" style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2); color: #00838f; border-color: #00bcd4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">นาย ธนพนธ์ ข้อพิสังข์</h6>
                    <small class="text-muted">รหัสนิสิต: 67101010623</small>
                </div>
            </div>
            <!-- Creator 3 -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center">
                    <div class="teacher-photo-wrapper mx-auto mb-3" style="width: 80px; height: 80px;">
                        <div class="teacher-photo-placeholder" style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2); color: #00838f; border-color: #00bcd4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">นาย พัทธดนย์ คงคำ</h6>
                    <small class="text-muted">รหัสนิสิต: 67101010636</small>
                </div>
            </div>
            <!-- Creator 4 -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center">
                    <div class="teacher-photo-wrapper mx-auto mb-3" style="width: 80px; height: 80px;">
                        <div class="teacher-photo-placeholder" style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2); color: #00838f; border-color: #00bcd4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">นางสาว วรรณษา เทียมอุบล</h6>
                    <small class="text-muted">รหัสนิสิต: 67101010645</small>
                </div>
            </div>
            <!-- Creator 5 -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="text-center">
                    <div class="teacher-photo-wrapper mx-auto mb-3" style="width: 80px; height: 80px;">
                        <div class="teacher-photo-placeholder" style="background: linear-gradient(135deg, #e0f7fa, #b2ebf2); color: #00838f; border-color: #00bcd4;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    <h6 class="fw-bold mb-1">นางสาว อรสินี เดชเทวาประทาน</h6>
                    <small class="text-muted">รหัสนิสิต: 67101010652</small>
                </div>
            </div>
        </div>
    </section>

</main>

<footer>
    <div class="container">
        <p class="mb-0">&copy; 2026 Internships System. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('a.nav-link[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });
});
</script>
</body>
</html>
