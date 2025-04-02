<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem người dùng đăng nhập chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Kiểm tra nếu tài khoản bị vô hiệu hóa
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=?");
    $query->execute(array($_SESSION['customer']['cust_id']));
    $customer = $query->fetch(PDO::FETCH_ASSOC);

    if ($customer && $customer['cust_status'] == 0) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}

// Xử lý cập nhật thông tin
if (isset($_POST['form1'])) {
    $valid = 1;
    $errorMsg = '';

    if (empty($_POST['cust_name'])) {
        $valid = 0;
        $errorMsg .= 'Họ tên không được để trống' . "<br>";
    }
    if (empty($_POST['cust_phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống' . "<br>";
    }

    if ($valid == 1) {
        // Cập nhật dữ liệu vào database
        $query = $pdo->prepare("UPDATE table_customer SET cust_name=?, cust_phone=?, cust_email=?, cust_gender=?, cust_birthyear=? WHERE cust_id=?");
        $query->execute(array(
            strip_tags($_POST['cust_name']),
            strip_tags($_POST['cust_phone']),
            strip_tags($_POST['cust_email']),
            strip_tags($_POST['cust_gender']),
            strip_tags($_POST['cust_birthyear']),
            $_SESSION['customer']['cust_id']
        ));

        $successMsg = 'Hồ sơ cá nhân được cập nhật thành công!';

        // Cập nhật session
        $_SESSION['customer']['cust_name'] = $_POST['cust_name'];
        $_SESSION['customer']['cust_phone'] = $_POST['cust_phone'];
        $_SESSION['customer']['cust_email'] = $_POST['cust_email'];
        $_SESSION['customer']['cust_gender'] = $_POST['cust_gender'];
        $_SESSION['customer']['cust_birthyear'] = $_POST['cust_birthyear'];
        
        // Cập nhật lại biến $customer
        $customer['cust_name'] = $_POST['cust_name'];
        $customer['cust_phone'] = $_POST['cust_phone'];
        $customer['cust_email'] = $_POST['cust_email'];
        $customer['cust_gender'] = $_POST['cust_gender'];
        $customer['cust_birthyear'] = $_POST['cust_birthyear'];
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
                    <h3>Cập nhật thông tin cá nhân</h3>
                    <?php
                    if (!empty($errorMsg)) {
                        echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'><ul><li>" . str_replace("<br>", "</li><li>", $errorMsg) . "</li></ul></div>";
                    }

                    if (!empty($successMsg)) {
                        echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                    }
                    ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Họ và tên *</label>
                                <input type="text" class="form-control" name="cust_name"
                                    value="<?php echo htmlspecialchars($customer['cust_name']); ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Giới tính *</label>
                                <select class="form-control" name="cust_gender">
                                    <option value="">Chọn giới tính</option>
                                    <option value="Nam"
                                        <?php if ($customer['cust_gender'] == "Nam") echo "selected"; ?>>Nam</option>
                                    <option value="Nữ" <?php if ($customer['cust_gender'] == "Nữ") echo "selected"; ?>>
                                        Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Năm sinh *</label>
                                <select class="form-control" name="cust_birthyear">
                                    <option value="">Chọn năm</option>
                                    <?php
                                        for ($year = 2024; $year >= 1950; $year--) {
                                            echo "<option value='$year'";
                                            if ($customer['cust_birthyear'] == $year) echo " selected";
                                            echo ">$year</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Địa chỉ email *</label>
                                <input type="text" class="form-control" name="cust_email"
                                    value="<?php echo htmlspecialchars($customer['cust_email']); ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Số điện thoại *</label>
                                <input type="text" class="form-control" name="cust_phone"
                                    value="<?php echo htmlspecialchars($customer['cust_phone']); ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cập nhật" name="form1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>