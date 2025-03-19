<?php require_once('header.php'); ?>

<?php
// Lấy banner cho trang đặt lại mật khẩu từ bảng table_settings
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_reset_password = $row['banner_reset_password'];
}
?>

<?php
// Kiểm tra xem URL có chứa email và token hay không
if (!isset($_GET['email']) || !isset($_GET['token'])) {
    // Nếu không có, chuyển hướng về trang đăng nhập
    header('location: ' . BASE_URL . 'login-customer.php');
    exit;
}

// Truy vấn kiểm tra xem email và token có tồn tại trong database không
$query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_email=? AND cust_token=?");
$query->execute(array($_GET['email'], $_GET['token']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$tot = $query->rowCount();
if ($tot == 0) {
    // Nếu không tồn tại, chuyển hướng về trang đăng nhập
    header('location: ' . BASE_URL . 'login-customer.php');
    exit;
}

// Lấy thời gian lưu trữ của token
foreach ($result as $row) {
    $saved_time = $row['cust_timestamp'];
}

$error_message2 = '';
// Kiểm tra nếu token đã hết hạn (quá 24 giờ)
if (time() - $saved_time > 86400) {
    $error_message2 = 'Email đặt lại mật khẩu đã hết hạn (quá 24 giờ). Vui lòng thử lại.';
}

// Xử lý khi người dùng gửi biểu mẫu đổi mật khẩu
if (isset($_POST['form1'])) {

    $valid = 1;

    // Kiểm tra xem người dùng đã nhập mật khẩu mới và xác nhận mật khẩu chưa
    if (empty($_POST['cust_new_password']) || empty($_POST['cust_re_password'])) {
        $valid = 0;
        $errorMsg .= 'Vui lòng nhập mật khẩu mới và xác nhận mật khẩu.' . '\\n';
    } else {
        // Kiểm tra nếu mật khẩu nhập lại không khớp
        if ($_POST['cust_new_password'] != $_POST['cust_re_password']) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu không khớp.' . '\\n';
        }
    }

    // Nếu không có lỗi, cập nhật mật khẩu vào database
    if ($valid == 1) {

        $cust_new_password = strip_tags($_POST['cust_new_password']); // Loại bỏ ký tự HTML nguy hiểm
        $query = $pdo->prepare("UPDATE table_customer SET cust_password=?, cust_token=?, cust_timestamp=? WHERE cust_email=?");
        $query->execute(array(md5($cust_new_password), '', '', $_GET['email']));

        // Chuyển hướng đến trang thông báo đổi mật khẩu thành công
        header('location: ' . BASE_URL . 'reset-password-success.php');
    }
}
?>

<!-- Banner trang đổi mật khẩu -->
<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_reset_password; ?>);">
    <div class="inner">
        <h1><?php echo 'Đổi Mật Khẩu'; ?></h1>
    </div>
</div>

<!-- Nội dung trang -->
<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <?php
                    // Hiển thị thông báo lỗi nếu có
                    if ($errorMsg != '') {
                        echo "<script>alert('" . $errorMsg . "')</script>";
                    }
                    ?>
                    <?php if ($error_message2 != ''): ?>
                    <div class="error"><?php echo $error_message2; ?></div>
                    <?php else: ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""><?php echo 'Mật Khẩu Mới' ?> *</label>
                                    <input type="password" class="form-control" name="cust_new_password">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo 'Nhập Lại Mật Khẩu Mới' ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-primary" value="<?php echo 'Đổi Mật Khẩu'; ?>"
                                        name="form1">
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>