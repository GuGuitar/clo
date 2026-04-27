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
    <link href="swu-theme.css" rel="stylesheet">
    <style>body { font-family: 'Kanit', sans-serif; background-color: #f4f4f4; }</style>
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>รายชื่อนิสิตชั้นปีที่ <?php echo $year; ?></h1>
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
    // ดึงข้อมูลนิสิตตามปี
    $sql = "SELECT username, first_name, last_name FROM users WHERE role='student' AND year_level = $year";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()): 
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
        </tr>
    <?php 
        endwhile; 
    } else {
        echo "<tr><td colspan='3' class='text-center'>ไม่พบรายชื่อนิสิตชั้นปีที่ $year ในระบบ</td></tr>";
    }
    ?>
</tbody>
                    <?php // endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>