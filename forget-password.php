<?php
require_once('header.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';

// Lấy dữ liệu banner quên mật khẩu
$query = $pdo->prepare("SELECT banner_forget_password, forget_password_message FROM table_settings WHERE id=1");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

$banner_forget_password = $row['banner_forget_password'];
$forget_password_message = $row['forget_password_message'];

if (isset($_POST['form1'])) {
    $valid = true;
    $errorMsg = '';

    // Kiểm tra email nhập vào
    if (empty($_POST['cust_email'])) {
        $valid = false;
        $errorMsg .= 'Địa chỉ email không được để trống.\n';
    } else {
        $email = trim($_POST['cust_email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $errorMsg .= 'Địa chỉ email không hợp lệ.\n';
        } else {
            $query = $pdo->prepare("SELECT cust_email FROM table_customer WHERE cust_email=?");
            $query->execute([$email]);

            if ($query->rowCount() === 0) {
                $valid = false;
                $errorMsg .= 'Địa chỉ email không tồn tại trong hệ thống.\n';
            }
        }
    }

    if ($valid) {
        // Tạo token và timestamp
        $token = bin2hex(random_bytes(32));
        $now = time();

        // Cập nhật token vào database
        $query = $pdo->prepare("UPDATE table_customer SET cust_token=?, cust_timestamp=? WHERE cust_email=?");
        $query->execute([$token, $now, $email]);
        // Kiểm tra xem đang chạy trên localhost hay server thật
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $base_url = 'http://localhost/IS207-GoBuy/';
        } else {
            $base_url = BASE_URL; // Dùng BASE_URL bình thường nếu chạy trên server
        }

        $to = $_POST['cust_email'];

        $subject = 'RESET PASSWORD';
        $reset_link = $base_url . 'reset-password.php?email=' . urlencode($to) . '&token=' . urlencode($token);
        $message = 'Nhấn vào link này để đặt lại mật khẩu ' . '<br><br>
<a href="' . $reset_link . '">' . $reset_link . '</a>';

        // Gửi email bằng PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'taduc0508@gmail.com'; // Thay bằng email thật
            $mail->Password   = 'ikwz kgyi hcby stai'; // App Password của Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('noreply@example.com', 'GoBuy Support');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'GOBUY - RESET PASSWORD';
            $mail->Body    = 'Để đặt lại mật khẩu của bạn, hãy click vào link bên dưới: ' . '<br><br><a href="' . $reset_link . '">' . $reset_link . '</a>';

            $mail->send();
            $successMsg = "Email đặt lại mật khẩu đã được gửi. Vui lòng kiểm tra hộp thư đến.";
        } catch (Exception $e) {
            $errorMsg .= 'Email không thể gửi đi. Lỗi: ' . $mail->ErrorInfo;
        }
    }
}
?>

<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_forget_password; ?>);">
    <div class="inner">
        <h1>Quên mật khẩu</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <?php
                    if (!empty($errorMsg)) {
                        echo "<script>alert('$errorMsg')</script>";
                    }
                    if (!empty($successMsg)) {
                        echo "<script>alert('$successMsg')</script>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Địa chỉ Email *</label>
                                    <input type="email" class="form-control" name="cust_email" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit" name="form1">
                                </div>
                                <a href="login-customer.php" style="color:#e4144d;">Quay lại trang đăng nhập</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>