<?php require_once('header.php'); ?>
<?php
if (isset($_GET['clear_cart']) && $_GET['clear_cart'] == "true") {
    unset($_SESSION['cart_p_id']);
    unset($_SESSION['cart_size_id']);
    unset($_SESSION['cart_size_name']);
    unset($_SESSION['cart_color_id']);
    unset($_SESSION['cart_color_name']);
    unset($_SESSION['cart_p_qty']);
    unset($_SESSION['cart_p_current_price']);
    unset($_SESSION['cart_p_name']);
    unset($_SESSION['cart_p_featured_photo']);
    header("Location: checkout.php");
    exit;
}
?>
<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_checkout = $row['banner_checkout'];
}
?>

<?php
if (!isset($_SESSION['cart_p_id'])) {
    header('location: cart.php');
    exit;
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/product_photos/<?php echo $banner_checkout; ?>)">
    <div class="overlay"></div>
    <div class="page-banner-inner">
        <h1><?php echo 'Thanh toán' ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php if (!isset($_SESSION['customer'])): ?>
                    <p>
                        <a href="login-customer.php"
                            class="btn btn-md btn-danger"><?php echo 'Vui lòng đăng nhập để thanh toán' ?></a>
                    </p>
                <?php else: ?>

                    <h3 class="special"><?php echo 'Chi tiết đặt hàng' ?></h3>
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
                            <?php
                            $arr_cart_p_id = $arr_cart_p_id ?? [];
                            for ($i = 1; $i <= count($arr_cart_p_id); $i++): ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <img src="assets/uploads/product_photos/<?php echo $arr_cart_p_featured_photo[$i]; ?>"
                                            alt="">
                                    </td>
                                    <td><?php echo $arr_cart_p_name[$i]; ?></td>
                                    <td><?php echo $arr_cart_size_name[$i]; ?></td>
                                    <td><?php echo $arr_cart_color_name[$i]; ?></td>
                                    <td><?php echo $arr_cart_p_current_price[$i]; ?><?php echo ' VND' ?></td>
                                    <td><?php echo $arr_cart_p_qty[$i]; ?></td>
                                    <td class="text-right">
                                        <?php
                                        $row_total_price = $arr_cart_p_current_price[$i] * $arr_cart_p_qty[$i];
                                        $table_total_price = $table_total_price + $row_total_price;
                                        ?>
                                        <?php echo $row_total_price; ?><?php echo ' VND' ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                            <tr>
                                <th colspan="7" class="total-text"><?php echo 'Tổng tiền hàng' ?></th>
                                <th class="total-amount"><?php echo $table_total_price; ?><?php echo ' VND' ?></th>
                            </tr>
                            <?php
                            $query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE province_id=?");
                            $query->execute(array($_SESSION['customer']['cust_s_province']));
                            $total = $query->rowCount();
                            if ($total) {
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $shipping_cost = $row['amount'];
                                }
                            } else {
                                $query = $pdo->prepare("SELECT * FROM table_shipping_cost_all WHERE sca_id=1");
                                $query->execute();
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                    $shipping_cost = $row['amount'];
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="7" class="total-text"><?php echo 'Phí vận chuyển' ?></td>
                                <td class="total-amount"><?php echo $shipping_cost; ?><?php echo ' VND' ?></td>
                            </tr>
                            <tr>
                                <th colspan="7" class="total-text"><?php echo 'Tổng tiền phải trả' ?></th>
                                <th class="total-amount">
                                    <?php
                                    $final_total = $table_total_price + $shipping_cost;
                                    ?>
                                    <?php echo $final_total; ?><?php echo ' VND' ?>
                                </th>
                            </tr>
                        </table>
                    </div>


                    <div class="row">
                        <!-- Địa chỉ giao hàng -->
                        <div class="col-md-6">
                            <h3 class="special">Địa chỉ giao hàng</h3>
                            <table class="table table-responsive table-bordered table-hover table-striped bill-address">
                                <tr>
                                    <td>Họ và tên</td>
                                    <td><?php echo $_SESSION['customer']['cust_s_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td><?php echo $_SESSION['customer']['cust_s_phone']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tỉnh/thành phố</td>
                                    <td><?php echo $_SESSION['customer']['cust_s_province']; ?></td>
                                </tr>
                                <tr>
                                    <td>Quận/huyện</td>
                                    <td><?php echo $_SESSION['customer']['cust_s_district']; ?></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td><?php echo nl2br($_SESSION['customer']['cust_s_address']); ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <div class="col-md-6">
                            <h3 class="special">Chọn phương thức thanh toán</h3>

                            <?php
                            $checkout_access = 1;
                            if (
                                ($_SESSION['customer']['cust_s_name'] == '') ||
                                ($_SESSION['customer']['cust_s_phone'] == '') ||
                                ($_SESSION['customer']['cust_s_province'] == '') ||
                                ($_SESSION['customer']['cust_s_address'] == '') ||
                                ($_SESSION['customer']['cust_s_district'] == '')
                            ) {
                                $checkout_access = 0;
                            }
                            ?>

                            <?php if ($checkout_access == 0): ?>
                                <div style="color:red;font-size:16px;margin-bottom:20px;">
                                    Bạn phải điền đầy đủ thông tin giao hàng từ bảng điều khiển của bạn
                                    để thanh toán đơn hàng. Vui lòng điền đầy đủ thông tin vào <a
                                        href="customer-billing-shipping-update.php"
                                        style="color:red;text-decoration:underline;">link này</a>.
                                </div>
                            <?php else: ?>
                                <div class="form-group">
                                    <label>Chọn phương thức thanh toán *</label>
                                    <select name="payment_method" class="form-control select2" id="advFieldsStatus">
                                        <option value="">Chọn 1 phương thức</option>
                                        <option value="Bank">Ngân hàng</option>
                                    </select>
                                </div>

                                <form class="Bank" action="<?php echo BASE_URL; ?>payment/Bank/payment-process.php"
                                    method="post" id="Bank_form" target="_blank">
                                    <input type="hidden" name="final_total" value="<?php echo $final_total; ?>">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Thanh toán ngay" name="form1">
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="cart-buttons">
                        <ul>
                            <li><a href="cart.php" class="btn btn-primary"><?php echo 'Quay về giỏ hàng' ?></a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>