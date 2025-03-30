<?php require_once('header.php'); ?>

<section class="content-header">
    <h1>Thông tin</h1>
</section>

<?php
$query = $pdo->prepare("SELECT * FROM table_top_category");
$query->execute();
$total_top_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_mid_category");
$query->execute();
$total_mid_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_end_category");
$query->execute();
$total_end_category = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_product");
$query->execute();
$total_product = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_status='1'");
$query->execute();
$total_customers = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_shipping_cost");
$query->execute();
$available_shipping = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$query->execute(array('Đã hoàn thành'));
$total_order_completed = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE shipping_status=?");
$query->execute(array('Đã hoàng thành'));
$total_shipping_completed = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$query->execute(array('Chưa xử lý'));
$total_order_pending = $query->rowCount();

$query = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=? AND shipping_status=?");
$query->execute(array('Đã hoàn thành', 'Chưa xử lý'));
$total_order_complete_shipping_pending = $query->rowCount();
?>

<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $total_product; ?></h3>

                    <p>Các sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-cart"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?php echo $total_order_pending; ?></h3>

                    <p>Đơn hàng chờ xử lý</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-clipboard"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $total_order_completed; ?></h3>

                    <p>Đơn hàng đã hoàn thành</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-checkbox-outline"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $total_shipping_completed; ?></h3>

                    <p>Hàng đã giao</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-checkmark-circled"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3><?php echo $total_order_complete_shipping_pending; ?></h3>

                    <p>Đơn hàng đang giao</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-load-a"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $total_customers; ?></h3>

                    <p>Khách hàng đang hoạt động</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-person-stalker"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
                <div class="inner">
                    <h3><?php echo $available_shipping; ?></h3>

                    <p>Đơn hàng đã thanh toán</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-location"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-olive">
                <div class="inner">
                    <h3><?php echo $total_top_category; ?></h3>

                    <p>Danh mục lớn</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-arrow-up-b"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3><?php echo $total_mid_category; ?></h3>

                    <p>Danh mục trung bình</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-android-menu"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
                <div class="inner">
                    <h3><?php echo $total_end_category; ?></h3>

                    <p>Danh mục nhỏ</p>
                </div>
                <div class="icon">
                    <i class="ionicons ion-arrow-down-b"></i>
                </div>

            </div>
        </div>

    </div>

</section>
<!-- Toast Container -->
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

<script>
function showToast(message, bg = "#333") {
    const toast = document.getElementById("toast");
    toast.innerText = message;
    toast.style.backgroundColor = bg;
    toast.classList.add("show");
    setTimeout(() => toast.classList.remove("show"), 4000);
}
</script>

<?php
if (isset($_SESSION['success_message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($_SESSION['success_message']) . ", '#2ecc71');
    });</script>";
    unset($_SESSION['success_message']);
}
?>