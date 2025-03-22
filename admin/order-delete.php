<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    // Chuyển hướng đến trang đăng xuất nếu không có id
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_payment WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        // Nếu không tìm thấy, chuyển hướng đến trang đăng xuất
        header('location: logout.php');
        exit;
    } else {
        // Lấy thông tin thanh toán từ cơ sở dữ liệu
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $payment_id = $row['payment_id'];
            $payment_status = $row['payment_status'];
            $shipping_status = $row['shipping_status'];
        }
    }
}
?>

<?php

if (($payment_status == 'Completed') && ($shipping_status == 'Completed')):
// Không hoàn lại hàng vào kho nếu đơn hàng đã hoàn tất thanh toán và vận chuyển
else:
    // Hoàn lại hàng vào kho
    $query = $pdo->prepare("SELECT * FROM table_order WHERE payment_id=?");
    $query->execute(array($payment_id));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        // Lấy số lượng hiện có của sản phẩm
        $query1 = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
        $query1->execute(array($row['product_id']));
        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result1 as $row1) {
            $p_qty = $row1['p_qty'];
        }
        // Cập nhật số lượng sản phẩm sau khi hoàn hàng
        $final = $p_qty + $row['quantity'];
        $query1 = $pdo->prepare("UPDATE table_product SET p_qty=? WHERE p_id=?");
        $query1->execute(array($final, $row['product_id']));
    }
endif;

// Xóa đơn hàng khỏi bảng table_order
$query = $pdo->prepare("DELETE FROM table_order WHERE payment_id=?");
$query->execute(array($payment_id));

// Xóa thông tin thanh toán khỏi bảng table_payment
$query = $pdo->prepare("DELETE FROM table_payment WHERE id=?");
$query->execute(array($_REQUEST['id']));

// Chuyển hướng về trang quản lý đơn hàng
header('location: order.php');
?>