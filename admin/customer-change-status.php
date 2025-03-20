<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem có tham số 'id' được truyền vào không
if (!isset($_REQUEST['id'])) {
    // Nếu không có 'id', chuyển hướng về trang đăng xuất
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    
    if ($total == 0) {
        // Nếu không tìm thấy khách hàng với id này, chuyển hướng về trang đăng xuất
        header('location: logout.php');
        exit;
    } else {
        // Lấy thông tin khách hàng từ cơ sở dữ liệu
        $result = $query->fetchAll(PDO::FETCH_ASSOC);							
        foreach ($result as $row) {
            $cust_status = $row['cust_status']; // Lấy trạng thái hiện tại của khách hàng
        }
    }
}

// Thay đổi trạng thái khách hàng: Nếu đang không hoạt động (0) -> kích hoạt (1), nếu đang hoạt động (1) -> vô hiệu hóa (0)
if ($cust_status == 0) {
    $final = 1; // Đặt trạng thái thành hoạt động
} else {
    $final = 0; // Đặt trạng thái thành không hoạt động
}

// Cập nhật trạng thái khách hàng trong cơ sở dữ liệu
$query = $pdo->prepare("UPDATE table_customer SET cust_status=? WHERE cust_id=?");
$query->execute(array($final, $_REQUEST['id']));

// Chuyển hướng trở lại trang danh sách khách hàng sau khi cập nhật trạng thái
header('location: customer.php');
?>