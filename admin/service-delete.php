<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    // Nếu không có ID, chuyển hướng đến trang đăng xuất
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ hay không
    $querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Lấy ảnh liên quan đến ID để xóa khỏi thư mục
$querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['photo'];
}

// Xóa ảnh nếu tồn tại
if ($photo != '') {
    unlink('../assets/uploads/' . $photo);
}

// Xóa dữ liệu khỏi bảng table_service
$querry = $pdo->prepare("DELETE FROM table_service WHERE id=?");
$querry->execute(array($_REQUEST['id']));

// Chuyển hướng về trang danh sách dịch vụ
header('location: service.php');
?>