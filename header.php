<!-- File cấu hình chính -->
<?php
ob_start();
session_start();
include("admin/inc/config.php");
include("admin/inc/functions.php");
include("admin/inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();

$errorMsg = '';
$successMsg = '';
$errorMsg1 = '';
$successMsg1 = '';

$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $logo = $row['logo'];
    $favicon = $row['favicon'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $meta_title = $row['meta_title'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/uploads/<?php echo $favicon; ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/jquery.bxslider.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/rating.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/tree-menu.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <?php

    $query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $about_meta_title = $row['about_meta_title'];
        $faq_meta_title = $row['faq_meta_title'];
        $contact_meta_title = $row['contact_meta_title'];
        $pgallery_meta_title = $row['pgallery_meta_title'];
    }

    $current_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

    if ($current_page == 'index.php' || $current_page == 'login-customer.php' || $current_page == 'login-admin.php' || $current_page == 'registration-customer.php' || $current_page == 'registration-admin.php' || $current_page == 'cart.php' || $current_page == 'checkout.php' || $current_page == 'forget-password.php' || $current_page == 'reset-password.php' || $current_page == 'product-category.php' || $current_page == 'product.php') {
    ?>
    <title><?php echo $meta_title; ?></title>
    <?php
    }

    if ($current_page == 'about.php') {
    ?>
    <title><?php echo $about_meta_title; ?></title>
    <?php
    }
    if ($current_page == 'faq.php') {
    ?>

    <title><?php echo $faq_meta_title; ?></title>
    <?php
    }
    if ($current_page == 'contact.php') {
    ?>
    <title><?php echo $contact_meta_title; ?></title>
    <?php
    }
    if ($current_page == 'product.php') {
        $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
        $query->execute(array($_REQUEST['id']));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $og_photo = $row['p_featured_photo'];
            $og_title = $row['p_name'];
            $og_slug = 'product.php?id=' . $_REQUEST['id'];
            $og_description = substr(strip_tags($row['p_description']), 0, 200) . '...';
        }
    }

    if ($current_page == 'dashboard.php') {
    ?>
    <title>Dashboard - <?php echo $meta_title; ?></title>
    <?php
    }
    if ($current_page == 'customer-profile.php') {
    ?>
    <title>Cập nhật hồ sơ <?php echo $meta_title; ?></title>
    <?php
    }
    if ($current_page == 'customer-billing-shipping-update.php') {
    ?>
    <title>Cập nhật thông tin giao hàng <?php echo $meta_title; ?></title>
    <?php
    }
    if ($current_page == 'customer-password-update.php') {
    ?>
    <title>Cập nhật mật khẩu - <?php echo $meta_title; ?></title>
    <?php
    }
    if ($current_page == 'customer-order.php') {
    ?>
    <title>Hàng đã đặt - <?php echo $meta_title; ?></title>>
    <?php
    }
    ?>

    <?php if ($current_page == 'blog-single.php'): ?>
    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
    <?php endif; ?>

    <?php if ($current_page == 'product.php'): ?>
    <meta property="og:title" content="<?php echo $og_title; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo BASE_URL . $og_slug; ?>">
    <meta property="og:description" content="<?php echo $og_description; ?>">
    <meta property="og:image" content="assets/uploads/<?php echo $og_photo; ?>">
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>

<!-- Script API địa chỉ -->
<script>
// API URLs
const API_PROVINCES = 'https://provinces.open-api.vn/api/p/';
const API_DISTRICTS = 'https://provinces.open-api.vn/api/p/{province_code}?depth=2';
const API_WARDS = 'https://provinces.open-api.vn/api/d/{district_code}?depth=2';

// Khởi tạo dữ liệu địa chỉ
let provincesData = [];
let districtsData = {};
let wardsData = {};

// Hàm tải dữ liệu tỉnh/thành phố
function loadProvinces() {
    return fetch(API_PROVINCES)
        .then(response => response.json())
        .then(data => {
            provincesData = data;
            return data;
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu tỉnh/thành phố:', error);
            return [];
        });
}

// Hàm tải dữ liệu quận/huyện theo tỉnh
function loadDistricts(provinceCode) {
    const url = API_DISTRICTS.replace('{province_code}', provinceCode);

    // Kiểm tra xem đã tải dữ liệu cho tỉnh này chưa
    if (districtsData[provinceCode]) {
        return Promise.resolve(districtsData[provinceCode]);
    }

    return fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.districts) {
                districtsData[provinceCode] = data.districts;
                return data.districts;
            }
            return [];
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu quận/huyện:', error);
            return [];
        });
}

