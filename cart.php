<?php require_once('header.php'); ?>

<?php
$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_cart = $row['banner_cart'];
}
?>

<?php
$errorMsg = ''; // Biến lưu trữ thông báo lỗi

if (isset($_POST['form1'])) { // Kiểm tra nếu biểu mẫu đã được gửi

    $i = 0;
    // Truy vấn tất cả sản phẩm từ bảng table_product
    $querry = $pdo->prepare("SELECT * FROM table_product");
    $querry->execute();
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);

    // Lưu ID sản phẩm và số lượng tồn kho vào mảng
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['p_id']; // ID sản phẩm từ DB
        $table_quantity[$i] = $row['p_qty']; // Số lượng tồn kho
    }

    // Lấy danh sách ID sản phẩm từ form gửi lên
    $i = 0;
    foreach ($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }

    // Lấy danh sách số lượng sản phẩm người dùng yêu cầu từ form
    $i = 0;
    foreach ($_POST['quantity'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }

    // Lấy danh sách tên sản phẩm từ form gửi lên
    $i = 0;
    foreach ($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }

    $allow_update = 1; // Biến kiểm tra xem có thể cập nhật giỏ hàng không

    // Lặp qua danh sách sản phẩm người dùng gửi lên
    for ($i = 1; $i <= count($arr1); $i++) {
        // Tìm vị trí của sản phẩm trong danh sách sản phẩm có sẵn
        for ($j = 1; $j <= count($table_product_id); $j++) {
            if ($arr1[$i] == $table_product_id[$j]) {
                $temp_index = $j;
                break;
            }
        }

        // Kiểm tra nếu số lượng yêu cầu lớn hơn số lượng có trong kho
        if ($table_quantity[$temp_index] < $arr2[$i]) {
            $allow_update = 0; // Không cho phép cập nhật
            $errorMsg .= '"' . $arr2[$i] . '" items are not available for "' . $arr3[$i] . '"\n';
        } else {
            // Nếu đủ hàng, cập nhật số lượng trong session
            $_SESSION['cart_p_qty'][$i] = $arr2[$i];
        }
    }

    // Thêm thông báo nếu có một số mặt hàng không đủ số lượng
    $errorMsg .= '\nOther items quantity are updated successfully!';
?>

    <?php if ($allow_update == 0): ?>
        <script>
            // Hiển thị thông báo lỗi nếu có sản phẩm không đủ số lượng
            alert('<?php echo $errorMsg; ?>');
        </script>
    <?php else: ?>
        <script>
            // Hiển thị thông báo thành công nếu tất cả sản phẩm đều cập nhật thành công
            alert('Tất cả số lượng sản phẩm được cập nhật thành công');
        </script>
    <?php endif; ?>
<?php
}
?>


<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_cart; ?>)">
    <div class="overlay"></div>
    <div class="page-banner-inner">
        <h1><?php echo 'Giỏ hàng' ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (!isset($_SESSION['cart_p_id'])): ?>
                    <?php echo '<h2 class="text-center">Giỏ hàng đang trống</h2></br>'; ?>
                    <?php echo '<h4 class="text-center">Thêm sản phẩm vào giỏ hàng tại đây</h4>'; ?>
                <?php else: ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="cart">
                            <table class="table table-responsive table-hover table-bordered">
                                <tr>
                                    <th><?php echo 'STT' ?></th>
                                    <th><?php echo 'Ảnh' ?></th>
                                    <th><?php echo 'Tên sản phẩm' ?></th>
                                    <th><?php echo 'Kích thước' ?></th>
                                    <th><?php echo 'Màu sắc' ?></th>
                                    <th><?php echo 'Giá' ?></th>
                                    <th><?php echo 'Số lượng' ?></th>
                                    <th class="text-right"><?php echo 'Tổng' ?></th>
                                    <th class="text-center" style="width: 100px;"><?php echo 'Hành động' ?></th>
                                </tr>
                                <?php
                                $table_total_price = 0;

                                $i = 0;
                                foreach ($_SESSION['cart_p_id'] as $key => $value) {
                                    $i++;
                                    $arr_cart_p_id[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_size_id'] as $key => $value) {
                                    $i++;
                                    $arr_cart_size_id[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_size_name'] as $key => $value) {
                                    $i++;
                                    $arr_cart_size_name[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_color_id'] as $key => $value) {
                                    $i++;
                                    $arr_cart_color_id[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_color_name'] as $key => $value) {
                                    $i++;
                                    $arr_cart_color_name[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_p_qty'] as $key => $value) {
                                    $i++;
                                    $arr_cart_p_qty[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_p_current_price'] as $key => $value) {
                                    $i++;
                                    $arr_cart_p_current_price[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_p_name'] as $key => $value) {
                                    $i++;
                                    $arr_cart_p_name[$i] = $value;
                                }

                                $i = 0;
                                foreach ($_SESSION['cart_p_featured_photo'] as $key => $value) {
                                    $i++;
                                    $arr_cart_p_featured_photo[$i] = $value;
                                }
                                ?>
                                <?php for ($i = 1; $i <= count($arr_cart_p_id); $i++): ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <img src="assets/uploads/<?php echo $arr_cart_p_featured_photo[$i]; ?>" alt="">
                                        </td>
                                        <td><?php echo $arr_cart_p_name[$i]; ?></td>
                                        <td><?php echo $arr_cart_size_name[$i]; ?></td>
                                        <td><?php echo $arr_cart_color_name[$i]; ?></td>
                                        <td><?php echo $arr_cart_p_current_price[$i]; ?><?php echo ' VND' ?></td>
                                        <td>
                                            <input type="hidden" name="product_id[]" value="<?php echo $arr_cart_p_id[$i]; ?>">
                                            <input type="hidden" name="product_name[]"
                                                value="<?php echo $arr_cart_p_name[$i]; ?>">
                                            <input type="number" class="input-text qty text" step="1" min="1" max=""
                                                name="quantity[]" value="<?php echo $arr_cart_p_qty[$i]; ?>" title="Qty"
                                                size="4" pattern="[0-9]*" inputmode="numeric">
                                        </td>
                                        <td class="text-right">
                                            <?php
                                            $row_total_price = $arr_cart_p_current_price[$i] * $arr_cart_p_qty[$i];
                                            $table_total_price = $table_total_price + $row_total_price;
                                            ?>
                                            <?php echo $row_total_price; ?><?php echo ' VND' ?>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="return confirmDelete();"
                                                href="cart-item-delete.php?id=<?php echo $arr_cart_p_id[$i]; ?>&size=<?php echo $arr_cart_size_id[$i]; ?>&color=<?php echo $arr_cart_color_id[$i]; ?>"
                                                class="trash"><i class="fa fa-trash" style="color:red;"></i></a>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                                <tr>
                                    <th colspan="7" class="total-text">Thành tiền</th>
                                    <th class="total-amount"><?php echo $table_total_price; ?><?php echo ' VND' ?>
                                    </th>
                                    <th></th>
                                </tr>
                            </table>
                        </div>

                        <div class="cart-buttons">
                            <ul>
                                <li><input type="submit" value="<?php echo 'Cập nhật số lượng' ?>" class="btn btn-primary"
                                        name="form1"></li>
                                <li><a href="index.php" class="btn btn-primary"><?php echo 'Tiếp tục mua hàng' ?></a></li>
                                <li><a href="checkout.php" class="btn btn-primary"><?php echo 'Thanh toán' ?></a></li>
                            </ul>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>