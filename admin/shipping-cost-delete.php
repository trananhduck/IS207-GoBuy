<?php require_once('header.php'); ?>
<?php
if (!isset($_REQUEST['id'])) {
    header('location: shipping-cost.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE shipping_cost_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();

    if ($total == 0) {
        header('location: shipping-cost.php');
        exit;
    } else {
        // Tiến hành xóa chi phí vận chuyển
        $query = $pdo->prepare("DELETE FROM table_shipping_cost WHERE shipping_cost_id=?");
        $query->execute(array($_REQUEST['id']));

        // Chuyển hướng về trang danh sách sau khi xóa
        header('location: shipping-cost.php?message=deleted');
        exit;
    }
}
