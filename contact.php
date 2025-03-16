<?php require_once('header.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<?php
// Lấy thông tin tiêu đề và banner trang liên hệ từ database
$statement = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $contact_title = $row['contact_title'];
    $contact_banner = $row['contact_banner'];
}

// Lấy thông tin liên hệ từ bảng cài đặt
$statement = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $contact_map_iframe = $row['contact_map_iframe'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $contact_address = $row['contact_address'];
}
?>

<!-- Hiển thị banner trang liên hệ -->
<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $contact_banner; ?>);">
    <div class="inner">
        <h1><?php echo $contact_title; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Biểu mẫu liên hệ</h3>
                <div class="row cform">
                    <div class="col-md-8">
                        <div class="well well-sm">

                            <?php
                            // Kiểm tra khi người dùng gửi biểu mẫu
                            if (isset($_POST['form_contact'])) {
                                $errorMsg = '';
                                $successMsg = '';

                                $statement = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
                                $statement->execute();
                                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $receive_email = $row['receive_email'];
                                    $receive_email_subject = $row['receive_email_subject'];
                                    $receive_email_thank_you_message = $row['receive_email_thank_you_message'];
                                }

                                $valid = 1;

                                if (empty($_POST['visitor_name'])) {
                                    $valid = 0;
                                    $errorMsg .= 'Vui lòng nhập tên của bạn.\n';
                                }
                                if (empty($_POST['visitor_phone'])) {
                                    $valid = 0;
                                    $errorMsg .= 'Vui lòng nhập số điện thoại của bạn.\n';
                                }
                                if (empty($_POST['visitor_email'])) {
                                    $valid = 0;
                                    $errorMsg .= 'Vui lòng nhập địa chỉ email.\n';
                                } else {
                                    if (!filter_var($_POST['visitor_email'], FILTER_VALIDATE_EMAIL)) {
                                        $valid = 0;
                                        $errorMsg .= 'Vui lòng nhập địa chỉ email hợp lệ.\n';
                                    }
                                }
                                if (empty($_POST['visitor_message'])) {
                                    $valid = 0;
                                    $errorMsg .= 'Vui lòng nhập tin nhắn của bạn.\n';
                                }

                                if ($valid == 1) {
                                    $visitor_name = strip_tags($_POST['visitor_name']);
                                    $visitor_email = strip_tags($_POST['visitor_email']);
                                    $visitor_phone = strip_tags($_POST['visitor_phone']);
                                    $visitor_message = strip_tags($_POST['visitor_message']);

                                    // Gửi email
                                    $to_admin = $receive_email;
                                    $subject = $receive_email_subject;
                                    $message = '<html><body>
                                    <table>
                                    <tr><td>Họ và tên</td><td>' . $visitor_name . '</td></tr>
                                    <tr><td>Email</td><td>' . $visitor_email . '</td></tr>
                                    <tr><td>Số điện thoại</td><td>' . $visitor_phone . '</td></tr>
                                    <tr><td>Nội dung</td><td>' . nl2br($visitor_message) . '</td></tr>
                                    </table>
                                    </body></html>';
                                    $headers = 'From: ' . $visitor_email . "\r\n" .
                                        'Reply-To: ' . $visitor_email . "\r\n" .
                                        'X-Mailer: PHP/' . phpversion() . "\r\n" .
                                        "MIME-Version: 1.0\r\n" .
                                        "Content-Type: text/html; charset=UTF-8\r\n";



                                    require 'PHPMailer/PHPMailer/src/Exception.php';
                                    require 'PHPMailer/PHPMailer/src/PHPMailer.php';
                                    require 'PHPMailer/PHPMailer/src/SMTP.php';

                                    $mail = new PHPMailer(true);

                                    try {
                                        // Cấu hình SMTP
                                        $mail->isSMTP();
                                        $mail->Host       = 'smtp.gmail.com'; // SMTP của Gmail
                                        $mail->SMTPAuth   = true;
                                        $mail->Username   = 'taduc0508@gmail.com'; // Email gửi
                                        $mail->Password   = 'ikwz kgyi hcby stai'; // Mật khẩu ứng dụng (App Password)
                                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                        $mail->Port       = 587;

                                        // Cấu hình email
                                        $mail->setFrom($visitor_email, $visitor_name);
                                        $mail->addAddress($to_admin);
                                        $mail->addReplyTo($visitor_email, $visitor_name);

                                        // Nội dung email
                                        $mail->isHTML(true);
                                        $mail->Subject = $subject;
                                        $mail->Body    = $message;

                                        // Gửi email
                                        $mail->send();
                                        $successMsg = $receive_email_thank_you_message;
                                    } catch (Exception $e) {
                                        $errorMsg = 'Email không thể gửi. Lỗi: ' . $mail->ErrorInfo;
                                    }
                                    $successMsg = $receive_email_thank_you_message;
                                }
                            }
                            ?>

                            <?php
                            if ($errorMsg != '') {
                                echo "<script>alert('" . $errorMsg . "')</script>";
                            }
                            if ($successMsg != '') {
                                echo "<script>alert('" . $successMsg . "')</script>";
                            }
                            ?>

                            <form action="" method="post">
                                <?php $csrf->echoInputField(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Họ và tên</label>
                                            <input type="text" class="form-control" name="visitor_name"
                                                placeholder="Nhập họ và tên">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Địa chỉ email</label>
                                            <input type="email" class="form-control" name="visitor_email"
                                                placeholder="Nhập email">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Số điện thoại</label>
                                            <input type="text" class="form-control" name="visitor_phone"
                                                placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="message">Tin nhắn</label>
                                            <textarea name="visitor_message" class="form-control" rows="9"
                                                placeholder="Nhập tin nhắn"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" value="Gửi tin nhắn" class="btn btn-primary pull-right"
                                            name="form_contact">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <legend><span class="glyphicon glyphicon-globe"></span> Văn phòng của chúng tôi</legend>
                        <address><?php echo nl2br($contact_address); ?></address>
                        <address>
                            <strong>Điện thoại:</strong><br>
                            <span><?php echo $contact_phone; ?></span>
                        </address>
                        <address>
                            <strong>Email:</strong><br>
                            <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                        </address>
                    </div>
                </div>
                <h3>Vị trí trên bản đồ</h3>
                <?php echo $contact_map_iframe; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>