<?php require_once('header.php'); ?>

<?php
 if (!isset($_REQUEST['email']) || !isset($_REQUEST['token'])) {
     header('Location: ' . BASE_URL);
     exit;
 }
 
 $errorMsg = '';
 $successMsg = '';
 
 try {
     // Kiểm tra đầu vào hợp lệ
     $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
     $token = $_REQUEST['token'];
 
     if (!$email || empty($token)) {
         throw new Exception('Dữ liệu không hợp lệ.');
     }
 
     // Kiểm tra token trong cơ sở dữ liệu
     $statement = $pdo->prepare("SELECT cust_token FROM table_customer WHERE cust_email = ? AND cust_status = 0");
     $statement->execute([$email]);
     $result = $statement->fetch(PDO::FETCH_ASSOC);
     $querry = $pdo->prepare("SELECT cust_token FROM table_customer WHERE cust_email = ? AND cust_status = 0");
     $querry->execute([$email]);
     $result = $querry->fetch(PDO::FETCH_ASSOC);
 
     if (!$result) {
         throw new Exception('Email không tồn tại hoặc đã được xác minh.');
     }
 
     // Xác minh thành công, cập nhật trạng thái tài khoản
     $statement = $pdo->prepare("UPDATE table_customer SET cust_token = '', cust_status = 1 WHERE cust_email = ?");
     $statement->execute([$email]);
     $querry = $pdo->prepare("UPDATE table_customer SET cust_token = '', cust_status = 1 WHERE cust_email = ?");
     $querry->execute([$email]);
 
     $successMsg = '<p style="color:green;">Xác minh email thành công! Bạn có thể đăng nhập ngay bây giờ.</p>
                    <p><a href="' . BASE_URL . 'login-customer.php" style="color:#167ac6;font-weight:bold;">Bấm vào đây để đăng nhập</a></p>';
     $successMsg = '<p style="color:green;">Xác minh email thành công! Bạn có thể đăng nhập với tư cách khách hàng ngay bây giờ.</p>
                    <p><a href="' . BASE_URL . 'login-customer.php" style="color:#167ac6;font-weight:bold;">Bấm vào đây để đăng nhập với tư cách khách hàng</a></p>';
 } catch (Exception $e) {
     $errorMsg = '<p style="color:red;">' . htmlspecialchars($e->getMessage()) . '</p>';
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