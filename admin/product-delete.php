<?php require_once('header.php'); ?>

<head>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
// Lấy ID ảnh chính để xóa khỏi thư mục
$query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $p_featured_photo = $row['p_featured_photo'];
    unlink('../assets/uploads/product_photos/' . $p_featured_photo);
}

// Lấy ID các ảnh khác để xóa khỏi thư mục
$query = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['photo'];
    unlink('../assets/uploads/product_photos/' . $photo);
}

// Xóa sản phẩm khỏi bảng table_product
$query = $pdo->prepare("DELETE FROM table_product WHERE p_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa ảnh sản phẩm khỏi bảng table_product_photo
$query = $pdo->prepare("DELETE FROM table_product_photo WHERE p_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa kích thước sản phẩm khỏi bảng table_product_size
$query = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa màu sắc sản phẩm khỏi bảng table_product_color
$query = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa đánh giá sản phẩm khỏi bảng table_rating
$query = $pdo->prepare("DELETE FROM table_rating WHERE p_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa thông tin thanh toán liên quan đến sản phẩm khỏi bảng table_payment
$query = $pdo->prepare("SELECT * FROM table_order WHERE product_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $query1 = $pdo->prepare("DELETE FROM table_payment WHERE payment_id=?");
    $query1->execute(array($row['payment_id']));
}

// Xóa đơn hàng liên quan đến sản phẩm khỏi bảng table_order
$query = $pdo->prepare("DELETE FROM table_order WHERE product_id=?");
$query->execute(array($_REQUEST['id']));

header('location: product.php');
?>