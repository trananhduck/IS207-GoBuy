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

            // Kiểm tra mật khẩu sử dụng password_verify thay vì md5
            if (!password_verify($cust_password, $row['cust_password'])) {
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
                            <div class="col-md-4 box">
                                <div class="form-group admin">
                                    <label>Địa chỉ email *</label>
                                    <input type="email" class="form-control" name="cust_email">
                                </div>
                                <div class="form-group position-relative">
                                    <label>Mật khẩu *</label>
                                    <input type="password" class="form-control password-input" name="cust_password"
                                        id="cust_password">
                                    <span class="toggle-password" onclick="togglePassword()"
                                        style="position:absolute; cursor:pointer;">
                                        <i class="fa fa-eye"></i>
                                    </span>
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
                <div class="account-sidebar login">
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

    @media (max-width: 1200px) {
        .admin-content .box {
            max-width: 100%;
            margin: 0 auto;
        }

        .admin-content .box a {
            text-align: center;
        }

        .account-sidebar.login {
            position: relative;
            left: 120px;
            top: -100px;
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

        .admin-content .box a {
            text-align: right;
        }

        .account-sidebar.login {
            position: relative;
            left: -195px;
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
            box-shadow: none;
            /* Bỏ bóng trên mobile để giao diện nhẹ hơn */
        }

        .admin-content .box a {
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

        .account-sidebar.login {
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

    function togglePassword() {
        const input = document.getElementById("cust_password");
        const icon = document.querySelector(".toggle-password i");

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
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