// Hàm tải dữ liệu xã/phường theo quận/huyện
function loadWards(districtCode) {
    const url = API_WARDS.replace('{district_code}', districtCode);

    // Kiểm tra xem đã tải dữ liệu cho quận/huyện này chưa
    if (wardsData[districtCode]) {
        return Promise.resolve(wardsData[districtCode]);
    }

    return fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data && data.wards) {
                wardsData[districtCode] = data.wards;
                return data.wards;
            }
            return [];
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu xã/phường:', error);
            return [];
        });
}

// Các hàm điền dữ liệu vào select
function populateProvinceSelect(selectElement) {
    // Xóa tất cả tùy chọn hiện tại (trừ option đầu tiên)
    selectElement.innerHTML = '<option value="">Chọn tỉnh/thành phố</option>';

    // Thêm các tùy chọn mới
    provincesData.forEach(province => {
        const option = document.createElement('option');
        option.value = province.code;
        option.textContent = province.name;
        selectElement.appendChild(option);
    });
}

function populateDistrictSelect(selectElement, provinceCode) {
    // Xóa tất cả tùy chọn hiện tại
    selectElement.innerHTML = '<option value="">Chọn quận/huyện</option>';

    // Kiểm tra xem đã có dữ liệu chưa
    if (!districtsData[provinceCode]) {
        return;
    }

    // Thêm các tùy chọn mới
    districtsData[provinceCode].forEach(district => {
        const option = document.createElement('option');
        option.value = district.code;
        option.textContent = district.name;
        selectElement.appendChild(option);
    });
}

function populateWardSelect(selectElement, districtCode) {
    // Xóa tất cả tùy chọn hiện tại
    selectElement.innerHTML = '<option value="">Chọn xã/phường</option>';

    // Kiểm tra xem đã có dữ liệu chưa
    if (!wardsData[districtCode]) {
        return;
    }

    // Thêm các tùy chọn mới
    wardsData[districtCode].forEach(ward => {
        const option = document.createElement('option');
        option.value = ward.code;
        option.textContent = ward.name;
        selectElement.appendChild(option);
    });
}

// Khởi tạo dữ liệu mặc định khi tải trang
document.addEventListener('DOMContentLoaded', function() {
    // Tải dữ liệu tỉnh/thành phố khi trang được tải
    loadProvinces().then(() => {
        // Kiểm tra xem có các phần tử select trên trang không
        const provinceSelect = document.getElementById('province-select');
        if (provinceSelect) {
            populateProvinceSelect(provinceSelect);
        }
    });
});

// Khởi tạo sự kiện cho form đăng ký
function initializeAddressSelects() {
    const provinceSelect = document.getElementById('province-select');
    const districtSelect = document.getElementById('district-select');
    const wardSelect = document.getElementById('ward-select');

    if (provinceSelect && districtSelect && wardSelect) {
        // Sự kiện thay đổi tỉnh/thành phố
        provinceSelect.addEventListener('change', function() {
            const provinceCode = this.value;
            const provinceName = this.options[this.selectedIndex].text;

            // Cập nhật trường input ẩn
            if (document.querySelector('input[name="cust_province"]')) {
                document.querySelector('input[name="cust_province"]').value = provinceName;
            }

            // Tải dữ liệu quận/huyện
            if (provinceCode) {
                loadDistricts(provinceCode).then(() => {
                    populateDistrictSelect(districtSelect, provinceCode);
                    // Reset dữ liệu xã/phường
                    wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
                    if (document.querySelector('input[name="cust_district"]')) {
                        document.querySelector('input[name="cust_district"]').value = '';
                    }
                    if (document.querySelector('input[name="cust_address"]')) {
                        document.querySelector('input[name="cust_address"]').value = '';
                    }
                });
            } else {
                districtSelect.innerHTML = '<option value="">Chọn quận/huyện</option>';
                wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
            }
        });

        // Sự kiện thay đổi quận/huyện
        districtSelect.addEventListener('change', function() {
            const districtCode = this.value;
            const districtName = this.options[this.selectedIndex].text;

            // Cập nhật trường input ẩn
            if (document.querySelector('input[name="cust_district"]')) {
                document.querySelector('input[name="cust_district"]').value = districtName;
            }

            // Tải dữ liệu xã/phường
            if (districtCode) {
                loadWards(districtCode).then(() => {
                    populateWardSelect(wardSelect, districtCode);
                    if (document.querySelector('input[name="cust_address"]')) {
                        document.querySelector('input[name="cust_address"]').value = '';
                    }
                });
            } else {
                wardSelect.innerHTML = '<option value="">Chọn xã/phường</option>';
            }
        });

        // Sự kiện thay đổi xã/phường
        wardSelect.addEventListener('change', function() {
            const wardName = this.options[this.selectedIndex].text;

            // Cập nhật trường input ẩn
            if (document.querySelector('input[name="cust_address"]')) {
                document.querySelector('input[name="cust_address"]').value = wardName;
            }
        });

        // Khởi tạo dữ liệu tỉnh/thành phố
        loadProvinces().then(() => {
            populateProvinceSelect(provinceSelect);
        });
    }
}

