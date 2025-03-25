<?php require_once('header.php'); ?>

<?php
// Ngăn chặn truy cập trực tiếp vào trang này.
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem ID có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_end_category WHERE ecat_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
$p_ids = [];
// Lấy tất cả ID của sản phẩm thuộc danh mục này
$query = $pdo->prepare("SELECT * FROM table_product WHERE ecat_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $p_ids[] = $row['p_id'];
}

for ($i = 0; $i < count($p_ids); $i++) {

    // Lấy ID ảnh sản phẩm để xóa khỏi thư mục
    $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $query->execute(array($p_ids[$i]));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $p_featured_photo = $row['p_featured_photo'];
        unlink('../assets/uploads/' . $p_featured_photo);
    }

    // Lấy ID các ảnh khác của sản phẩm để xóa khỏi thư mục
    $query = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
    $query->execute(array($p_ids[$i]));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $photo = $row['photo'];
        unlink('../assets/uploads/product_photos/' . $photo);
    }

    // Xóa sản phẩm khỏi bảng table_product
    $query = $pdo->prepare("DELETE FROM table_product WHERE p_id=?");
    $query->execute(array($p_ids[$i]));

    // Xóa ảnh sản phẩm khỏi bảng table_product_photo
    $query = $pdo->prepare("DELETE FROM table_product_photo WHERE p_id=?");
    $query->execute(array($p_ids[$i]));

    // Xóa kích thước sản phẩm khỏi bảng table_product_size
    $query = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
    $query->execute(array($p_ids[$i]));

    // Xóa màu sắc sản phẩm khỏi bảng table_product_color
    $query = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
    $query->execute(array($p_ids[$i]));

    // Xóa đánh giá sản phẩm khỏi bảng table_rating
    $query = $pdo->prepare("DELETE FROM table_rating WHERE p_id=?");
    $query->execute(array($p_ids[$i]));

    // Xóa thanh toán liên quan đến sản phẩm khỏi bảng table_payment
    $query = $pdo->prepare("SELECT * FROM table_order WHERE product_id=?");
    $query->execute(array($p_ids[$i]));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $query1 = $pdo->prepare("DELETE FROM table_payment WHERE payment_id=?");
        $query1->execute(array($row['payment_id']));
    }

    // Xóa đơn hàng liên quan đến sản phẩm khỏi bảng table_order
    $query = $pdo->prepare("DELETE FROM table_order WHERE product_id=?");
    $query->execute(array($p_ids[$i]));
}

// Xóa danh mục con khỏi bảng table_end_category
$query = $pdo->prepare("DELETE FROM table_end_category WHERE ecat_id=?");
$query->execute(array($_REQUEST['id']));

header('location: end-category.php');
?>