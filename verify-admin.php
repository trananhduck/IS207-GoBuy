<?php
session_start();
require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['email']) || !isset($_REQUEST['token'])) {
    $_SESSION['error_message'] = 'Thiếu thông tin xác minh.';
    header('Location: ' . BASE_URL . 'login-admin.php');
    exit;
}

try {
    $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
    $token = $_REQUEST['token'];

    if (!$email || empty($token)) {
        throw new Exception('Dữ liệu không hợp lệ.');
    }

    $query = $pdo->prepare("SELECT token FROM table_admin WHERE email = ? AND status = 0");
    $query->execute([$email]);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        throw new Exception('Email không tồn tại hoặc đã được xác minh.');
    }

    if ($token !== $result['token']) {
        throw new Exception('Mã xác minh không hợp lệ.');
    }

    // Cập nhật trạng thái tài khoản
    $query = $pdo->prepare("UPDATE table_admin SET token = '', status = 1 WHERE email = ?");
    $query->execute([$email]);

    $_SESSION['success_message'] = 'Xác minh email thành công! Bạn có thể đăng nhập với tư cách admin ngay bây giờ.';
    header('Location: ' . BASE_URL . 'index.php');
    exit;
} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ' . BASE_URL . 'index.php');
    exit;
}
?>

<div class="page-banner" style="background-color:#444;">
    <div class="inner">
        <h1>Đăng ký thành công!!!</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <?php echo $errorMsg . $successMsg; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ... -->