<?php require_once('header.php'); ?>

<section class="content-header">
    <h1>Bảng điều khiển</h1>
</section>

<?php
$querry = $pdo->prepare("SELECT * FROM table_top_category");
$querry->execute();
$total_top_category = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_mid_category");
$querry->execute();
$total_mid_category = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_end_category");
$querry->execute();
$total_end_category = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_product");
$querry->execute();
$total_product = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_customer WHERE cust_status='1'");
$querry->execute();
$total_customers = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_shipping_cost");
$querry->execute();
$available_shipping = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$querry->execute(array('Đã hoàn thành'));
$total_order_completed = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_payment WHERE shipping_status=?");
$querry->execute(array('Đã hoàng thành'));
$total_shipping_completed = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=?");
$querry->execute(array('Chưa xử lý'));
$total_order_pending = $querry->rowCount();

$querry = $pdo->prepare("SELECT * FROM table_payment WHERE payment_status=? AND shipping_status=?");
$querry->execute(array('Đã hoàn thành', 'Chưa xử lý'));
$total_order_complete_shipping_pending = $querry->rowCount();
?>