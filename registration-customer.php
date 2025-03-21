<?php
require_once('header.php');
require_once('admin/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';

$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_registration = $row['banner_registration'];
}

if (isset($_POST['form1'])) {
    $valid = 1;
    $errorMsg = '';

    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $errorMsg .= 'Tên khách hàng không được để trống\n';
    }

    if (empty($_POST['cust_email'])) {
        $valid = 0;
        $errorMsg .= 'Email không được để trống\n';
    } else if (!filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL)) {
        $valid = 0;
        $errorMsg .= 'Email không hợp lệ\n';
    } else {
        $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_email=?");
        $query->execute([$_POST['cust_email']]);
        if ($query->rowCount()) {
            $valid = 0;
            $errorMsg .= 'Email đã tồn tại\n';
        }
    }

    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống\n';
    }

    if (empty($_POST['cust_province'])) {
        $valid = 0;
        $errorMsg .= 'Chọn tỉnh/thành phố\n';
    }

    if (empty($_POST['cust_district'])) {
        $valid = 0;
        $errorMsg .= 'Chọn quận/huyện\n';
    }

    if (empty($_POST['cust_address'])) {
        $valid = 0;
        $errorMsg .= 'Chọn xã/phường\n';
    }

    if (empty($_POST['cust_password']) || empty($_POST['cust_re_password'])) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không được để trống\n';
    } else if ($_POST['cust_password'] !== $_POST['cust_re_password']) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không khớp\n';
    }

    if ($valid == 1) {
        $token = md5(time());
        $cust_datetime = date('Y-m-d H:i:s');
        $cust_timestamp = time();

        $query = $pdo->prepare("INSERT INTO table_customer (
            cust_name, cust_email, cust_phone,
            cust_province, cust_district, cust_address,
            cust_s_name, cust_s_phone, cust_s_province, cust_s_district, cust_s_address,
            cust_password, cust_token, cust_datetime, cust_timestamp, cust_status
        ) VALUES (?, ?, ?, ?, ?, ?, '', '', '', '', '', ?, ?, ?, ?, 0)");

        $query->execute([
            strip_tags($_POST['cust_name']),
            strip_tags($_POST['cust_email']),
            strip_tags($_POST['cust_phone']),
            strip_tags($_POST['cust_province']),
            strip_tags($_POST['cust_district']),
            strip_tags($_POST['cust_address']),
            md5($_POST['cust_password']),
            $token,
            $cust_datetime,
            $cust_timestamp
        ]);

        $base_url = ($_SERVER['HTTP_HOST'] == 'localhost') ? 'http://localhost/IS207-GoBuy/' : BASE_URL;

        $verify_link = $base_url . 'verify-customer.php?email=' . urlencode($_POST['cust_email']) . '&token=' . urlencode($token);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'taduc0508@gmail.com';
            $mail->Password   = 'ikwz kgyi hcby stai'; // app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('your-email@gmail.com', 'GoBuy');
            $mail->addAddress($_POST['cust_email']);

            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đăng ký GoBuy';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Click vào link sau để xác nhận: <br><a href="' . $verify_link . '">' . $verify_link . '</a>';
            $mail->send();

            $successMsg = 'Vui lòng kiểm tra email để xác nhận đăng ký.';
        } catch (Exception $e) {
            $errorMsg = 'Không thể gửi email. Lỗi: ' . $mail->ErrorInfo;
        }
    }
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_registration; ?>);">
    <div class="inner">
        <h1>Đăng ký tài khoản khách hàng</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 user-content">
                <form action="" method="post">
                    <?php $csrf->echoInputField(); ?>

                    <div class="row g-3">
                        <!-- Họ tên & Email -->
                        <div class="col-md-6">
                            <label>Họ tên *</label>
                            <input type="text" name="cust_name" class="form-control"
                                value="<?php echo $_POST['cust_name'] ?? '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Email *</label>
                            <input type="email" name="cust_email" class="form-control"
                                value="<?php echo $_POST['cust_email'] ?? '' ?>">
                        </div>

                        <!-- Số điện thoại & Tỉnh/Thành phố -->
                        <div class="col-md-6">
                            <label>Số điện thoại *</label>
                            <input type="text" name="cust_phone" class="form-control"
                                value="<?php echo $_POST['cust_phone'] ?? '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Tỉnh/Thành phố *</label>
                            <select name="cust_province" class="form-control">
                                <option value="">-- Chọn --</option>
                                <?php
                                $stmt = $pdo->query("SELECT * FROM table_province ORDER BY province_name ASC");
                                foreach ($stmt as $row) {
                                    echo '<option value="' . $row['province_id'] . '">' . $row['province_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Quận/Huyện & Xã/Phường -->
                        <div class="col-md-6">
                            <label>Quận/Huyện *</label>
                            <input type="text" name="cust_district" class="form-control"
                                value="<?php echo $_POST['cust_district'] ?? '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label>Xã/Phường *</label>
                            <input type="text" name="cust_address" class="form-control"
                                value="<?php echo $_POST['cust_address'] ?? '' ?>">
                        </div>

                        <!-- Mật khẩu & Nhập lại mật khẩu -->
                        <div class="col-md-6">
                            <label>Mật khẩu *</label>
                            <input type="password" name="cust_password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Nhập lại mật khẩu *</label>
                            <input type="password" name="cust_re_password" class="form-control">
                        </div>
                    </div>

                    <!-- Nút đăng ký & Link đăng ký admin -->
                    <div class="d-flex flex-column align-items-center mt-4">
                        <input type="submit" class="btn btn-danger px-5" name="form1" value="Đăng ký khách hàng">
                        <a href="registration-admin.php" class="btn btn-outline-primary px-4 mt-2">Đăng ký tài khoản
                            admin</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Toast -->
<div id="toast"></div>
<style>
#toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #333;
    color: #fff;
    padding: 15px 25px;
    border-radius: 8px;
    opacity: 0;
    transition: all 0.5s ease;
    z-index: 9999;
}

#toast.show {
    opacity: 1;
}

.btn {
    border-radius: 6px;
    width: 500px;
}
</style>

<script>
function showToast(message, color = '#333') {
    const toast = document.getElementById('toast');
    toast.innerText = message;
    toast.style.backgroundColor = color;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 4000);
}
</script>

<?php
if (!empty($errorMsg)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($errorMsg) . ", '#e74c3c');
    });</script>";
}
if (!empty($successMsg)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($successMsg) . ", '#2ecc71');
    });</script>";
}
?>

<?php require_once('footer.php'); ?>