<?php 
session_start();
require_once('header.php'); ?>

<?php
session_start();
require_once('header.php');

if (!isset($_REQUEST['email']) || !isset($_REQUEST['token'])) {
    header('Location: ' . BASE_URL);
    exit;
}

try {
    $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
    $token = $_REQUEST['token'];

    if (!$email || empty($token)) {
        throw new Exception('Dữ liệu không hợp lệ.');
    }

    $statement = $pdo->prepare("SELECT cust_token FROM table_customer WHERE cust_email = ? AND cust_status = 0");
    $statement->execute([$email]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        throw new Exception('Email không tồn tại hoặc đã được xác minh.');
    }

    $statement = $pdo->prepare("UPDATE table_customer SET cust_token = '', cust_status = 1 WHERE cust_email = ?");
    $statement->execute([$email]);

    // ✅ Gửi thông báo thành công vào session
    $_SESSION['success_message'] = 'Xác minh email thành công! Bạn có thể đăng nhập ngay bây giờ.';

    // ✅ Redirect sang index.php
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