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
                                <th colspan="7" class="total-text"><?php echo 'Sub Total' ?></th>
                                <th class="total-amount"><?php echo $table_total_price; ?><?php echo ' VND' ?></th>
                            </tr>
                            <?php
                            $query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE province_id=?");
                            $query->execute(array($_SESSION['customer']['cust_province']));
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
                                <th colspan="7" class="total-text"><?php echo 'Tổng' ?></th>
                                <th class="total-amount">
                                    <?php
                                    $final_total = $table_total_price + $shipping_cost;
                                    ?>
                                    <?php echo $final_total; ?><?php echo ' VND' ?>
                                </th>
                            </tr>
                        </table>
                    </div>



                    <div class="billing-address">
                        <div class="row">

                            <div class="col-md-6">
                                <h3 class="special"><?php echo 'Địa chỉ giao hàng' ?></h3>
                                <table class="table table-responsive table-bordered table-hover table-striped bill-address">
                                    <tr>
                                        <td><?php echo 'Họ và tên' ?></td>
                                        <td><?php echo $_SESSION['customer']['cust_s_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo 'Số điện thoại' ?></td>
                                        <td><?php echo $_SESSION['customer']['cust_s_phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo 'Tỉnh/thành phố' ?></td>
                                        <td>
                                            <?php
                                            $query = $pdo->prepare("SELECT * FROM table_province WHERE province_id=?");
                                            $query->execute(array($_SESSION['customer']['cust_s_province']));
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                echo $row['province_name'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo 'Quận/huyện' ?></td>
                                        <td><?php echo $_SESSION['customer']['cust_s_district']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo 'Địa chỉ' ?></td>
                                        <td>
                                            <?php echo nl2br($_SESSION['customer']['cust_s_address']); ?>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>



                    <div class="cart-buttons">
                        <ul>
                            <li><a href="cart.php" class="btn btn-primary"><?php echo 'Quay về giỏ hàng' ?></a></li>
                        </ul>
                    </div>

                    <div class="clear"></div>
                    <h3 class="special"><?php echo 'Chọn phương thức thanh toán' ?></h3>
                    <div class="row">

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
                            <div class="col-md-12">
                                <div style="color:red;font-size:22px;margin-bottom:50px;">

                                    Bạn phải điền đầy đủ thông tin giao hàng từ bảng điều khiển của bạn
                                    để thanh toán đơn hàng. Vui lòng điền đầy đủ thông tin vào <a
                                        href="customer-billing-shipping-update.php"
                                        style="color:red;text-decoration:underline;">link này</a>.
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-md-4">

                                <div class="row">

                                    <div class="col-md-12 form-group">
                                        <label for=""><?php echo 'Chọn phương thức thanh toán' ?> *</label>
                                        <select name="payment_method" class="form-control select2" id="advFieldsStatus">
                                            <option value=""><?php echo 'Chọn 1 phương thức' ?></option>
                                            <option value="Bank"><?php echo 'Ngân hàng' ?></option>
                                        </select>
                                    </div>
                                    <form class="Bank" action="<?php echo BASE_URL; ?>payment/Bank/payment-process.php"
                                        method="post" id="Bank_form" target="_blank">
                                        <input type="hidden" name="cmd" value="_xclick" />
                                        <input type="hidden" name="no_note" value="1" />
                                        <input type="hidden" name="lc" value="UK" />
                                        <input type="hidden" name="currency_code" value="USD" />
                                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                        <input type="hidden" name="final_total" value="<?php echo $final_total; ?>">
                                        <div class="col-md-12 form-group">
                                            <input type="submit" class="btn btn-primary" value="<?php echo 'Thanh toán ngay' ?>"
                                                name="form1">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>