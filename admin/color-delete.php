<?php require_once('header.php'); ?>

<?php
// Ngăn chặn truy cập trực tiếp vào trang này.
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_color WHERE color_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Xóa khỏi bảng table_color
$query = $pdo->prepare("DELETE FROM table_color WHERE color_id=?");
$query->execute(array($_REQUEST['id']));

header('location: color.php');
?>