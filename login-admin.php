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

        $query = $pdo->prepare("SELECT * FROM table_user WHERE email=?");
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
                    $_SESSION['user'] = $row;
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
                <div class="user-content">
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
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
                <div class="user-sidebar">
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
.form-group.d-flex {
    position: relative;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.col-md-4 a{
    color: #007bff;
    font-size: 14px;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease, text-decoration 0.3s ease;
}
.col-md-4 a:hover {
    color:rgb(41, 14, 133); 
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
    color:rgb(41, 14, 133); 
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