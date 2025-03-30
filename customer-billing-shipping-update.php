<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem khách hàng đã đăng nhập hay chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Nếu khách hàng đã đăng nhập nhưng bị quản trị viên vô hiệu hóa, thì buộc đăng xuất người dùng này.
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=? AND cust_status=?");
    $query->execute(array($_SESSION['customer']['cust_id'], 0));
    $total = $query->rowCount();
    if ($total) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}
?>

<?php
if (isset($_POST['form1'])) {

    // Cập nhật dữ liệu vào cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_customer SET  
                            cust_s_name=?, 
                            cust_s_phone=?, 
                            cust_s_province=?, 
                            cust_s_district=?, 
                            cust_s_address=?
                            WHERE cust_id=?");
    $query->execute(array(
        strip_tags($_POST['cust_s_name']),
        strip_tags($_POST['cust_s_phone']),
        strip_tags($_POST['cust_s_province']),
        strip_tags($_POST['cust_s_district']),
        strip_tags($_POST['cust_s_address']),
        $_SESSION['customer']['cust_id']
    ));

    $successMsg = 'Thông tin giao hàng được cập nhật thành công!!!';

    $_SESSION['customer']['cust_s_name'] = strip_tags($_POST['cust_s_name']);
    $_SESSION['customer']['cust_s_phone'] = strip_tags($_POST['cust_s_phone']);
    $_SESSION['customer']['cust_s_province'] = strip_tags($_POST['cust_s_province']);
    $_SESSION['customer']['cust_s_district'] = strip_tags($_POST['cust_s_district']);
    $_SESSION['customer']['cust_s_address'] = strip_tags($_POST['cust_s_address']);
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-12">
                <div class="user-content">
                    <?php
                    if ($errorMsg != '') {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                    }
                    if ($successMsg != '') {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <!-- Căn giữa -->
                                        <h3 class="text-center"><?php echo 'Cập nhật thông tin giao hàng' ?></h3>

                                        <div class="form-group">
                                            <label class="text-left"><?php echo 'Họ tên' ?></label>
                                            <input type="text" class="form-control" name="cust_s_name"
                                                value="<?php echo $_SESSION['customer']['cust_s_name']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="text-left"><?php echo 'Số điện thoại' ?></label>
                                            <input type="text" class="form-control" name="cust_s_phone"
                                                value="<?php echo $_SESSION['customer']['cust_s_phone']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="text-left"><?php echo 'Tỉnh/thành phố' ?></label>
                                            <select name="cust_s_province" class="form-control">
                                                <?php
                                                $query = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                                $query->execute();
                                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($result as $row) {
                                                ?>
                                                    <option value="<?php echo $row['province_id']; ?>" <?php if ($row['province_id'] == $_SESSION['customer']['cust_s_province']) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>
                                                        <?php echo $row['province_name']; ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-left"><?php echo 'Quận/huyện' ?></label>
                                            <input type="text" class="form-control" name="cust_s_district"
                                                value="<?php echo $_SESSION['customer']['cust_s_district']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label class="text-left"><?php echo 'Địa chỉ' ?></label>
                                            <input type="text" class="form-control" name="cust_s_address"
                                                value="<?php echo $_SESSION['customer']['cust_s_address']; ?>">
                                        </div>
                                        <div class="form-group text-right">
                                            <input type="submit" class="btn btn-primary"
                                                value="<?php echo 'Cập nhật' ?>" name="form1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>