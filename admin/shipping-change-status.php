<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id']) || !isset($_REQUEST['task'])) {
    // Nếu không có tham số 'id' hoặc 'task', chuyển hướng về trang đăng xuất
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem 'id' có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_payment WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        // Nếu không tìm thấy 'id' trong cơ sở dữ liệu, chuyển hướng về trang đăng xuất
        header('location: logout.php');
        exit;
    }
}
?>

<?php
// Cập nhật trạng thái giao hàng trong bảng 'table_payment'
$query = $pdo->prepare("UPDATE table_payment SET shipping_status=? WHERE id=?");
$query->execute(array($_REQUEST['task'], $_REQUEST['id']));

// Sau khi cập nhật, chuyển hướng đến trang danh sách đơn hàng
header('location: order.php');
?>