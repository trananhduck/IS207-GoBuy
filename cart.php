<?php require_once('header.php');

// Fetch settings once
$query = $pdo->prepare("SELECT banner_cart FROM table_settings WHERE id=1");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
$banner_cart = $row['banner_cart'] ?? '';

// Initialize variables
$errorMsg = '';
$updateSuccess = false;
$debugInfo = [];

if (isset($_POST['form1']) && isset($_SESSION['cart_p_id'])) {
    // Get current inventory levels
    $query = $pdo->prepare("SELECT p_id, p_qty FROM table_product");
    $query->execute();
    $inventory = [];

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $inventory[$row['p_id']] = $row['p_qty'];
    }

    // Debug info - before update
    $debugInfo['before'] = $_SESSION['cart_p_qty'];

    // Process cart updates
    $allow_update = true;
    $insufficient_items = [];
    $hasChanges = false;

    foreach ($_POST['product_id'] as $i => $product_id) {
        $quantity = (int)$_POST['quantity'][$i];
        $product_name = $_POST['product_name'][$i];

        // Find the correct index in the session array
        $session_index = null;
        foreach ($_SESSION['cart_p_id'] as $j => $session_product_id) {
            if ($product_id == $session_product_id) {
                $session_index = $j;
                break;
            }
        }

        if ($session_index !== null) {
            // Validate quantity against inventory
            if (!isset($inventory[$product_id]) || $inventory[$product_id] < $quantity) {
                $allow_update = false;
                $insufficient_items[] = "\"$quantity\" items are not available for \"$product_name\"";
            } else {
                // Check if there's an actual change
                if ($_SESSION['cart_p_qty'][$session_index] != $quantity) {
                    $hasChanges = true;
                }

                // Update session with valid quantities
                $_SESSION['cart_p_qty'][$session_index] = $quantity;
            }
        }
    }

    // Debug info - after update
    $debugInfo['after'] = $_SESSION['cart_p_qty'];

    // Prepare error message if needed
    if (!$allow_update) {
        $errorMsg = implode("\n", $insufficient_items) . "\n\nOther items quantity are updated successfully!";
    } else {
        $updateSuccess = true;
        if (!$hasChanges) {
            $updateSuccess = 'no_change';
        }
    }
}
?>

<?php if (isset($_POST['form1']) && !empty($errorMsg)): ?>
    <script>
        alert('<?php echo $errorMsg; ?>');
    </script>
<?php elseif (isset($_POST['form1']) && $updateSuccess === true): ?>
    <script>
        alert('All Items Quantity Update is Successful!');
    </script>
<?php elseif (isset($_POST['form1']) && $updateSuccess === 'no_change'): ?>
    <script>
        alert('Cart is up to date. No changes were needed.');
    </script>
<?php endif; ?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo htmlspecialchars($banner_cart); ?>)">
    <div class="overlay"></div>
    <div class="page-banner-inner">
        <h1><?php echo 'Giỏ hàng'; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if (!isset($_SESSION['cart_p_id']) || empty($_SESSION['cart_p_id'])): ?>
                    <h2 class="text-center">Cart is Empty!!</h2>
                    <h4 class="text-center">Add products to the cart in order to view it here.</h4>
                <?php else: ?>
                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="cart">
                            <table class="table table-responsive table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Kích thước</th>
                                        <th>Màu sắc</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th class="text-right">Tổng cộng</th>
                                        <th class="text-center" style="width: 100px;">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $table_total_price = 0;
                                    $i = 0;

                                    // Keep track of displayed indexes for form submission
                                    $display_indexes = [];

                                    foreach ($_SESSION['cart_p_id'] as $key => $value):
                                        $i++;
                                        $display_indexes[$i - 1] = $key; // Map display index to session index

                                        $p_id = $_SESSION['cart_p_id'][$key];
                                        $size_id = $_SESSION['cart_size_id'][$key];
                                        $size_name = $_SESSION['cart_size_name'][$key];
                                        $color_id = $_SESSION['cart_color_id'][$key];
                                        $color_name = $_SESSION['cart_color_name'][$key];
                                        $p_qty = $_SESSION['cart_p_qty'][$key];
                                        $p_current_price = $_SESSION['cart_p_current_price'][$key];
                                        $p_name = $_SESSION['cart_p_name'][$key];
                                        $p_featured_photo = $_SESSION['cart_p_featured_photo'][$key];

                                        $row_total_price = $p_current_price * $p_qty;
                                        $table_total_price += $row_total_price;
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <img src="assets/uploads/<?php echo htmlspecialchars($p_featured_photo); ?>"
                                                    alt="<?php echo htmlspecialchars($p_name); ?>">
                                            </td>
                                            <td><?php echo htmlspecialchars($p_name); ?></td>
                                            <td><?php echo htmlspecialchars($size_name); ?></td>
                                            <td><?php echo htmlspecialchars($color_name); ?></td>
                                            <td>VND <?php echo number_format($p_current_price); ?></td>
                                            <td>
                                                <input type="hidden" name="product_id[]" value="<?php echo $p_id; ?>">
                                                <input type="hidden" name="session_key[]" value="<?php echo $key; ?>">
                                                <input type="hidden" name="product_name[]"
                                                    value="<?php echo htmlspecialchars($p_name); ?>">
                                                <input type="number" class="input-text qty text" step="1" min="1"
                                                    name="quantity[]" value="<?php echo $p_qty; ?>" title="Qty" size="4"
                                                    pattern="[0-9]*" inputmode="numeric">
                                            </td>
                                            <td class="text-right">
                                                VND <?php echo number_format($row_total_price); ?>
                                            </td>
                                            <td class="text-center">
                                                <a onclick="return confirmDelete();"
                                                    href="cart-item-delete.php?id=<?php echo $p_id; ?>&size=<?php echo $size_id; ?>&color=<?php echo $color_id; ?>"
                                                    class="trash"><i class="fa fa-trash" style="color:red;"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7" class="total-text">Total</th>
                                        <th class="total-amount">VND <?php echo number_format($table_total_price); ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="cart-buttons">
                            <ul>
                                <li><input type="submit" value="Cập nhật giỏ hàng" class="btn btn-primary" name="form1">
                                </li>
                                <li><a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a></li>
                                <li><a href="checkout.php" class="btn btn-primary">Thanh toán</a></li>
                            </ul>
                        </div>
                    </form>
                <?php endif; ?>

                <?php
                ?>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>