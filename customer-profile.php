<?php require_once('header.php'); ?>

<?php
//Kiểm tra xem người dùng đăng nhập chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Kiểm tra nếu tài khoản bị vô hiệu hóa
    $query = $pdo->prepare("SELECT cust_status FROM table_customer WHERE cust_id=?");
    $query->execute(array($_SESSION['customer']['cust_id']));
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if ($result && $result['cust_status'] == 0) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}

// Xử lý cập nhật thông tin
if (isset($_POST['form1'])) {

    $valid = 1;
    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $errorMsg .= 'Họ tên không được để trống' . "<br>";
    }
    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $errorMsg .=  'Số điện thoại không được để trống'  . "<br>";
    }
    if (empty($_POST['cust_address'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ không được để trống' . "<br>";
    }
    if (empty($_POST['cust_province'])) {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn tỉnh/thành phố' . "<br>";
    }
    if (empty($_POST['cust_district'])) {
        $valid = 0;
        $errorMsg .= 'Quận/huyện không được để trống' . "<br>";
    }
    if ($valid == 1) {
        // Cập nhật dữ liệu vào database
        $query = $pdo->prepare("UPDATE table_customer SET cust_name=?, cust_phone=?, cust_province=?, cust_district=?, cust_address=? WHERE cust_id=?");
        $query->execute(array(
            strip_tags($_POST['cust_name']),
            strip_tags($_POST['cust_phone']),
            strip_tags($_POST['cust_province']),
            strip_tags($_POST['cust_district']),
            strip_tags($_POST['cust_address']),
            $_SESSION['customer']['cust_id']
        ));

        $successMsg = 'Hồ sơ cá nhân được cập nhật thành công!';

        // Cập nhật session
        $_SESSION['customer']['cust_name'] = $_POST['cust_name'];
        $_SESSION['customer']['cust_phone'] = $_POST['cust_phone'];
        $_SESSION['customer']['cust_province'] = $_POST['cust_province'];
        $_SESSION['customer']['cust_district'] = $_POST['cust_district'];
        $_SESSION['customer']['cust_address'] = $_POST['cust_address'];
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
                    <h3>
                        <?php echo 'Cập nhật thông tin cá nhân' ?>
                    </h3>
                    <?php
                    if (!empty($errorMsg)) {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'><ul><li>" . str_replace("<br>", "</li><li>", $errorMsg) . "</li></ul></div>";
                    }

                    if ($successMsg != '') {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Họ và tên' ?> *</label>
                                <input type="text" class="form-control" name="cust_name"
                                    value="<?php echo $_SESSION['customer']['cust_name']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                <input type="text" class="form-control" name=""
                                    value="<?php echo $_SESSION['customer']['cust_email']; ?>" disabled>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                <input type="text" class="form-control" name="cust_phone"
                                    value="<?php echo $_SESSION['customer']['cust_phone']; ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Tỉnh/thành phố' ?> *</label>
                                <select name="cust_province" class="form-control">
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['province_id']; ?>" <?php if ($row['province_id'] == $_SESSION['customer']['cust_province']) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                            <?php echo $row['province_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Quận/huyện' ?> *</label>
                                <input type="text" class="form-control" name="cust_district"
                                    value="<?php echo $_SESSION['customer']['cust_district']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Địa chỉ' ?> *</label>
                                <input type="text" class="form-control" name="cust_address"
                                    value="<?php echo $_SESSION['customer']['cust_address']; ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="<?php echo 'Cập nhật' ?>" name="form1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>