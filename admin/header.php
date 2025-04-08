<?php
ob_start();
session_start();
include("inc/config.php");
include("inc/functions.php");
include("inc/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$errorMsg = '';
$successMsg = '';
$errorMsg1 = '';
$successMsg1 = '';

// Kiểm tra admin có đag hoạt động không
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel</title>
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, admin-scalable=no" name="viewport">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/datepicker3.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/select2.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="stylesheet" href="css/on-off-switch.css" />
    <link rel="stylesheet" href="css/summernote.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>

<body class="hold-transition fixed skin-blue sidebar-mini">

    <div class="wrapper">

        <header class="main-header">

            <a href="index.php" class="logo">
                <span class="logo-lg">GoBuy</span>
            </a>

            <nav class="navbar navbar-static-top">

                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Admin
                    Panel</span>
                <!-- Top Bar ... admin Inforamtion .. Login/Log out -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown admin admin-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../assets/uploads/<?php echo $_SESSION['admin']['photo']; ?>"
                                    class="admin-image" alt="admin Image">
                                <span class="hidden-xs"><?php echo $_SESSION['admin']['full_name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="admin-footer">
                                    <div>
                                        <a href="profile-edit.php" class="btn btn-default btn-flat"><i class="fa fa-user"></i>Sửa hồ sơ</a>
                                    </div>
                                    <div>
                                        <a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i>Đăng xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>

        <?php $current_page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1); ?>
        <!-- Side Bar quản lý hoạt động -->
        <aside class="main-sidebar">
            <section class="sidebar">

                <ul class="sidebar-menu">

                    <li class="treeview <?php if ($current_page == 'index.php') {
                                            echo 'active';
                                        } ?>">
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i> <span>Bảng điều khiển</span>
                        </a>
                    </li>
                    <li class="treeview <?php if (($current_page == 'size.php') || ($current_page == 'size-add.php') || ($current_page == 'size-edit.php') || ($current_page == 'color.php') || ($current_page == 'color-add.php') || ($current_page == 'color-edit.php')  || ($current_page == 'shipping-cost.php') || ($current_page == 'shipping-cost-edit.php') || ($current_page == 'top-category.php') || ($current_page == 'top-category-add.php') || ($current_page == 'top-category-edit.php') || ($current_page == 'mid-category.php') || ($current_page == 'mid-category-add.php') || ($current_page == 'mid-category-edit.php') || ($current_page == 'end-category.php') || ($current_page == 'end-category-add.php') || ($current_page == 'end-category-edit.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="#">
                            <i class="fa fa-cogs"></i>
                            <span>Cài đặt shop</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="size.php"><i class="fa fa-circle-o"></i> Kích thước</a></li>
                            <li><a href="color.php"><i class="fa fa-circle-o"></i> Màu sắc</a></li>
                            <li><a href="shipping-cost.php"><i class="fa fa-circle-o"></i> Phí vận chuyển</a></li>
                            <li><a href="top-category.php"><i class="fa fa-circle-o"></i> Danh mục lớn</a></li>
                            <li><a href="mid-category.php"><i class="fa fa-circle-o"></i> Danh mục trung bình</a></li>
                            <li><a href="end-category.php"><i class="fa fa-circle-o"></i> Danh mục con</a></li>
                        </ul>
                    </li>
                    <li class="treeview <?php if (($current_page == 'product.php') || ($current_page == 'product-add.php') || ($current_page == 'product-edit.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="product.php">
                            <i class="fa fa-shopping-bag"></i> <span>Quản lý sản phẩm</span>
                        </a>
                    </li>

                    <li class="treeview <?php if (($current_page == 'order.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="order.php">
                            <i class="fa fa-sticky-note"></i> <span>Quản lý đơn hàng</span>
                        </a>
                    </li>
                    <li class="treeview <?php if (($current_page == 'service.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="service.php">
                            <i class="fa fa-list-ol"></i> <span>Dịch vụ</span>
                        </a>
                    </li>
                    <li class="treeview <?php if (($current_page == 'customer.php') || ($current_page == 'customer-add.php') || ($current_page == 'customer-edit.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="customer.php">
                            <i class="fa fa-user-plus"></i> <span>Khách hàng đã đăng ký</span>
                        </a>
                    </li>
                    <li class="treeview <?php if (($current_page == 'settings.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="settings.php">
                            <i class="fa fa-sliders"></i> <span>Cài đặt website</span>
                        </a>
                    </li>

                    <li class="treeview <?php if (($current_page == 'slider.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="slider.php">
                            <i class="fa fa-picture-o"></i> <span>Quản lý sliders</span>
                        </a>
                    </li>



                    <li class="treeview <?php if (($current_page == 'faq.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="faq.php">
                            <i class="fa fa-question-circle"></i> <span>FAQs</span>
                        </a>
                    </li>



                    <li class="treeview <?php if (($current_page == 'page.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="page.php">
                            <i class="fa fa-tasks"></i> <span>Cài đặt các trang</span>
                        </a>
                    </li>

                    <li class="treeview <?php if (($current_page == 'social-media.php')) {
                                            echo 'active';
                                        } ?>">
                        <a href="social-media.php">
                            <i class="fa fa-globe"></i> <span>Mạng xã hội</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
</body>