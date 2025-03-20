<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Getting photo ID to unlink from folder
$query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['photo'];
}

// Unlink ảnh 
if ($photo != '') {
    unlink('../assets/uploads/' . $photo);
}

// xóa khỏi table_slider
$query = $pdo->prepare("DELETE FROM table_slider WHERE id=?");
$query->execute(array($_REQUEST['id']));

header('location: slider.php');
?><?php require_once('header.php'); ?>

<?php
// Kiểm tra xem có ID được truyền vào không, nếu không thì đăng xuất
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem ID có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        // Nếu ID không tồn tại, chuyển hướng đến trang đăng xuất
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Lấy ảnh hiện tại của slider để xóa khỏi thư mục
$query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['photo']; // Lưu tên file ảnh vào biến $photo
}

// Nếu có ảnh, tiến hành xóa khỏi thư mục uploads
if ($photo != '') {
    unlink('../assets/uploads/' . $photo);
}

// Xóa dữ liệu slider khỏi bảng `table_slider`
$query = $pdo->prepare("DELETE FROM table_slider WHERE id=?");
$query->execute(array($_REQUEST['id']));

// Chuyển hướng về trang danh sách slider sau khi xóa
header('location: slider.php');
?>