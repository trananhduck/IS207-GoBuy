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
    $errorMsg = '';

    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $errorMsg .= 'Tên khách hàng không được để trống<br>';
    }

    // Kiểm tra giới tính
    if (empty($_POST['cust_gender'])) {
        $valid = 0;
        $errorMsg .= 'Vui lòng chọn giới tính<br>';
    }

    // Kiểm tra năm sinh
    if (empty($_POST['cust_birthyear'])) {
        $valid = 0;
        $errorMsg .= 'Vui lòng chọn năm sinh<br>';
    }

    if (empty($_POST['cust_email'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ email không được để trống<br>';
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= 'Địa chỉ email phải hợp lệ<br>';
        } else {
            $querry = $pdo->prepare("SELECT * FROM table_customer WHERE cust_email=?");
            $querry->execute(array($_POST['cust_email']));
            $total = $querry->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= 'Địa chỉ email đã tồn tại<br>';
            }
        }
    }

    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống<br>';
    }

    if (empty($_POST['cust_password']) || empty($_POST['cust_re_password'])) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không được để trống<br>';
    } else {
        $password = $_POST['cust_password'];
        $re_password = $_POST['cust_re_password'];

        // Kiểm tra độ dài mật khẩu (tối thiểu 6, khuyến nghị 12-16)
        if (strlen($password) < 6) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải có ít nhất 6 ký tự<br>';
        }

        // Kiểm tra mật khẩu có đủ yêu cầu không
        elseif (!preg_match('/[A-Z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa<br>';
        } elseif (!preg_match('/[a-z]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết thường<br>';
        } elseif (!preg_match('/\d/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ số<br>';
        } elseif (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/', $password)) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...)<br>';
        }

        // Kiểm tra xác nhận mật khẩu
        elseif ($password !== $re_password) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu nhập lại không khớp<br>';
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
                                         cust_gender,
                                         cust_birthyear,
                                         cust_s_name,
                                         cust_s_phone,
                                         cust_s_province,
                                         cust_s_district,
                                         cust_s_ward,
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
            strip_tags($_POST['cust_gender']),    // Giới tính
            strip_tags($_POST['cust_birthyear']), // Năm sinh
            '',
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
        $message = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<a href="' . $verify_link . '">' . $verify_link . '</a>';


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
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail->send();
        } catch (Exception $e) {
            // echo "Gửi email thất bại. Lỗi: {$mail->ErrorInfo}";
        }


        unset($_POST['cust_name']);
        unset($_POST['cust_email']);
        unset($_POST['cust_phone']);
        unset($_POST['cust_gender']);
        unset($_POST['cust_birthyear']);
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
                                if (isset($errorMsg) && $errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                ?>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Tên đầy đủ' ?> *</label>
                                    <input type="text" class="form-control" name="cust_name" value="<?php if (isset($_POST['cust_name'])) {
                                                                                                        echo $_POST['cust_name'];
                                                                                                    } ?>">
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="">Giới tính *</label>
                                    <select class="form-control" name="cust_gender">
                                        <option value="">Chọn giới tính</option>
                                        <option value="Nam"
                                            <?php if (isset($_POST['cust_gender']) && $_POST['cust_gender'] == "Nam") echo "selected"; ?>>
                                            Nam</option>
                                        <option value="Nữ"
                                            <?php if (isset($_POST['cust_gender']) && $_POST['cust_gender'] == "Nữ") echo "selected"; ?>>
                                            Nữ</option>
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="">Năm sinh *</label>
                                    <select class="form-control" name="cust_birthyear">
                                        <option value="">Chọn năm</option>
                                        <?php
                                        for ($year = 2024; $year >= 1950; $year--) {
                                            echo "<option value='$year'";
                                            if (isset($_POST['cust_birthyear']) && $_POST['cust_birthyear'] == $year) echo " selected";
                                            echo ">$year</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                    <input type="text" class="form-control" name="cust_phone" value="<?php if (isset($_POST['cust_phone'])) {
                                                                                                            echo $_POST['cust_phone'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                    <input type="email" class="form-control" name="cust_email" value="<?php if (isset($_POST['cust_email'])) {
                                                                                                            echo $_POST['cust_email'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group position-relative">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control password-input" name="cust_password" id="cust_password">
                                    <span class="toggle-password" onclick="togglePasswordCust()" style="right: 15px;">
                                        👁️
                                    </span>
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
                <div class="account-sidebar res">
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

    .account-sidebar.res {
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
    function showToast(message, color = '#333') {
        const toast = document.getElementById('toast');
        toast.innerText = message;
        toast.style.backgroundColor = color;
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 4000);
    }
    function togglePasswordCust() {
    const passwordInput = document.getElementById("cust_password");
    const toggleIcon = document.querySelector(".toggle-password");
    const isPassword = passwordInput.getAttribute("type") === "password";
    passwordInput.setAttribute("type", isPassword ? "text" : "password");
    toggleIcon.textContent = isPassword ? "🙈" : "👁️";
}
</script>

<?php
if (isset($successMsg) && !empty($successMsg)) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($successMsg) . ", '#2ecc71');
    });</script>";
}
?>
<script>
    // Script khởi tạo cho trang đăng ký
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo rằng API đã được khởi tạo trong header.php
        if (typeof initializeAddressSelects === 'function') {
            initializeAddressSelects();
        } else {
            console.error('API địa chỉ chưa được khởi tạo đúng cách.');
        }

        // Xử lý lỗi khi submit form
        <?php if ($errorMsg != ''): ?>
            // Phục hồi dữ liệu đã chọn nếu có lỗi form
            setTimeout(function() {
                const provinceValue =
                    "<?php echo isset($_POST['cust_province']) ? $_POST['cust_province'] : ''; ?>";
                const districtValue =
                    "<?php echo isset($_POST['cust_district']) ? $_POST['cust_district'] : ''; ?>";
                const wardValue = "<?php echo isset($_POST['cust_address']) ? $_POST['cust_address'] : ''; ?>";

                // Hiển thị lỗi trong select
                if (provinceValue) {
                    document.getElementById('province-select').classList.add('error-field');
                }
                if (districtValue) {
                    document.getElementById('district-select').classList.add('error-field');
                }
                if (wardValue) {
                    document.getElementById('ward-select').classList.add('error-field');
                }
            }, 500);
        <?php endif; ?>
    });
</script>

<style>
    /* Thêm style cho select khi có lỗi */
    .error-field {
        border: 1px solid #f00 !important;
    }
</style>
<?php require_once('footer.php'); ?>