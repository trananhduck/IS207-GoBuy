<?php require_once('header.php'); ?>
<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}
?>

<?php
if (isset($_POST['form1'])) {
    if (empty($_POST['cust_email']) || empty($_POST['cust_password'])) {
        $_SESSION['error_message'] = 'Email và mật khẩu không thể để trống.';
    } else {
        $cust_email = strip_tags($_POST['cust_email']);
        $cust_password = strip_tags($_POST['cust_password']);

        $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_email=?");
        $query->execute([$cust_email]);
        $total = $query->rowCount();

        if ($total == 0) {
            $_SESSION['error_message'] = 'Địa chỉ email không khớp.';
        } else {
            $row = $query->fetch(PDO::FETCH_ASSOC);
            if ($row['cust_password'] != md5($cust_password)) {
                $_SESSION['error_message'] = 'Mật khẩu không khớp.';
            } elseif ($row['cust_status'] == 0) {
                $_SESSION['error_message'] = 'Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email hoặc liên hệ quản trị viên.';
            } else {
                $_SESSION['customer'] = $row;
                $_SESSION['success_message'] = 'Đăng nhập thành công! Chào mừng bạn trở lại.';
                header("Location: " . BASE_URL . "index.php");
                exit;
            }
        }
    }
}
?>

<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_login; ?>);">
    <div class="inner">
        <h1>Đăng nhập với tư cách khách hàng</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="admin-content">
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="form-group admin">
                                    <label>Địa chỉ email *</label>
                                    <input type="email" class="form-control" name="cust_email">
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                </div>
                                <div class="form-group d-flex">
                                    <input type="submit" class="btn btn-danger" value="Đăng nhập" name="form1">
                                </div>
                                <a href="forget-password.php">Quên mật khẩu?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="user-sidebar login">
                    <ul>
                        <a href="login-admin.php">
                            Đăng nhập với tư cách admin
                        </a>
                    </ul>
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

.form-group.d-flex {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.col-md-4 a {
    color: #007bff;
    font-size: 14px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease, text-decoration 0.3s ease;
}

.col-md-4 a:hover {
    color: rgb(41, 14, 133);
    text-decoration: underline;
}

.form-group .btn-danger {
    margin-left: auto;
}

.user-sidebar {
    position: absolute;
    right: 403px;
    top: -20px;
}


.user-sidebar a:hover {
    color: rgb(41, 14, 133);
    text-decoration: underline;
}

.user-sidebar a {
    color: #007bff;
    font-size: 14px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease, text-decoration 0.3s ease;
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

<?php
// Hiển thị toast nếu có trong session
if (isset($_SESSION['error_message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($_SESSION['error_message']) . ", '#e74c3c');
    });</script>";
    unset($_SESSION['error_message']);
}
?>

<?php require_once('footer.php'); ?>