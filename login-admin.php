<?php require_once('header.php'); ?>
<?php
$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_login = $row['banner_login'];
}
?>
<!-- login form -->
<?php
if (isset($_POST['form1'])) {

    if (empty($_POST['admin_email']) || empty($_POST['admin_password'])) {
        $errorMsg = 'Email và mật khẩu không thể để trống' . '<br>';
    } else {

        $admin_email = strip_tags($_POST['admin_email']);
        $admin_password = strip_tags($_POST['admin_password']);

        $querry = $pdo->prepare("SELECT * FROM table_admin WHERE admin_email=?");
        $querry->execute(array($admin_email));
        $total = $querry->rowCount();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $admin_status = $row['admin_status'];
            $row_password = $row['admin_password'];
        }

        if ($total == 0) {
            $errorMsg .= 'Địa chỉ email không khớp.' . '<br>';
        } else {
            //using MD5 form
            if ($row_password != md5($admin_password)) {
                $errorMsg .= 'Mật khẩu không khớp' . '<br>';
            } else {
                if ($admin_status == 0) {
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
                                    <input type="email" class="form-control" name="admin_email">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="admin_password">
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-success" value="<?php echo 'Submit' ?>"
                                        name="form1">
                                </div>
                                <a href="forget-password.php" style="color:#e4144d;"><?php echo 'Quên mật khẩu' ?>?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>