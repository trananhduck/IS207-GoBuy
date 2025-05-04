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
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_registration = $row['banner_registration'];
}
?>

<?php
if (isset($_POST['form1'])) {

    $valid = 1;

    if (empty($_POST['full_name'])) {
        $valid = 0;
        $errorMsg .= 'Tên admin không được để trống';
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ email không được để trống';
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= 'Địa chỉ email phải hợp lệ';
        } else {
            $query = $pdo->prepare("SELECT * FROM table_admin WHERE email=?");
            $query->execute(array($_POST['email']));
            $total = $query->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= 'Địa chỉ email đã tồn tại';
            }
        }
    }

    if (empty($_POST['phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống';
    }

    if (empty($_POST['password']) || empty($_POST['re_password'])) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không được để trống';
    } else {
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        // Kiểm tra độ dài mật khẩu (tối thiểu 6, khuyến nghị 12-16)
        if (strlen($password) < 6) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải có ít nhất 6 ký tự';
        }

        // Kiểm tra mật khẩu có đủ yêu cầu không
        elseif (!preg_match('/[A-Z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa';
        } elseif (!preg_match('/[a-z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết thường';
        } elseif (!preg_match('/\d/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ số';
        } elseif (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...)';
        }

        // Kiểm tra xác nhận mật khẩu
        elseif ($password !== $re_password) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu nhập lại không khớp';
        }
    }

    if (!empty($_POST['password']) && !empty($_POST['re_password'])) {
        if ($_POST['password'] != $_POST['re_password']) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu không khớp';
        }
    }

    if ($valid == 1) {

        $token = md5(time());
        $datetime = date('Y-m-d h:i:s');
        $timestamp = time();
        // Kiểm tra ảnh, đặt giá trị mặc định nếu không có
        $photo = isset($_POST['photo']) ? $_POST['photo'] : 'default.jpg';

        //Lưu vào DB
        $query = $pdo->prepare("INSERT INTO table_admin (
                                        full_name,
                                        email,
                                        phone,
                                        password,
                                        photo, 
                                        token,
                                        datetime,
                                        timestamp,
                                        status
                                    ) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->execute(array(
            // Loại bỏ các thẻ HTML khỏi dữ liệu nhập vào để tránh XSS (Cross-Site Scripting)
            strip_tags($_POST['full_name']),  // Tên admin
            strip_tags($_POST['email']),     // Email admin
            strip_tags($_POST['phone']),     // Số điện thoại admin
            // Mã hóa mật khẩu bằng MD5 
            md5($_POST['password']),
            $photo,
            // Token dùng để xác thực (có thể là token đăng ký hoặc xác nhận email)
            $token,

            // Thời gian đăng ký admin
            $datetime,   // Định dạng thời gian
            $timestamp,  // Timestamp (số nguyên)
            0 //tài khoản chưa được kích hoạt

        ));

        // Kiểm tra xem đang chạy trên localhost hay server thật
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $base_url = 'http://localhost/IS207-GoBuy/';
        } else {
            $base_url = BASE_URL; // Dùng BASE_URL bình thường nếu chạy trên server
        }

        // Gửi email xác nhận tài khoản
        $to = $_POST['email'];

        $subject = 'GoBuy - Admin Registration Email Confirmation';
        $verify_link = $base_url . 'verify-admin.php?email=' . urlencode($to) . '&token=' . urlencode($token);
        $message = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '
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
            $mail->addAddress($to); // Gửi đến email admin

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'GoBuy - Registration Email Confirmation';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail->send();
            // echo 'Email xác nhận đã được gửi!';
        } catch (Exception $e) {
            // echo "Gửi email thất bại. Lỗi: {$mail->ErrorInfo}";
        }


        unset($_POST['full_name']);
        unset($_POST['email']);
        unset($_POST['phone']);

        $successMsg = 'Đăng ký của bạn đã hoàn tất. Vui lòng kiểm tra địa chỉ email của bạn để làm theo quy trình xác nhận đăng ký của bạn.';
    }
}
?>

<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_registration; ?>);">
    <div class="inner">
        <h1><?php echo 'Đăng ký tài khoản admin' ?></h1>
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
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Tên đầy đủ' ?> *</label>
                                    <input type="text" class="form-control" name="full_name" value="<?php if (isset($_POST['full_name'])) {
                                                                                                        echo $_POST['full_name'];
                                                                                                    } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                    <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                    <input type="text" class="form-control" name="phone" value="<?php if (isset($_POST['phone'])) {
                                                                                                    echo $_POST['phone'];
                                                                                                } ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Ảnh đại diện' ?> *</label>
                                    <input type="file" class="form-control" name="avatar">
                                </div>

                                <div class="col-md-6 form-group position-relative">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control password-input" name="password" id="password">
                                    <span class="toggle-password" onclick="togglePassword(this)" style="right: 15px;">
                                        👁️
                                    </span>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Nhập lại mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="re_password">
                                </div>

                                <div class="col-md-6 form-group-btn">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-danger" value="<?php echo 'Đăng ký' ?>"
                                        name="form1">
                                </div>

                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="account-sidebar res">
                    <ul>
                        <a href="registration-customer.php"><?php echo 'Đăng ký tài khoản khách hàng' ?></a>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<!-- Toast Container -->
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
        transition: opacity 0.5s ease, transform 0.5s ease;
        z-index: 9999;
        transform: translateY(-20px);
    }

    #toast.show {
        opacity: 1;
        transform: translateY(0);
    }

    .form-group-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        margin-top: 15px;
    }

    .btn-danger {
        width: 50%;
        max-width: 200px;
        text-align: center;
    }

    .btn {
        border-radius: 6px;
        width: 30%;
    }

    .btn input {
        position: relative;
    }

    .account-sidebar {
        position: absolute;
        bottom: -30px;
        right: 230px;
    }

    .account-sidebar a {
        text-decoration: none;
        font-weight: bold;
        font-size: 12px;
    }

    .account-sidebar a:hover {
        text-decoration: underline;
    }
</style>

<script>
    function showToast(message, bg = "#333") {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.style.backgroundColor = bg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 4000);
    }
    function togglePassword(el) {
    const input = el.previousElementSibling;
    const isPassword = input.getAttribute("type") === "password";
    input.setAttribute("type", isPassword ? "text" : "password");
    el.textContent = isPassword ? "🙈" : "👁️";
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