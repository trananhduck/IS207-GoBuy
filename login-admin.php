<?php require_once('header.php'); ?>
<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}
?>
<!-- login form -->
<?php
if (isset($_POST['form1'])) {

    if (empty($_POST['email']) || empty($_POST['password'])) {
        $errorMsg = 'Email và mật khẩu không thể để trống' . '<br>';
    } else {

        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        $query = $pdo->prepare("SELECT * FROM table_admin WHERE email=?");
        $query->execute(array($email));
        $total = $query->rowCount();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $status = $row['status'];
            $row_password = $row['password'];
        }

        if ($total == 0) {
            $errorMsg .= 'Địa chỉ email không khớp.' . '<br>';
        } else {
            //using MD5 form
            if ($row_password != md5($password)) {
                $errorMsg .= 'Mật khẩu không khớp' . '<br>';
            } else {
                if ($status == 0) {
                    $errorMsg .= 'Xin lỗi! Tài khoản của bạn không hoạt động.' . '<br>';
                } else {
                    $_SESSION['admin'] = $row;
                    header("location: " . BASE_URL . "admin/service.php");
                }
            }
        }
    }
}
?>

<div class="page-banner"
    style="background-color:#444;background-image: url(assets/uploads/<?php echo $banner_login; ?>);">
    <div class="inner">
        <h1><?php echo 'Đăng nhập với tư cách admin' ?></h1>
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
                            <div class="col-md-4 box">
                                <?php
                                if ($errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                if ($successMsg != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                                }
                                ?>
                                <div class="form-group">
                                    <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="form-group d-flex">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-danger" value="<?php echo 'Đăng nhập' ?>"
                                        name="form1">
                                </div>
                                <a href="forget-password.php"><?php echo 'Quên mật khẩu' ?>?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="account-sidebar login">
                    <ul>
                        <a href="login-customer.php"><?php echo 'Đăng nhập với tư cách khách hàng' ?></a>
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

@media (max-width: 1200px) {
    .admin-content .box {
        max-width: 100%;
        margin: 0 auto;
    }
    .admin-content .box a{
        text-align: center;
    }
    .account-sidebar {
        position: relative;
        left: auto;
        top: -90px;
        text-align: center;
        margin-top: 15px;
    }

    .admin-content .form-control {
        font-size: 15px;
        padding: 10px;
    }

    .btn-danger {
        font-size: 15px;
        padding: 12px;
    }
}
@media (max-width: 992px) {
    .admin-content .box {
        max-width: 90%;
        margin: 0 auto;
    }
    .admin-content .box a{
        text-align: right;
    }
    .account-sidebar {
        position: relative;
        left: -203px;
        top: -130px;
        text-align: center;
        margin-top: 10px;
    }
}

/* Responsive cho điện thoại */
@media (max-width: 768px) {
    .admin-content {
        padding: 20px;
    }

    .admin-content .box {
        padding: 15px;
        box-shadow: none; /* Bỏ bóng trên mobile để giao diện nhẹ hơn */
    }
    .admin-content .box a{
        text-align: center;
    }
    .admin-content .form-control {
        font-size: 13px;
        padding: 8px;
    }

    .btn-danger {
        font-size: 14px;
        padding: 10px;
    }

    .form-group.d-flex {
        flex-direction: column;
        align-items: stretch;
    }

    .account-sidebar {
        position: relative;
        text-align: center;
        left: auto;
        top: -80px;
        margin-top: 10px;
    }

    .account-sidebar a {
        display: block;
        padding: 10px;
        font-size: 13px;
        width: 100%;
        text-align: center;
    }
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