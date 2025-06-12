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
        $errorMsg .= "Tên admin không được để trống <br>";
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $errorMsg .= "Địa chỉ email không được để trống <br>";
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= "Địa chỉ email phải hợp lệ <br>";
        } else {
            $query = $pdo->prepare("SELECT * FROM table_admin WHERE email=?");
            $query->execute(array($_POST['email']));
            $total = $query->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= "Địa chỉ email đã tồn tại <br>";
            }
        }
    }

    if (empty($_POST['phone'])) {
        $valid = 0;
        $errorMsg .= "Số điện thoại không được để trống <br>";
    }

    if (empty($_POST['password']) || empty($_POST['re_password'])) {
        $valid = 0;
        $errorMsg .= "Mật khẩu không được để trống <br>";
    } else {
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        if (strlen($password) < 6) {
            $valid = 0;
            $errorMsg .= "Mật khẩu phải có ít nhất 6 ký tự <br>";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $valid = 0;
            $errorMsg .= "Mật khẩu phải chứa ít nhất một chữ cái viết hoa <br>";
        } elseif (!preg_match('/[a-z]/', $password)) {
            $valid = 0;
            $errorMsg .= "Mật khẩu phải chứa ít nhất một chữ cái viết thường <br>";
        } elseif (!preg_match('/\d/', $password)) {
            $valid = 0;
            $errorMsg .= "Mật khẩu phải chứa ít nhất một chữ số <br>";
        } elseif (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/', $password)) {
            $valid = 0;
            $errorMsg .= "Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...) <br>";
        } elseif ($password !== $re_password) {
            $valid = 0;
            $errorMsg .= "Mật khẩu nhập lại không khớp <br>";
        }
    }

    if ($valid == 1) {

        $token = md5(time()); // vẫn có thể dùng md5 ở đây vì chỉ là token xác nhận, không phải mật khẩu
        $datetime = date('Y-m-d h:i:s');
        $timestamp = time();

        // Kiểm tra ảnh, đặt giá trị mặc định nếu không có
        $photo = isset($_POST['photo']) ? $_POST['photo'] : 'default.jpg';

        // ======= BẢO MẬT MẬT KHẨU BẰNG password_hash() =========
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

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
            strip_tags($_POST['full_name']),
            strip_tags($_POST['email']),
            strip_tags($_POST['phone']),
            $hashed_password, // THAY md5 bằng password_hash
            $photo,
            $token,
            $datetime,
            $timestamp,
            0 // tài khoản chưa kích hoạt
        ));

        // Kiểm tra xem đang chạy trên localhost hay server thật
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $base_url = 'http://localhost/IS207-GoBuy/';
        } else {
            $base_url = BASE_URL;
        }

        // Gửi email xác nhận tài khoản
        $to = $_POST['email'];
        $verify_link = $base_url . 'verify-admin.php?email=' . urlencode($to) . '&token=' . urlencode($token);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'taduc0508@gmail.com';
            $mail->Password   = 'rnxm lczq zhop hsdt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('your-email@gmail.com', 'GoBuy');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = 'GoBuy - Registration Email Confirmation';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' .
                '<a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail->send();
        } catch (Exception $e) {
            // Log lỗi nếu cần
        }

        unset($_POST['full_name']);
        unset($_POST['email']);
        unset($_POST['phone']);

        $successMsg = 'Đăng ký của bạn đã hoàn tất. Vui lòng kiểm tra email để xác nhận tài khoản.';
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
                                    <label for=""><?php echo 'Ảnh đại diện' ?></label>
                                    <input type="file" class="form-control" name="avatar">
                                </div>

                                <div class="col-md-6 form-group position-relative">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control password-input" name="password"
                                        id="password">
                                    <span class="toggle-password" onclick="togglePassword(this)"
                                        style="right: 25px; cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>

                                </div>

                                <div class="col-md-6 form-group position-relative">
                                    <label for=""><?php echo 'Nhập lại mật khẩu' ?> *</label>
                                    <input type="password" class="form-control password-input" name="re_password">
                                    <span class="toggle-password" onclick="togglePassword(this)"
                                        style="right: 25px; cursor: pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
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
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.toast-message {
    background-color: #f44336;
    color: white;
    padding: 12px 18px;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    font-family: 'Segoe UI', sans-serif;
    font-size: 15px;
    min-width: 250px;
    max-width: 300px;
    opacity: 0;
    transform: translateX(30px);
    animation: fadeInSlide 0.4s ease forwards;
    position: relative;
}

@keyframes fadeInSlide {
    from {
        opacity: 0;
        transform: translateX(30px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeOutSlide {
    from {
        opacity: 1;
        transform: translateX(0);
    }

    to {
        opacity: 0;
        transform: translateX(30px);
    }
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
function showToast(message, background = '#f44336') {
    const container = document.getElementById('toast');

    const toast = document.createElement('div');
    toast.className = 'toast-message';
    toast.style.backgroundColor = background;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'fadeOutSlide 0.5s ease forwards';
        setTimeout(() => toast.remove(), 500);
    }, 2500);
}

function togglePassword(el) {
    const input = el.previousElementSibling;
    const icon = el.querySelector("i");
    const isPassword = input.getAttribute("type") === "password";

    input.setAttribute("type", isPassword ? "text" : "password");

    icon.classList.toggle("fa-eye", !isPassword);
    icon.classList.toggle("fa-eye-slash", isPassword);
}
</script>


<?php
if (isset($errorMsg) && !empty($errorMsg)) {
    // Tách chuỗi lỗi theo dấu xuống dòng  <br>
    $errors = array_filter(array_map('trim', explode(" <br>", $errorMsg)));

    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {";

    foreach ($errors as $msg) {
        echo "showToast(" . json_encode($msg) . ");";
    }

    echo "});
    </script>";
}

if (!empty($successMsg)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($successMsg) . ", '#2ecc71');
    });</script>";
}
?>
<?php require_once('footer.php'); ?>