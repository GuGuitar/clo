<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เพิ่มข้อมูลนิสิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body { font-family: 'Kanit', sans-serif; background-color: #f4f4f4; }</style>
</head>
<body>
<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white"><h4>เพิ่มข้อมูลนิสิตใหม่</h4></div>
        <div class="card-body">
            <form action="save_student.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">รหัสนิสิต</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชั้นปี</label>
                    <select name="year_level" class="form-select">
                        <option value="1">ปี 1</option>
                        <option value="2">ปี 2</option>
                        <option value="3">ปี 3</option>
                        <option value="4">ปี 4</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100">บันทึกข้อมูล</button>
                <a href="index.php" class="btn btn-light w-100 mt-2">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>