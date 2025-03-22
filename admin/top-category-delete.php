<?php require_once('header.php'); ?>

<?php
// Ngăn chặn truy cập trực tiếp vào trang này.
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_top_category WHERE tcat_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
$query = $pdo->prepare("SELECT * 
							FROM table_top_category t1
							JOIN table_mid_category t2
							ON t1.tcat_id = t2.tcat_id
							JOIN table_end_category t3
							ON t2.mcat_id = t3.mcat_id
							WHERE t1.tcat_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $ecat_ids[] = $row['ecat_id'];
}

if (isset($ecat_ids)) {

    for ($i = 0; $i < count($ecat_ids); $i++) {
        $query = $pdo->prepare("SELECT * FROM table_product WHERE ecat_id=?");
        $query->execute(array($ecat_ids[$i]));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $p_ids[] = $row['p_id'];
        }
    }

    for ($i = 0; $i < count($p_ids); $i++) {

        // Lấy ảnh sản phẩm để xóa khỏi thư mục
        $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
        $query->execute(array($p_ids[$i]));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $p_featured_photo = $row['p_featured_photo'];
            unlink('../assets/uploads/' . $p_featured_photo);
        }

        // Lấy các ảnh khác để xóa khỏi thư mục
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

        // Xóa dữ liệu kích thước sản phẩm khỏi bảng table_product_size
        $query = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
        $query->execute(array($p_ids[$i]));

        // Xóa dữ liệu màu sắc sản phẩm khỏi bảng table_product_color
        $query = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
        $query->execute(array($p_ids[$i]));

        // Xóa đánh giá sản phẩm khỏi bảng table_rating
        $query = $pdo->prepare("DELETE FROM table_rating WHERE p_id=?");
        $query->execute(array($p_ids[$i]));

        // Xóa dữ liệu thanh toán liên quan
        $query = $pdo->prepare("SELECT * FROM table_order WHERE product_id=?");
        $query->execute(array($p_ids[$i]));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $query1 = $pdo->prepare("DELETE FROM table_payment WHERE payment_id=?");
            $query1->execute(array($row['payment_id']));
        }

        // Xóa đơn hàng khỏi bảng table_order
        $query = $pdo->prepare("DELETE FROM table_order WHERE product_id=?");
        $query->execute(array($p_ids[$i]));
    }

    // Xóa danh mục con khỏi bảng table_end_category
    for ($i = 0; $i < count($ecat_ids); $i++) {
        $query = $pdo->prepare("DELETE FROM table_end_category WHERE ecat_id=?");
        $query->execute(array($ecat_ids[$i]));
    }
}

// Xóa danh mục trung khỏi bảng table_mid_category
$query = $pdo->prepare("DELETE FROM table_mid_category WHERE tcat_id=?");
$query->execute(array($_REQUEST['id']));

// Xóa danh mục lớn khỏi bảng table_top_category
$query = $pdo->prepare("DELETE FROM table_top_category WHERE tcat_id=?");
$query->execute(array($_REQUEST['id']));

header('location: top-category.php');
?>