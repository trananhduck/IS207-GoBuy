<?php require_once('header.php'); ?>

<?php
// Kiểm tra tham số đầu vào
if (!isset($_REQUEST['id']) || !isset($_REQUEST['size']) || !isset($_REQUEST['color'])) {
    header('location: cart.php');
    exit;
}

// Kiểm tra nếu giỏ hàng chưa được khởi tạo
if (!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}

// Sao chép dữ liệu giỏ hàng từ session
$cart_data = [];
foreach ($_SESSION['cart_p_id'] as $key => $value) {
    $cart_data[] = [
        'id' => $_SESSION['cart_p_id'][$key],
        'size_id' => $_SESSION['cart_size_id'][$key],
        'size_name' => $_SESSION['cart_size_name'][$key],
        'color_id' => $_SESSION['cart_color_id'][$key],
        'color_name' => $_SESSION['cart_color_name'][$key],
        'qty' => $_SESSION['cart_p_qty'][$key],
        'price' => $_SESSION['cart_p_current_price'][$key],
        'name' => $_SESSION['cart_p_name'][$key],
        'photo' => $_SESSION['cart_p_featured_photo'][$key]
    ];
}

// Lọc giỏ hàng để loại bỏ sản phẩm cần xóa
$cart_data = array_filter($cart_data, function ($item) {
    return !(
        $item['id'] == $_REQUEST['id'] &&
        $item['size_id'] == $_REQUEST['size'] &&
        $item['color_id'] == $_REQUEST['color']
    );
});

// Cập nhật lại session với dữ liệu mới
$_SESSION['cart_p_id'] = array_column($cart_data, 'id');
$_SESSION['cart_size_id'] = array_column($cart_data, 'size_id');
$_SESSION['cart_size_name'] = array_column($cart_data, 'size_name');
$_SESSION['cart_color_id'] = array_column($cart_data, 'color_id');
$_SESSION['cart_color_name'] = array_column($cart_data, 'color_name');
$_SESSION['cart_p_qty'] = array_column($cart_data, 'qty');
$_SESSION['cart_p_current_price'] = array_column($cart_data, 'price');
$_SESSION['cart_p_name'] = array_column($cart_data, 'name');
$_SESSION['cart_p_featured_photo'] = array_column($cart_data, 'photo');

header('location: cart.php');
exit;
?>