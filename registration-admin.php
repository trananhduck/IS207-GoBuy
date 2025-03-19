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

    if (empty($_POST['full_name'])) {
        $valid = 0;
        $errorMsg .= 'Tên admin không được để trống' . "<br>";
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ email không được để trống' . "<br>";
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= 'Địa chỉ email phải hợp lệ' . "<br>";
        } else {
            $querry = $pdo->prepare("SELECT * FROM table_user WHERE email=?");
            $querry->execute(array($_POST['email']));
            $total = $querry->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= 'Địa chỉ email đã tồn tại' . "<br>";
            }
        }
    }

    if (empty($_POST['phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống' . "<br>";
    }

    if (empty($_POST['password']) || empty($_POST['re_password'])) {
        $valid = 0;
        $errorMsg .= 'Mật khẩu không được để trống' . "<br>";
    }

    if (!empty($_POST['password']) && !empty($_POST['re_password'])) {
        if ($_POST['password'] != $_POST['re_password']) {
            $valid = 0;
            $errorMsg .= 'Mật khẩu không khớp' . "<br>";
        }
    }

    if ($valid == 1) {

        $token = md5(time());
        $datetime = date('Y-m-d h:i:s');
        $timestamp = time();
        // Kiểm tra ảnh, đặt giá trị mặc định nếu không có
        $photo = isset($_POST['photo']) ? $_POST['photo'] : 'default.jpg';

        //Lưu vào DB
        $querry = $pdo->prepare("INSERT INTO table_user (
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
        $querry->execute(array(
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
            $mail->addAddress($to); // Gửi đến email admin

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'GoBuy - Registration Email Confirmation';
            $mail->Body    = 'Cảm ơn bạn đã đăng ký! Tài khoản của bạn đã được tạo. Để kích hoạt tài khoản của bạn, hãy click vào link bên dưới: ' . '<br><br><a href="' . $verify_link . '">' . $verify_link . '</a>';

            $mail->send();
            echo 'Email xác nhận đã được gửi!';
        } catch (Exception $e) {
            echo "Gửi email thất bại. Lỗi: {$mail->ErrorInfo}";
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

                                <?php
                                if ($errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                if ($successMsg != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                                }
                                ?>
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

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="password">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Nhập lại mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="re_password">
                                </div>

                                <div class="col-md-6 form-group">
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
                <div class="user-sidebar">
                    <ul>
                        <a href="registration-customer.php"><button
                                class="btn btn-danger"><?php echo 'Đăng ký tài khoản khách hàng' ?></button></a>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php require_once('footer.php'); ?>