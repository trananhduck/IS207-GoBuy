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
$errorMsg = '';
$successMsg = '';

if (isset($_POST['form1'])) {
    $valid = 1;

    // Xác thực dữ liệu
    if (empty($_POST['cust_s_name'])) {
        $valid = 0;
        $errorMsg .= 'Họ tên không được để trống<br>';
    }

    if (empty($_POST['cust_s_phone'])) {
        $valid = 0;
        $errorMsg .= 'Số điện thoại không được để trống<br>';
    }

    if (empty($_POST['cust_s_province'])) {
        $valid = 0;
        $errorMsg .= 'Vui lòng chọn tỉnh/thành phố<br>';
    }

    if (empty($_POST['cust_s_district'])) {
        $valid = 0;
        $errorMsg .= 'Quận/huyện không được để trống<br>';
    }

    if (empty($_POST['cust_s_ward'])) {
        $valid = 0;
        $errorMsg .= 'Xã/phường không được để trống<br>';
    }

    if (empty($_POST['cust_s_address'])) {
        $valid = 0;
        $errorMsg .= 'Địa chỉ không được để trống<br>';
    }

    if ($valid == 1) {
        // Cập nhật dữ liệu vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_customer SET  
                                cust_s_name=?, 
                                cust_s_phone=?, 
                                cust_s_province=?, 
                                cust_s_district=?,
                                cust_s_ward=?,
                                cust_s_address=?
                                WHERE cust_id=?");
        $query->execute(array(
            strip_tags($_POST['cust_s_name']),
            strip_tags($_POST['cust_s_phone']),
            strip_tags($_POST['cust_s_province']),
            strip_tags($_POST['cust_s_district']),
            strip_tags($_POST['cust_s_ward']),
            strip_tags($_POST['cust_s_address']),
            $_SESSION['customer']['cust_id']
        ));

        $successMsg = 'Thông tin giao hàng được cập nhật thành công!!!';

        // Cập nhật thông tin vào session
        $_SESSION['customer']['cust_s_name'] = strip_tags($_POST['cust_s_name']);
        $_SESSION['customer']['cust_s_phone'] = strip_tags($_POST['cust_s_phone']);
        $_SESSION['customer']['cust_s_province'] = strip_tags($_POST['cust_s_province']);
        $_SESSION['customer']['cust_s_district'] = strip_tags($_POST['cust_s_district']);
        $_SESSION['customer']['cust_s_ward'] = strip_tags($_POST['cust_s_ward']);
        $_SESSION['customer']['cust_s_address'] = strip_tags($_POST['cust_s_address']);
    }
    error_log('Form submitted. Updated data successfully.');
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
                        <?php echo 'Cập nhật thông tin giao hàng' ?>
                    </h3>
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
                                <label for=""><?php echo 'Họ tên' ?> *</label>
                                <input type="text" class="form-control" name="cust_s_name" id="cust_s_name"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_name']) ? $_SESSION['customer']['cust_s_name'] : ''; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                <input type="text" class="form-control" name="cust_s_phone" id="cust_s_phone"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_phone']) ? $_SESSION['customer']['cust_s_phone'] : ''; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Tỉnh/thành phố' ?> *</label>
                                <select name="cust_s_province" class="form-control select-province"
                                    id="province-select">
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['province_id']; ?>" <?php if (isset($_SESSION['customer']['cust_s_province']) && $row['province_id'] == $_SESSION['customer']['cust_s_province']) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                            <?php echo $row['province_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Quận/huyện' ?> *</label>
                                <select name="cust_s_district" class="form-control select-district"
                                    id="district-select">
                                    <option value="">Chọn quận/huyện</option>
                                    <?php
                                    if (isset($_SESSION['customer']['cust_s_province']) && !empty($_SESSION['customer']['cust_s_province'])) {
                                        $query = $pdo->prepare("SELECT * FROM table_district WHERE province_id = ? ORDER BY district_name ASC");
                                        $query->execute(array($_SESSION['customer']['cust_s_province']));
                                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                    ?>
                                            <option value="<?php echo $row['district_id']; ?>" <?php if (isset($_SESSION['customer']['cust_s_district']) && $row['district_id'] == $_SESSION['customer']['cust_s_district']) {
                                                                                                    echo 'selected';
                                                                                                } ?>>
                                                <?php echo $row['district_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Xã/phường' ?> *</label>
                                <select name="cust_s_ward" class="form-control select-ward" id="ward-select">
                                    <option value="">Chọn xã/phường</option>
                                    <?php
                                    if (isset($_SESSION['customer']['cust_s_district']) && !empty($_SESSION['customer']['cust_s_district'])) {
                                        $query = $pdo->prepare("SELECT * FROM table_ward WHERE district_id = ? ORDER BY ward_name ASC");
                                        $query->execute(array($_SESSION['customer']['cust_s_district']));
                                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                    ?>
                                            <option value="<?php echo $row['ward_id']; ?>" <?php if (isset($_SESSION['customer']['cust_s_ward']) && $row['ward_id'] == $_SESSION['customer']['cust_s_ward']) {
                                                                                                echo 'selected';
                                                                                            } ?>>
                                                <?php echo $row['ward_name']; ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Địa chỉ' ?> *</label>
                                <input type="text" class="form-control" name="cust_s_address" id="cust_s_address"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_address']) ? $_SESSION['customer']['cust_s_address'] : ''; ?>">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="<?php echo 'Cập nhật' ?>" name="form1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Script khởi tạo cho trang đăng ký
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo rằng API đã được khởi tạo trong header.php
        if (typeof initializeAddressSelects === 'function') {
            initializeAddressSelects();
        } else {
            console.error('API địa chỉ chưa được khởi tạo đúng cách.');
        }

        // Xử lý lỗi khi submit form
        <?php if ($errorMsg != ''): ?>
            // Phục hồi dữ liệu đã chọn nếu có lỗi form
            setTimeout(function() {
                const provinceValue =
                    "<?php echo isset($_POST['cust_s_province']) ? $_POST['cust_s_province'] : ''; ?>";
                const districtValue =
                    "<?php echo isset($_POST['cust_s_district']) ? $_POST['cust_s_district'] : ''; ?>";
                const wardValue =
                    "<?php echo isset($_POST['cust_s_ward']) ? $_POST['cust_s_ward'] : ''; ?>";
                const addressValue =
                    "<?php echo isset($_POST['cust_s_address']) ? $_POST['cust_s_address'] : ''; ?>";
                // Hiển thị lỗi trong select
                if (provinceValue === '') {
                    document.getElementById('province-select').classList.add('error-field');
                }
                if (districtValue === '') {
                    document.getElementById('district-select').classList.add('error-field');
                }
                if (wardValue === '') {
                    document.getElementById('ward-select').classList.add('error-field');
                }
                if (addressValue === '') {
                    document.getElementById('cust_s_address').classList.add('error-field');
                }
            }, 500);
        <?php endif; ?>
    });
</script>
<style>
    /* Thêm style cho select và input khi có lỗi */
    .error-field {
        border: 1px solid #f00 !important;
    }

    .form-group {
        margin-bottom: 15px;
    }
</style>
<?php require_once('footer.php'); ?>