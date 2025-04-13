<?php require_once('header.php'); ?>

<?php
// Khởi tạo các biến
$customer = array();
$errorMsg = '';
$successMsg = '';

// Kiểm tra xem người dùng đăng nhập chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Kiểm tra nếu tài khoản bị vô hiệu hóa
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=?");
    $query->execute(array($_SESSION['customer']['cust_id']));
    $customer = $query->fetch(PDO::FETCH_ASSOC);

    if (!$customer) {
        // Khởi tạo customer là một mảng trống nếu truy vấn thất bại
        $customer = array(
            'cust_name' => '',
            'cust_phone' => '',
            'cust_email' => '',
            'cust_gender' => '',
            'cust_birthyear' => '',
            'cust_photo' => '',
            'cust_status' => 1
        );
        $errorMsg = 'Không thể lấy thông tin người dùng. Vui lòng thử lại sau.';
    } else if ($customer['cust_status'] == 0) {
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
        $errorMsg .= 'Số điện thoại không được để trống' . "<br>";
    }

    // Xử lý upload ảnh đại diện
    $photoName = '';
    $photoExt = '';
    if (!empty($_FILES['cust_photo']['name'])) {
        $uploadPhoto = $_FILES['cust_photo']['name'];
        $photoTmp = $_FILES['cust_photo']['tmp_name'];

        // Kiểm tra định dạng file
        $allowedExts = array('jpg', 'jpeg', 'png', 'gif');
        $temp = explode('.', $uploadPhoto);
        $photoExt = strtolower(end($temp));

        if (!in_array($photoExt, $allowedExts)) {
            $valid = 0;
            $errorMsg .= 'Chỉ cho phép các định dạng: jpg, jpeg, png, gif' . "<br>";
        }

        // Kiểm tra kích thước file (giới hạn 5MB)
        if ($_FILES['cust_photo']['size'] > 5000000) {
            $valid = 0;
            $errorMsg .= 'Kích thước ảnh không được vượt quá 5MB' . "<br>";
        }
    }

    if ($valid == 1) {
        // Xử lý ảnh đại diện nếu có thay đổi
        if (!empty($_FILES['cust_photo']['name'])) {
            // Tạo tên file mới để tránh trùng lặp
            $photoName = pathinfo($_FILES['cust_photo']['name'], PATHINFO_FILENAME) . '.' . $photoExt;

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $uploadDir = 'assets/uploads/';
            if (!file_exists($uploadDir)) {
                // Create directory recursively
                mkdir($uploadDir, 0777, true);
            }

            // Xóa ảnh cũ nếu có
            if (
                isset($customer['cust_photo']) && !empty($customer['cust_photo']) &&
                file_exists('assets/uploads/' . $customer['cust_photo'])
            ) {
                unlink('assets/uploads/' . $customer['cust_photo']);
            }

            // Upload ảnh vào thư mục
            if (move_uploaded_file($photoTmp, $uploadDir . $photoName)) {
                // Cập nhật ảnh vào database
                $query = $pdo->prepare("UPDATE table_customer SET cust_photo=? WHERE cust_id=?");
                $result = $query->execute(array($photoName, $_SESSION['customer']['cust_id']));

                if ($result) {
                    // Cập nhật session và biến customer
                    $_SESSION['customer']['cust_photo'] = $photoName;
                    $customer['cust_photo'] = $photoName;
                } else {
                    $errorMsg .= 'Lỗi cập nhật ảnh đại diện trong cơ sở dữ liệu' . "<br>";
                }
            } else {
                $errorMsg .= 'Lỗi upload ảnh đại diện' . "<br>";
            }
        }

        // Cập nhật thông tin khác vào database nếu không có lỗi
        if (empty($errorMsg)) {
            $query = $pdo->prepare("UPDATE table_customer SET cust_name=?, cust_phone=?, cust_email=?, cust_gender=?, cust_birthyear=? WHERE cust_id=?");
            $result = $query->execute(array(
                strip_tags($_POST['cust_name']),
                strip_tags($_POST['cust_phone']),
                strip_tags($_POST['cust_email']),
                strip_tags($_POST['cust_gender']),
                strip_tags($_POST['cust_birthyear']),
                $_SESSION['customer']['cust_id']
            ));

            if ($result) {
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
            } else {
                $errorMsg .= 'Lỗi cập nhật thông tin cá nhân' . "<br>";
            }
        }
    }
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <!-- Sidebar chiếm 1/4 container (col-md-3) -->
            <div class="col-md-3">
                <?php require_once('customer-sidebar.php'); ?>
            </div>

            <!-- Phần nội dung chiếm 3/4 container (col-md-9) -->
            <div class="col-md-9">
                <div class="user-content">
                    <h3>Cập nhật thông tin cá nhân</h3>
                    <?php
                    if (!empty($errorMsg)) {
                        echo "<script>document.addEventListener('DOMContentLoaded', function() {
                            showToast(" . json_encode(strip_tags($errorMsg)) . ", '#e74c3c');
                        });</script>";
                    }

                    if (!empty($successMsg)) {
                        echo "<script>document.addEventListener('DOMContentLoaded', function() {
                            showToast(" . json_encode(strip_tags($successMsg)) . ", '#27ae60');
                        });</script>";
                    }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php $csrf->echoInputField(); ?>

                        <!-- Phần nội dung form được chia làm 2 cột chính -->
                        <div class="row">
                            <!-- Avatar chiếm 1/4 (tương đương 1/3 của col-md-9) -->
                            <div class="col-md-3">
                                <div class="avatar-container mb-3">
                                    <?php if (isset($customer['cust_photo']) && !empty($customer['cust_photo']) && file_exists('assets/uploads/' . $customer['cust_photo'])): ?>
                                        <img src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $customer['cust_photo']; ?>"
                                            alt="Avatar" class="profile-avatar">
                                    <?php else: ?>
                                        <img src="<?php echo BASE_URL; ?>assets/img/default-avatar.jpg" alt="Default Avatar"
                                            class="profile-avatar">
                                    <?php endif; ?>
                                </div>
                                <div class="text-center mb-4">
                                    <label for="cust_photo" class="btn btn-sm btn-primary">Cập nhật ảnh đại diện</label>
                                    <input type="file" id="cust_photo" name="cust_photo" style="display: none;"
                                        onchange="previewImage(this)">
                                    <p class="small text-muted mt-2">Định dạng: JPG, JPEG, PNG, GIF<br>Tối đa: 5MB</p>
                                </div>
                            </div>

                            <!-- Form thông tin cá nhân chiếm 1/2 (tương đương 2/3 của col-md-9) -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="">Họ và tên *</label>
                                        <input type="text" class="form-control" name="cust_name"
                                            value="<?php echo isset($customer['cust_name']) ? htmlspecialchars($customer['cust_name']) : ''; ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Giới tính *</label>
                                        <select class="form-control" name="cust_gender">
                                            <option value="">Chọn giới tính</option>
                                            <option value="Nam"
                                                <?php if (isset($customer['cust_gender']) && $customer['cust_gender'] == "Nam") echo "selected"; ?>>
                                                Nam
                                            </option>
                                            <option value="Nữ"
                                                <?php if (isset($customer['cust_gender']) && $customer['cust_gender'] == "Nữ") echo "selected"; ?>>
                                                Nữ</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="">Năm sinh *</label>
                                        <select class="form-control" name="cust_birthyear">
                                            <option value="">Chọn năm</option>
                                            <?php
                                            for ($year = 2024; $year >= 1950; $year--) {
                                                echo "<option value='$year'";
                                                if (isset($customer['cust_birthyear']) && $customer['cust_birthyear'] == $year) echo " selected";
                                                echo ">$year</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Địa chỉ email *</label>
                                        <input type="text" class="form-control" name="cust_email"
                                            value="<?php echo isset($customer['cust_email']) ? htmlspecialchars($customer['cust_email']) : ''; ?>">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="">Số điện thoại *</label>
                                        <input type="text" class="form-control" name="cust_phone"
                                            value="<?php echo isset($customer['cust_phone']) ? htmlspecialchars($customer['cust_phone']) : ''; ?>">
                                    </div>
                                    <div class="col-md-12 mt-3 btn-confirm">
                                        <input type="submit" class="btn btn-danger" value="Cập nhật" name="form1">
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
</style>
<!-- Thêm CSS cho ảnh đại diện responsive -->
<style>
    .avatar-container {
        width: 160px;
        height: 160px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f8f9fa;
        position: relative;
        margin-bottom: 20px;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    /* Responsive cho ảnh đại diện */
    @media (max-width: 992px) {
        .avatar-container {
            width: 140px;
            height: 140px;
        }
    }

    @media (max-width: 768px) {

        /* Ở chế độ tablet và điện thoại, layout sẽ thay đổi
       Ảnh đại diện và form nằm dọc ở giữa thay vì cạnh nhau */
        .avatar-container {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
        }
    }
</style>

<!-- Script xem trước ảnh đại diện -->
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var avatarContainer = input.closest('.col-md-3').querySelector('.avatar-container img');
                avatarContainer.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function showToast(message, bg = "#333") {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.style.backgroundColor = bg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 4000);
    }
</script>

<?php require_once('footer.php'); ?>