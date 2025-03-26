<?php require_once('header.php'); ?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/PHPMailer/src/Exception.php';
require '../PHPMailer/PHPMailer/src/PHPMailer.php';
require '../PHPMailer/PHPMailer/src/SMTP.php';
?>
<?php
$errorMsg = '';
if (isset($_POST['form1'])) {
    $valid = 1;

    // Kiểm tra nếu trường 'subject_text' bị bỏ trống
    if (empty($_POST['subject_text'])) {
        $valid = 0;
        $errorMsg .= 'Chủ đề không được để trống\n';
    }

    // Kiểm tra nếu trường 'message_text' bị bỏ trống
    if (empty($_POST['message_text'])) {
        $valid = 0;
        $errorMsg .= 'Nội dung tin nhắn không được để trống\n';
    }



    if ($valid == 1) {
        $subject_text = strip_tags($_POST['subject_text']);
        $message_text = strip_tags($_POST['message_text']);

        // Lấy địa chỉ email của khách hàng
        $query = $pdo->prepare("SELECT cust_email FROM table_customer WHERE cust_id=?");
        $query->execute([$_POST['cust_id']]);
        $cust_email = $query->fetchColumn();

        // Lấy địa chỉ email của quản trị viên
        $query = $pdo->prepare("SELECT contact_email FROM table_settings WHERE id=1");
        $query->execute();
        $admin_email = $query->fetchColumn();

        // Lấy thông tin đơn hàng
        $query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_id=?");
        $query->execute([$_POST['payment_id']]);
        $order_data = $query->fetch(PDO::FETCH_ASSOC);

        $payment_details = "";
        if ($order_data['payment_method'] == 'Ngân hàng') {
            $payment_details = "Mã giao dịch: " . $order_data['txnid'] . "<br>";
        }

        $order_detail = "<h3>Chi tiết đơn hàng:</h3>" .
            "Tên khách hàng: " . $order_data['customer_name'] . "<br>" .
            "Email khách hàng: " . $order_data['customer_email'] . "<br>" .
            "Phương thức thanh toán: " . $order_data['payment_method'] . "<br>" .
            "Ngày thanh toán: " . $order_data['payment_date'] . "<br>" .
            "Chi tiết thanh toán: <br>" . $payment_details . "<br>" .
            "Số tiền thanh toán: " . $order_data['paid_amount'] . "<br>" .
            "Trạng thái thanh toán: " . $order_data['payment_status'] . "<br>" .
            "Trạng thái giao hàng: " . $order_data['shipping_status'] . "<br>" .
            "Mã thanh toán: " . $order_data['payment_id'] . "<br>";

        // Lấy danh sách sản phẩm trong đơn hàng
        $query = $pdo->prepare("SELECT * FROM table_order WHERE payment_id=?");
        $query->execute([$_POST['payment_id']]);
        $products = $query->fetchAll(PDO::FETCH_ASSOC);

        $i = 0;
        foreach ($products as $row) {
            $i++;
            $order_detail .= "<br><b><u>Sản phẩm thứ $i</u></b><br>" .
                "Tên sản phẩm: " . $row['product_name'] . "<br>" .
                "Kích thước: " . $row['size'] . "<br>" .
                "Màu sắc: " . $row['color'] . "<br>" .
                "Số lượng: " . $row['quantity'] . "<br>" .
                "Giá đơn vị: " . $row['unit_price'] . "<br>";
        }

        // Lưu tin nhắn vào cơ sở dữ liệu
        $query = $pdo->prepare("INSERT INTO table_customer_message (subject, message, order_detail, cust_id) VALUES (?, ?, ?, ?)");
        $query->execute([$subject_text, $message_text, $order_detail, $_POST['cust_id']]);

        // Gửi email bằng PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Thay bằng SMTP server của bạn
            $mail->SMTPAuth = true;
            $mail->Username = 'taduc0508@gmail.com'; // Thay bằng email của bạn
            $mail->Password = 'ikwz kgyi hcby stai'; // Thay bằng mật khẩu email
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom($admin_email, 'Admin');
            $mail->addAddress($cust_email);
            $mail->isHTML(true);
            $mail->Subject = $subject_text;
            $mail->Body = "<html><body><h3>Nội dung tin nhắn:</h3>" . $message_text . "<h3>Chi tiết đơn hàng:</h3>" . $order_detail . "</body></html>";

            $mail->send();
            $successMsg = 'Email của bạn đã được gửi đến khách hàng thành công.';
        } catch (Exception $e) {
            $errorMsg = 'Gửi email thất bại. Lỗi: ' . $mail->ErrorInfo;
        }
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

<section class="content-header">
    <div class="content-header-left">
        <h1>Xem đơn hàng</h1>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Khách hàng</th>
                                <th>Chi tiết sản phẩm</th>
                                <th>Thông tin thanh toán</th>
                                <th>Số tiền thanh toán</th>
                                <th>Trạng thái thanh toán</th>
                                <th>Trạng thái giao hàng</th>
                                <th>Hành động</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $query = $pdo->prepare("SELECT * FROM table_payment ORDER by id DESC");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                            <tr class="<?php if ($row['payment_status'] == 'Pending') {
                                                echo 'bg-r';
                                            } else {
                                                echo 'bg-g';
                                            } ?>">
                                <td><?php echo $i; ?></td>
                                <td>
                                    <b>Id:</b> <?php echo $row['customer_id']; ?><br>
                                    <b>Name:</b><br> <?php echo $row['customer_name']; ?><br>
                                    <b>Email:</b><br> <?php echo $row['customer_email']; ?><br><br>
                                    <a href="#" data-toggle="modal" data-target="#model-<?php echo $i; ?>"
                                        class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Gửi tin
                                        nhắn</a>
                                    <div id="model-<?php echo $i; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" style="font-weight: bold;">Gửi tin nhắn</h4>
                                                </div>
                                                <div class="modal-body" style="font-size: 14px">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="cust_id"
                                                            value="<?php echo $row['customer_id']; ?>">
                                                        <input type="hidden" name="payment_id"
                                                            value="<?php echo $row['payment_id']; ?>">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>Tiêu đề</td>
                                                                <td>
                                                                    <input type="text" name="subject_text"
                                                                        class="form-control" style="width: 100%;">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Nội dung</td>
                                                                <td>
                                                                    <textarea name="message_text" class="form-control"
                                                                        cols="30" rows="10"
                                                                        style="width:100%;height: 200px;"></textarea>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td></td>
                                                                <td><input type="submit" value="Send Message"
                                                                        name="form1"></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        if (!isset($row['payment_id']) || empty($row['payment_id'])) {
                                            echo "❌ Không có id thanh toán!";
                                        } else {
                                            $statement1 = $pdo->prepare("SELECT * FROM table_order WHERE payment_id = ?");
                                            $statement1->execute([$row['payment_id']]);
                                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);

                                            if (empty($result1)) {
                                                echo "❌ Không tìm thấy đơn hàng!";
                                            } else {
                                                foreach ($result1 as $row1) {
                                                    echo '<b>Tên:</b> ' . htmlspecialchars($row1['product_name']);
                                                    echo '<br>(<b>Kích thước:</b> ' . htmlspecialchars($row1['size']);
                                                    echo ', <b>Màu:</b> ' . htmlspecialchars($row1['color']) . ')';
                                                    echo '<br>(<b>Số lượng:</b> ' . htmlspecialchars($row1['quantity']);
                                                    echo ', <b>Giá:</b> ' . htmlspecialchars($row1['unit_price']) . 'VND)';
                                                    echo '<br><br>';
                                                }
                                            }
                                        }
                                        ?>
                                </td>
                                <td>
                                    <?php if ($row['payment_method'] == 'Ngân hàng'): ?>
                                    <b>Phương thức thanh toán:</b>
                                    <?php echo '<span style="color:red;"><b>' . $row['payment_method'] . '</b></span>'; ?><br>
                                    <b>Id thanh toán:</b> <?php echo $row['payment_id']; ?><br>
                                    <b>Ngày thanh toán:</b> <?php echo $row['payment_date']; ?><br>
                                    <b>Mã giao dịch:</b> <?php echo $row['txnid']; ?><br>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $row['paid_amount']; ?>VND</td>
                                <td>
                                    <?php echo $row['payment_status']; ?>
                                    <br><br>
                                    <?php
                                        if ($row['payment_status'] == 'Pending') {
                                        ?>
                                    <a href="order-change-status.php?id=<?php echo $row['id']; ?>&task=Completed"
                                        class="btn btn-success btn-xs" style="width:100%;margin-bottom:4px;">Xác nhận
                                        hoàn thành</a>
                                    <?php
                                        }
                                        ?>
                                </td>
                                <td>
                                    <?php echo $row['shipping_status']; ?>
                                    <br><br>
                                    <?php
                                        if ($row['payment_status'] == 'Completed') {
                                            if ($row['shipping_status'] == 'Pending') {
                                        ?>
                                    <a href="shipping-change-status.php?id=<?php echo $row['id']; ?>&task=Completed"
                                        class="btn btn-warning btn-xs" style="width:100%;margin-bottom:4px;">Xác nhận
                                        hoàn thành</a>
                                    <?php
                                            }
                                        }
                                        ?>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-xs"
                                        data-href="order-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal"
                                        data-target="#confirm-delete" style="width:100%;">Xóa</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
            </div>
            <div class="modal-body">
                Bạn có muốn xóa item này?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>