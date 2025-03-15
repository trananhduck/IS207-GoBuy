<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem tham số 'id' có được truyền vào không
if (!isset($_REQUEST['id'])) {
    // Nếu không có 'id', chuyển hướng về trang đăng xuất
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ hay không
    $querry = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();

    if ($total == 0) {
        // Nếu không tìm thấy khách hàng, chuyển hướng về trang đăng xuất
        header('location: logout.php');
        exit;
    }
}
?>

<?php
// Xóa khách hàng khỏi bảng table_customer
$querry = $pdo->prepare("DELETE FROM table_customer WHERE cust_id=?");
$querry->execute(array($_REQUEST['id']));

// Xóa đánh giá của khách hàng khỏi bảng table_rating
$querry = $pdo->prepare("DELETE FROM table_rating WHERE cust_id=?");
$querry->execute(array($_REQUEST['id']));

// Chuyển hướng về trang danh sách khách hàng sau khi xóa
header('location: customer.php');
?>