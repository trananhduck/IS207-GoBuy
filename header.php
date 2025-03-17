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

$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $logo = $row['logo'];
    $favicon = $row['favicon'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $meta_title_home = $row['meta_title_home'];
    $meta_keyword_home = $row['meta_keyword_home'];
    $meta_description_home = $row['meta_description_home'];
    $before_head = $row['before_head'];
    $after_body = $row['after_body'];
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
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/bootstrap-touch-slider.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <?php

    $querry = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
    $querry->execute();
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $about_meta_title = $row['about_meta_title'];
        $about_meta_keyword = $row['about_meta_keyword'];
        $about_meta_description = $row['about_meta_description'];
        $faq_meta_title = $row['faq_meta_title'];
        $faq_meta_keyword = $row['faq_meta_keyword'];
        $faq_meta_description = $row['faq_meta_description'];
        $blog_meta_title = $row['blog_meta_title'];
        $blog_meta_keyword = $row['blog_meta_keyword'];
        $blog_meta_description = $row['blog_meta_description'];
        $contact_meta_title = $row['contact_meta_title'];
        $contact_meta_keyword = $row['contact_meta_keyword'];
        $contact_meta_description = $row['contact_meta_description'];
        $pgallery_meta_title = $row['pgallery_meta_title'];
        $pgallery_meta_keyword = $row['pgallery_meta_keyword'];
        $pgallery_meta_description = $row['pgallery_meta_description'];
        $vgallery_meta_title = $row['vgallery_meta_title'];
        $vgallery_meta_keyword = $row['vgallery_meta_keyword'];
        $vgallery_meta_description = $row['vgallery_meta_description'];
    }

    $current_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

    if ($current_page == 'index.php' || $current_page == 'login.php' || $current_page == 'registration.php' || $current_page == 'cart.php' || $current_page == 'checkout.php' || $current_page == 'forget-password.php' || $current_page == 'reset-password.php' || $current_page == 'product-category.php' || $current_page == 'product.php') {
    ?>
    <title><?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
    <?php
    }

    if ($current_page == 'about.php') {
    ?>
    <title><?php echo $about_meta_title; ?></title>
    <meta name="keywords" content="<?php echo $about_meta_keyword; ?>">
    <meta name="description" content="<?php echo $about_meta_description; ?>">
    <?php
    }
    if ($current_page == 'faq.php') {
    ?>
    <title><?php echo $faq_meta_title; ?></title>
    <meta name="keywords" content="<?php echo $faq_meta_keyword; ?>">
    <meta name="description" content="<?php echo $faq_meta_description; ?>">
    <?php
    }
    if ($current_page == 'contact.php') {
    ?>
    <title><?php echo $contact_meta_title; ?></title>
    <meta name="keywords" content="<?php echo $contact_meta_keyword; ?>">
    <meta name="description" content="<?php echo $contact_meta_description; ?>">
    <?php
    }
    if ($current_page == 'product.php') {
        $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
        $querry->execute(array($_REQUEST['id']));
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $og_photo = $row['p_featured_photo'];
            $og_title = $row['p_name'];
            $og_slug = 'product.php?id=' . $_REQUEST['id'];
            $og_description = substr(strip_tags($row['p_description']), 0, 200) . '...';
        }
    }

    if ($current_page == 'dashboard.php') {
    ?>
    <title>Dashboard - <?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
    <?php
    }
    if ($current_page == 'customer-profile.php') {
    ?>
    <title>Cập nhật hồ sơ <?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
    <?php
    }
    if ($current_page == 'customer-billing-shipping-update.php') {
    ?>
    <title>Cập nhật thông tin giao hàng <?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
    <?php
    }
    if ($current_page == 'customer-password-update.php') {
    ?>
    <title>Cập nhật mật khẩu - <?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
    <?php
    }
    if ($current_page == 'customer-order.php') {
    ?>
    <title>Hàng đã đặt - <?php echo $meta_title_home; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
    <meta name="description" content="<?php echo $meta_description_home; ?>">
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
    <?php echo $before_head; ?>
</head>

<body>

    <?php echo $after_body; ?>

    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="left">
                        <ul>
                            <li><i class="fa fa-phone"></i> <?php echo $contact_phone; ?></li>
                            <li><i class="fa fa-envelope-o"></i> <?php echo $contact_email; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="right">
                        <ul>
                            <?php
                            $querry = $pdo->prepare("SELECT * FROM table_social");
                            $querry->execute();
                            $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                            ?>
                            <?php if ($row['social_url'] != ''): ?>
                            <li><a href="<?php echo $row['social_url']; ?>"><i
                                        class="<?php echo $row['social_icon']; ?>"></i></a></li>
                            <?php endif; ?>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                        <li><i class="fa fa-user"></i>
                            <a href="customer-profile.php"><?php echo $_SESSION['customer']['cust_name']; ?>
                        </li>
                        <li><a href="logout.php"><i class="fa fa-home"></i> <?php echo 'Đăng xuất' ?></a></li>
                        <?php
                        } else {
                        ?>
                        <li><a href="login.php"><i class="fa fa-sign-in"></i> <?php echo 'Đăng nhập' ?></a></li>
                        <li><a href="registration.php"><i class="fa fa-user-plus"></i> <?php echo 'Đăng ký' ?></a>
                        </li>
                        <?php
                        }
                        ?>

                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> <?php echo 'Giỏ hàng' ?>
                                (<?php
                                    $arr_cart_p_id = [];

                                    if (isset($_SESSION['cart_p_id'])) {
                                        $table_total_price = 0;
                                        $arr_cart_p_qty = []; // Khởi tạo mảng
                                        $arr_cart_p_current_price = []; // Khởi tạo mảng
                                        $i = 0;

                                        foreach ($_SESSION['cart_p_qty'] as $key => $value) {
                                            $arr_cart_p_qty[$i] = $value;
                                            $i++;
                                        }

                                        $i = 0;
                                        foreach ($_SESSION['cart_p_current_price'] as $key => $value) {
                                            $arr_cart_p_current_price[$i] = $value;
                                            $i++;
                                        }

                                        for ($i = 0; $i < count($arr_cart_p_qty); $i++) {
                                            $row_total_price = $arr_cart_p_current_price[$i] * $arr_cart_p_qty[$i];
                                            $table_total_price += $row_total_price;
                                        }

                                        echo $table_total_price;
                                    } else {
                                        echo '0.00';
                                    }

                                    ?><?php echo ' VND' ?>)</a></li>
                    </ul>
                </div>
                <div class="col-md-3 search-area">
                    <form class="navbar-form navbar-left" role="search" action="search-result.php" method="get">
                        <?php $csrf->echoInputField(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control search-top"
                                placeholder="<?php echo 'Tìm kiếm sản phẩm' ?>" name="search_text">
                        </div>
                        <button type="submit" class="btn btn-danger"><?php echo 'Tìm kiếm' ?></button>
                    </form>
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
                                $querry = $pdo->prepare("SELECT * FROM table_top_category WHERE show_on_menu=1");
                                $querry->execute();
                                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                <li><a
                                        href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category"><?php echo $row['tcat_name']; ?></a>
                                    <ul>
                                        <?php
                                            $querry1 = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id=?");
                                            $querry1->execute(array($row['tcat_id']));
                                            $result1 = $querry1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                            ?>
                                        <li><a
                                                href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category"><?php echo $row1['mcat_name']; ?></a>
                                            <ul>
                                                <?php
                                                        $querry2 = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id=?");
                                                        $querry2->execute(array($row1['mcat_id']));
                                                        $result2 = $querry2->fetchAll(PDO::FETCH_ASSOC);
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
                                $querry = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
                                $querry->execute();
                                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $about_title = $row['about_title'];
                                    $faq_title = $row['faq_title'];
                                    $blog_title = $row['blog_title'];
                                    $contact_title = $row['contact_title'];
                                    $pgallery_title = $row['pgallery_title'];
                                    $vgallery_title = $row['vgallery_title'];
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