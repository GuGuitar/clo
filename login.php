<?php
include 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard_redirect.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Check user in database
    $sql = "SELECT id, role, first_name, last_name, password FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Since we are using plain 1234, we check directly. In real app use password_verify()
        if ($password === $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['first_name'] . ' ' . $row['last_name'];
            
            header("Location: dashboard_redirect.php");
            exit();
        } else {
            $error = 'รหัสผ่านไม่ถูกต้อง';
        }
    } else {
        $error = 'ไม่พบผู้ใช้งานนี้ในระบบ';
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ | Internships System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f1f5f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { max-width: 400px; width: 100%; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: none; }
        .login-header { background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%); color: white; text-align: center; padding: 2rem; border-radius: 1rem 1rem 0 0; }
        .form-control:focus { box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.15); }
    </style>
    <link rel="stylesheet" href="swu-theme.css">
</head>
<body>

<div class="card login-card">
    <div class="login-header">
        <h3 class="fw-bold mb-0">เข้าสู่ระบบ</h4>
        <p class="text-white-50 mt-2">Internships Management System</p>
    </div>
    <div class="card-body p-4">
        <?php if($error != ''): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label text-muted">ชื่อผู้ใช้งาน (Username)</label>
                <input type="text" class="form-control form-control-lg" id="username" name="username" required placeholder="เช่น 6610001, admin, teacher">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label text-muted">รหัสผ่าน (Password)</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" required placeholder="1234">
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">เข้าสู่ระบบ</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="index.php" class="text-decoration-none text-muted">&larr; กลับหน้าหลัก</a>
        </div>
    </div>
</div>

</body>
</html>