// Biến toàn cục để kiểm tra trang hiện tại
window.isRegistrationPage = false;

// Kiểm tra xem đang ở trang registration-customer.php không
if (window.location.href.includes('registration-customer.php')) {
    window.isRegistrationPage = true;
    document.addEventListener('DOMContentLoaded', function() {
        initializeAddressSelects();
    });
}
</script>

<body>



    <div class="header">
        <div class="container">
            <div class="row inner">
                <div class="col-md-4 logo">
                    <a href="index.php"><img src="assets/uploads/<?php echo $logo; ?>" alt="logo image"></a>
                </div>

                <div class="col-md-5 right">
                    <ul>
                        <?php
                        if (isset($_SESSION['customer'])) {
                        ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if (!empty($_SESSION['customer']['cust_photo'])): ?>
                                <img src="assets/uploads/<?php echo $_SESSION['customer']['cust_photo']; ?>"
                                    alt="Profile Photo" class="user-profile-image"
                                    style="width: 25px; height: 25px; border-radius: 50%; margin-right: 5px;">
                                <?php else: ?>
                                <i class="fa fa-user"></i>
                                <?php endif; ?>
                                <?php echo isset($_SESSION['customer']['cust_name']) ? $_SESSION['customer']['cust_name'] : 'Khách hàng'; ?>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="customer-profile.php"><i class="fa fa-user"></i> Hồ sơ cá nhân</a></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                            </ul>
                        </li>
                        <?php
                        } else {
                        ?>
                        <li><a href="login-customer.php"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                        <li><a href="registration-customer.php"><i class="fa fa-user-plus"></i> Đăng ký</a></li>
                        <?php
                        }
                        ?>

                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Giỏ hàng (
                                <?php
                                $table_total_price = 0;
                                if (isset($_SESSION['cart_p_qty']) && isset($_SESSION['cart_p_current_price'])) {
                                    foreach ($_SESSION['cart_p_qty'] as $index => $qty) {
                                        $price = isset($_SESSION['cart_p_current_price'][$index]) ? $_SESSION['cart_p_current_price'][$index] : 0;
                                        $table_total_price += $qty * $price;
                                    }
                                }

                                echo number_format($table_total_price, 2) . ' VND';
                                ?>)
                            </a></li>
                    </ul>
                </div>
                <div class="col-md-3 search-area">
                    <form class="navbar-form navbar-left" role="search" action="search-result.php" method="get"><?php $csrf->echoInputField();
                                                                                                                ?><div
                            class="form-group"><input type="text" class="form-control search-top"
                                placeholder="<?php echo 'Tìm kiếm sản phẩm' ?>" name="search_text"></div><button
                            type="submit" class="btn search-btn"><i class="fa fa-search"></i></button></form>
                </div>
            </div>
        </div>
    </div>

    <div class="nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 pl_0 pr_0">
                    <div class="menu-container">
                        <div class="menu">
                            <ul>
                                <li><a href="index.php">Trang chủ</a></li>

                                <?php
                                $query = $pdo->prepare("SELECT * FROM table_top_category WHERE show_on_menu=1");
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                <li><a
                                        href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
                                    <ul>
                                        <?php
                                            $query1 = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id=?");
                                            $query1->execute(array($row['tcat_id']));
                                            $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                            ?>
                                        <li><a
                                                href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>
                                            <ul>
                                                <?php
                                                        $query2 = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id=?");
                                                        $query2->execute(array($row1['mcat_id']));
                                                        $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($result2 as $row2) {
                                                        ?>
                                                <li><a
                                                        href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category"><?php echo $row2['ecat_name']; ?></a>
                                                </li>
                                                <?php
                                                        }
                                                        ?>
                                            </ul>
                                        </li>
                                        <?php
                                            }
                                            ?>
                                    </ul>
                                </li>
                                <?php
                                }
                                ?>

                                <?php
                                $query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $about_title = $row['about_title'];
                                    $faq_title = $row['faq_title'];
                                    $contact_title = $row['contact_title'];
                                    $pgallery_title = $row['pgallery_title'];
                                }
                                ?>
                                <li><a href="about.php"><?php echo $about_title; ?></a></li>
                                <li><a href="faq.php"><?php echo $faq_title; ?></a></li>
                                <li><a href="contact.php"><?php echo $contact_title; ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>