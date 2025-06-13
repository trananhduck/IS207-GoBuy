<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id']) || !isset($_REQUEST['task'])) {
    // Chuyển hướng đến trang đăng xuất nếu thiếu tham số id hoặc task
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_payment WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        // Nếu id không tồn tại, chuyển hướng đến trang đăng xuất
        header('location: logout.php');
        exit;
    }
}
?>

<?php
// Cập nhật trạng thái thanh toán trong cơ sở dữ liệu
$query = $pdo->prepare("UPDATE table_payment SET payment_status=? WHERE id=?");
$query->execute(array($_REQUEST['task'], $_REQUEST['id']));

// Chuyển hướng về trang quản lý đơn hàng
header('location: order.php');
?>