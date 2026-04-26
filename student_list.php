<?php 
include 'config.php'; 
$year = isset($_GET['year']) ? intval($_GET['year']) : 1;
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายชื่อนิสิตชั้นปีที่ <?php echo $year; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>body { font-family: 'Kanit', sans-serif; background-color: #f4f4f4; }</style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>รายชื่อนิสิตชั้นปีที่ <?php echo $year; ?></h2>
        <a href="index.php#students" class="btn btn-secondary">ย้อนกลับ</a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ตัวอย่าง Query (ปรับเปลี่ยนตามชื่อ Table และ Column ของคุณ)
                    // $sql = "SELECT username, first_name, last_name FROM users WHERE role='student' AND student_year = $year";
                    // $result = $conn->query($sql);
                    // while($row = $result->fetch_assoc()): 
                    ?>
                    <tr>
                        <td>6710XXXXXXX</td>
                        <td>ตัวอย่าง ชื่อนิสิต</td>
                        <td>ตัวอย่าง นามสกุล</td>
                    </tr>
                    <?php // endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>