<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem khách hàng đã đăng nhập chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Kiểm tra xem khách hàng có bị admin vô hiệu hóa hay không
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=? AND cust_status=?");
    $query->execute([$_SESSION['customer']['cust_id'], 0]);

    if ($query->rowCount() > 0) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}

// Xử lý cập nhật mật khẩu
if (isset($_POST['form1'])) {
    $valid = true;
    $errorMsg = '';
    $successMsg = '';

    $password = $_POST['cust_password'] ?? '';
    $rePassword = $_POST['cust_re_password'] ?? '';

    if (empty($password) || empty($rePassword)) {
        $valid = false;
        $errorMsg .= 'Mật khẩu không được để trống.<br>';
    } else {
        // Kiểm tra độ dài mật khẩu (tối thiểu 6, khuyến nghị 12-16)
        if (strlen($password) < 6) {
            $valid = false;
            $errorMsg .= 'Mật khẩu phải có ít nhất 6 ký tự.<br>';
        }

        // Kiểm tra mật khẩu có đủ yêu cầu không
        elseif (!preg_match('/[A-Z]/', $password)) {
            $valid = false;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa.<br>';
        } elseif (!preg_match('/[a-z]/', $password)) {
            $valid = false;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ cái viết thường.<br>';
        } elseif (!preg_match('/\d/', $password)) {
            $valid = false;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một chữ số.<br>';
        } elseif (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/', $password)) {
            $valid = false;
            $errorMsg .= 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt (!@#$%^&*...).<br>';
        }

        // Kiểm tra xác nhận mật khẩu
        elseif ($password !== $rePassword) {
            $valid = false;
            $errorMsg .= 'Mật khẩu nhập lại không khớp.<br>';
        }
    }

    if ($valid) {
        // Cập nhật mật khẩu trong cơ sở dữ liệu
        $hashedPassword = md5(strip_tags($password));
        $query = $pdo->prepare("UPDATE table_customer SET cust_password=? WHERE cust_id=?");
        $query->execute([$hashedPassword, $_SESSION['customer']['cust_id']]);

        // Cập nhật lại mật khẩu trong session
        $_SESSION['customer']['cust_password'] = $hashedPassword;
        $successMsg = 'Mật khẩu được cập nhật thành công.';
    }
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="user-content">
                    <h3 class="text-center">
                        <?php echo 'Cập nhật mật khẩu' ?>
                    </h3>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <?php
                                if (!empty($errorMsg)) {
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                                        showToast(" . json_encode(strip_tags($errorMsg)) . ", '#e74c3c');
                                    });</script>";
                                }
            
                                if (!empty($successMsg)) {
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() {
                                        showToast(" . json_encode(strip_tags($successMsg)) . ", '#27ae60');
                                    });</script>";
                                }
                                ?>
                                <div class="form-group">
                                    <label for=""><?php echo 'Mật khẩu mới' ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo 'Nhập lại mật khẩu mới' ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                </div>
                                <div class="form-group text-right">
                                    <input type="submit" class="btn btn-primary" value="<?php echo 'Cập nhật' ?>"
                                        name="form1">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
</style>
<script>
    function showToast(message, bg = "#333") {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.style.backgroundColor = bg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 4000);
    }
</script>
<?php require_once('footer.php'); ?>