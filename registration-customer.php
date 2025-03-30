<?php require_once('header.php');
require_once('admin/inc/config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/PHPMailer/src/PHPMailer.php';
require 'PHPMailer/PHPMailer/src/SMTP.php';
require 'PHPMailer/PHPMailer/src/Exception.php';
?>
<?php
$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_registration = $row['banner_registration'];
}
?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $errorMsg .= 'Tên khách hàng không được để trống' . "<br>";
    }

    if (empty($_POST['cust_email'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ email không được để trống' . "<br>";
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= 'Địa chỉ email phải hợp lệ' . "<br>";
        } else {
            $querry = $pdo->prepare("SELECT * FROM table_customer WHERE cust_email=?");
            $querry->execute(array($_POST['cust_email']));
            $total = $querry->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= 'Địa chỉ email đã tồn tại' . "<br>";
            }
        }
    }

    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống' . "<br>";
    }

    if (empty($_POST['cust_province'])) {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn tỉnh/thành phố' . "<br>";
    }

    if (empty($_POST['cust_district'])) {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn quận/huyện' . "<br>";
    }

    if (empty($_POST['cust_address'])) {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn xã' . "<br>";
    }


    if (empty($_POST['cust_password']) || empty($_POST['cust_re_password'])) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không được để trống' . "<br>";
    } else {
        $password = $_POST['cust_password'];
        $re_password = $_POST['cust_re_password'];

        // Kiểm tra độ dài mật khẩu (tối thiểu 6, khuyến nghị 12-16)
        if (strlen($password) < 6) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải có ít nhất 6 ký tự' . "<br>";
        }

        // Kiểm tra mật khẩu có đủ yêu cầu không
        elseif (!preg_match('/[A-Z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa' . "<br>";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết thường' . "<br>";
        } elseif (!preg_match('/\d/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ số' . "<br>";
        } elseif (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...)' . "<br>";
        }

        // Kiểm tra xác nhận mật khẩu
        elseif ($password !== $re_password) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu nhập lại không khớp' . "<br>";
        }
    }


    if (!empty($_POST['cust_password']) && !empty($_POST['cust_re_password'])) {
        if ($_POST['cust_password'] != $_POST['cust_re_password']) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu không khớp' . "<br>";
        }
    }

    if ($valid == 1) {

        $token = md5(time());
        $cust_datetime = date('Y-m-d h:i:s');
        $cust_timestamp = time();

        //Lưu vào DB
        $querry = $pdo->prepare("INSERT INTO table_customer (
                                         cust_name,
                                         cust_email,
                                         cust_phone,
                                         cust_province,
                                         cust_district,
                                         cust_address,
                                         cust_s_name,
                                         cust_s_phone,
                                         cust_s_province,
                                         cust_s_district,
                                         cust_s_address,
                                         cust_password,
                                         cust_token,
                                         cust_datetime,
                                         cust_timestamp,
                                         cust_status
                                     ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $querry->execute(array(
            // Loại bỏ các thẻ HTML khỏi dữ liệu nhập vào để tránh XSS (Cross-Site Scripting)
            strip_tags($_POST['cust_name']),      // Tên khách hàng
            strip_tags($_POST['cust_email']),     // Email khách hàng
            strip_tags($_POST['cust_phone']),     // Số điện thoại khách hàng
            strip_tags($_POST['cust_province']),   // Tỉnh/thành phố
            strip_tags($_POST['cust_district']),   //quận/huyện
            strip_tags($_POST['cust_address']),   // địa chỉ nhà
            '',
            '',
            '',
            '',
            '',
            // Mã hóa mật khẩu bằng MD5 
            md5($_POST['cust_password']),

            // Token dùng để xác thực (có thể là token đăng ký hoặc xác nhận email)
            $token,

            // Thời gian đăng ký khách hàng
            $cust_datetime,   // Định dạng thời gian
            $cust_timestamp,  // Timestamp (số nguyên)

            // Giá trị 0, có thể dùng để đánh dấu trạng thái tài khoản (ví dụ: 0 = chưa kích hoạt)
            0
        ));


        // Kiểm tra xem đang chạy trên localhost hay server thật
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $base_url = 'http://localhost/IS207-GoBuy/';
        } else {
            $base_url = BASE_URL; // Dùng BASE_URL bình thường nếu chạy trên server
        }

        // Gửi email xác nhận tài khoản
        $to = $_POST['cust_email'];

        $subject = 'GoBuy - Registration Email Confirmation';
        $verify_link = $base_url . 'verify-customer.php?email=' . urlencode($to) . '&token=' . urlencode($token);
        $message = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<br><br>
     <a href="' . $verify_link . '">' . $verify_link . '</a>';


        $mail = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // SMTP của Gmail
            $mail->SMTPAuth   = true;
            $mail->Username   = 'taduc0508@gmail.com'; // Thay bằng email 
            $mail->Password   = 'ikwz kgyi hcby stai'; // Dùng App Password nếu bật 2FA
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Cấu hình người gửi & người nhận
            $mail->setFrom('your-email@gmail.com', 'Your Name');
            $mail->addAddress($to); // Gửi đến email khách hàng

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'GoBuy - Registration Email Confirmation';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<br><br><a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail->send();
        } catch (Exception $e) {
            // echo "Gửi email thất bại. Lỗi: {$mail->ErrorInfo}";
        }


        unset($_POST['cust_name']);
        unset($_POST['cust_email']);
        unset($_POST['cust_phone']);
        unset($_POST['cust_province']);
        unset($_POST['cust_district']);
        unset($_POST['cust_address']);
        $successMsg = 'Đăng ký của bạn đã hoàn tất. Vui lòng kiểm tra địa chỉ email của bạn để làm theo quy trình xác nhận đăng ký của bạn.';
    }
}
?>
<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_registration; ?>);">
    <div class="inner">
        <h1><?php echo 'Đăng ký tài khoản khách hàng' ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <?php
                                if ($errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                ?>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Tên đầy đủ' ?> *</label>
                                    <input type="text" class="form-control" name="cust_name" value="<?php if (isset($_POST['cust_name'])) {
                                                                                                        echo $_POST['cust_name'];
                                                                                                    } ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                    <input type="email" class="form-control" name="cust_email" value="<?php if (isset($_POST['cust_email'])) {
                                                                                                            echo $_POST['cust_email'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                    <input type="text" class="form-control" name="cust_phone" value="<?php if (isset($_POST['cust_phone'])) {
                                                                                                            echo $_POST['cust_phone'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Tỉnh/thành phố' ?> *</label>
                                    <select name="cust_province" class="form-control select1">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        <?php
                                        $querry = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                        $querry->execute();
                                        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                            <option value="<?php echo $row['province_id']; ?>">
                                                <?php echo $row['province_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Quận/huyện' ?> *</label>
                                    <input type="text" class="form-control" name="cust_district" value="<?php if (isset($_POST['cust_district'])) {
                                                                                                            echo $_POST['cust_district'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Xã/thị trấn' ?> *</label>
                                    <input type="text" class="form-control" name="cust_address" value="<?php if (isset($_POST['cust_address'])) {
                                                                                                            echo $_POST['cust_address'];
                                                                                                        } ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Nhập lại mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                </div>
                                <div class="col-md-12 form-group-btn">
                                    <input type="submit" class="btn btn-danger" value="<?php echo 'Đăng ký' ?>"
                                        name="form1">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="user-sidebar">
                    <ul>
                        <a href="registration-admin.php"><?php echo 'Đăng ký tài khoản admin' ?></a>
                    </ul>
                </div>
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

    .form-group-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn {
        border-radius: 6px;
        width: 30%;
    }

    .btn input {
        position: relative;
    }

    .user-sidebar {
        position: absolute;
        bottom: -30px;
        /* Đưa xuống dưới nút */
        right: 230px;
        /* Nằm bên phải */
    }

    .user-sidebar a {
        text-decoration: none;
        font-weight: bold;
        font-size: 12px;
    }

    .user-sidebar a:hover {
        text-decoration: underline;
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

if (!empty($successMsg)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($successMsg) . ", '#2ecc71');
    });</script>";
}
?>

<?php require_once('footer.php'); ?>