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
        // Lấy tên tỉnh/huyện/xã từ các field ẩn
        $provinceName = strip_tags($_POST['cust_s_province']);
        $districtName = strip_tags($_POST['cust_s_district']);
        $wardName = strip_tags($_POST['cust_s_ward']);
        $address = strip_tags($_POST['cust_s_address']);

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
            $provinceName,
            $districtName,
            $wardName,
            $address,
            $_SESSION['customer']['cust_id']
        ));

        $successMsg = 'Thông tin giao hàng được cập nhật thành công!!!';

        // Cập nhật thông tin vào session
        $_SESSION['customer']['cust_s_name'] = strip_tags($_POST['cust_s_name']);
        $_SESSION['customer']['cust_s_phone'] = strip_tags($_POST['cust_s_phone']);
        $_SESSION['customer']['cust_s_province'] = $provinceName;
        $_SESSION['customer']['cust_s_district'] = $districtName;
        $_SESSION['customer']['cust_s_ward'] = $wardName;
        $_SESSION['customer']['cust_s_address'] = $address;
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
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Tỉnh/Thành phố' ?> *</label>
                                <select name="province-select" id="province-select" class="form-control" required>
                                    <option value="">Chọn tỉnh/thành phố</option>
                                </select>
                                <input type="hidden" name="cust_s_province" id="cust_s_province"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_province']) ? $_SESSION['customer']['cust_s_province'] : ''; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Quận/Huyện' ?> *</label>
                                <select name="district-select" id="district-select" class="form-control" required>
                                    <option value="">Chọn quận/huyện</option>
                                </select>
                                <input type="hidden" name="cust_s_district" id="cust_s_district"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_district']) ? $_SESSION['customer']['cust_s_district'] : ''; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Xã/Phường' ?> *</label>
                                <select name="ward-select" id="ward-select" class="form-control" required>
                                    <option value="">Chọn xã/phường</option>
                                </select>
                                <input type="hidden" name="cust_s_ward" id="cust_s_ward"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_ward']) ? $_SESSION['customer']['cust_s_ward'] : ''; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""><?php echo 'Địa chỉ chi tiết' ?> *</label>
                                <input type="text" class="form-control" name="cust_s_address" id="cust_s_address"
                                    value="<?php echo isset($_SESSION['customer']['cust_s_address']) ? $_SESSION['customer']['cust_s_address'] : ''; ?>"
                                    placeholder="Số nhà, tên đường, tổ, khu phố,...">
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
    // Script khởi tạo cho trang cập nhật thông tin giao hàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo rằng API đã được khởi tạo trong header.php
        if (typeof initializeAddressSelects === 'function') {
            initializeAddressSelects();

            // Thiết lập các giá trị đã lưu
            setTimeout(function() {
                setupSavedAddressValues();
            }, 1000); // Đợi 1 giây để API load xong
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

        // Sự kiện thay đổi tỉnh/thành phố
        document.getElementById('province-select').addEventListener('change', function() {
            const provinceName = this.options[this.selectedIndex].text;
            document.getElementById('cust_s_province').value = provinceName;
        });

        // Sự kiện thay đổi quận/huyện
        document.getElementById('district-select').addEventListener('change', function() {
            const districtName = this.options[this.selectedIndex].text;
            document.getElementById('cust_s_district').value = districtName;
        });

        // Sự kiện thay đổi xã/phường
        document.getElementById('ward-select').addEventListener('change', function() {
            const wardName = this.options[this.selectedIndex].text;
            document.getElementById('cust_s_ward').value = wardName;
        });
    });

    // Hàm thiết lập các giá trị đã lưu
    function setupSavedAddressValues() {
        const savedProvince =
            "<?php echo isset($_SESSION['customer']['cust_s_province']) ? $_SESSION['customer']['cust_s_province'] : ''; ?>";
        const savedDistrict =
            "<?php echo isset($_SESSION['customer']['cust_s_district']) ? $_SESSION['customer']['cust_s_district'] : ''; ?>";
        const savedWard =
            "<?php echo isset($_SESSION['customer']['cust_s_ward']) ? $_SESSION['customer']['cust_s_ward'] : ''; ?>";

        if (savedProvince) {
            // Tìm tỉnh/thành phố đã lưu trong danh sách
            const provinceSelect = document.getElementById('province-select');
            for (let i = 0; i < provinceSelect.options.length; i++) {
                if (provinceSelect.options[i].text === savedProvince) {
                    provinceSelect.selectedIndex = i;
                    const event = new Event('change');
                    provinceSelect.dispatchEvent(event);

                    // Đợi load xong quận/huyện để thiết lập giá trị
                    setTimeout(function() {
                        const districtSelect = document.getElementById('district-select');
                        for (let j = 0; j < districtSelect.options.length; j++) {
                            if (districtSelect.options[j].text === savedDistrict) {
                                districtSelect.selectedIndex = j;
                                districtSelect.dispatchEvent(new Event('change'));

                                // Đợi load xong xã/phường để thiết lập giá trị
                                setTimeout(function() {
                                    const wardSelect = document.getElementById('ward-select');
                                    for (let k = 0; k < wardSelect.options.length; k++) {
                                        if (wardSelect.options[k].text === savedWard) {
                                            wardSelect.selectedIndex = k;
                                            wardSelect.dispatchEvent(new Event('change'));
                                            break;
                                        }
                                    }
                                }, 500);
                                break;
                            }
                        }
                    }, 500);
                    break;
                }
            }
        }
    }
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