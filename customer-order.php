<?php require_once('header.php'); ?>

<?php
// Kiểm tra xem khách hàng đã đăng nhập hay chưa
if (!isset($_SESSION['customer'])) {
    header('location: ' . BASE_URL . 'logout.php');
    exit;
} else {
    // Nếu khách hàng đã đăng nhập nhưng bị quản trị viên vô hiệu hóa, thì buộc đăng xuất người dùng này.
    $query = $pdo->prepare("SELECT * FROM table_customer WHERE cust_id=? AND cust_status=?");
    $query->execute(array($_SESSION['customer']['cust_id'], 0));
    $total = $query->rowCount();
    if ($total) {
        header('location: ' . BASE_URL . 'logout.php');
        exit;
    }
}
?>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('customer-sidebar.php'); ?>
            </div>
            <div class="col-md-9">
                <div class="user-content">
                    <h3><?php echo 'Lịch sử đặt hàng' ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%;"><?php echo 'STT' ?></th>
                                    <th style="width: 45%;"><?php echo 'Chi tiết đơn hàng' ?></th>
                                    <th style="width: 15%;"><?php echo 'Ngày thanh toán' ?></th>
                                    <th style="width: 15%;"><?php echo 'Mã số giao dịch' ?></th>
                                    <th style="width: 10%;"><?php echo 'Tổng tiền' ?></th>
                                    <th style="width: 10%;"><?php echo 'Trạng thái' ?></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                /* Mã phân trang */
                                $adjacents = 5;

                                $query = $pdo->prepare("SELECT * FROM table_payment WHERE customer_email=? ORDER BY id DESC");
                                $query->execute(array($_SESSION['customer']['cust_email']));
                                $total_pages = $query->rowCount();

                                $targetpage = BASE_URL . 'customer-order.php';
                                $limit = 10;
                                $page = @$_GET['page'];
                                if ($page)
                                    $start = ($page - 1) * $limit;
                                else
                                    $start = 0;

                                $query = $pdo->prepare("SELECT * FROM table_payment WHERE customer_email=? ORDER BY id DESC LIMIT $start, $limit");
                                $query->execute(array($_SESSION['customer']['cust_email']));
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                                if ($page == 0) $page = 1;
                                $prev = $page - 1;
                                $next = $page + 1;
                                $lastpage = ceil($total_pages / $limit);
                                $lpm1 = $lastpage - 1;
                                $pagination = "";
                                if ($lastpage > 1) {
                                    $pagination .= "<div class=\"pagination\">";
                                    if ($page > 1)
                                        $pagination .= "<a href=\"$targetpage?page=$prev\">&#171; Trước</a>";
                                    else
                                        $pagination .= "<span class=\"disabled\">&#171; Trước</span>";

                                    if ($lastpage < 7 + ($adjacents * 2)) {
                                        for ($counter = 1; $counter <= $lastpage; $counter++) {
                                            if ($counter == $page)
                                                $pagination .= "<span class=\"current\">$counter</span>";
                                            else
                                                $pagination .= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                        }
                                    } elseif ($lastpage > 5 + ($adjacents * 2)) {
                                        if ($page < 1 + ($adjacents * 2)) {
                                            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                                if ($counter == $page)
                                                    $pagination .= "<span class=\"current\">$counter</span>";
                                                else
                                                    $pagination .= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                            }
                                            $pagination .= "...";
                                            $pagination .= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                            $pagination .= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                                        } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                            $pagination .= "<a href=\"$targetpage?page=1\">1</a>";
                                            $pagination .= "<a href=\"$targetpage?page=2\">2</a>";
                                            $pagination .= "...";
                                            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                                if ($counter == $page)
                                                    $pagination .= "<span class=\"current\">$counter</span>";
                                                else
                                                    $pagination .= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                            }
                                            $pagination .= "...";
                                            $pagination .= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                            $pagination .= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";
                                        } else {
                                            $pagination .= "<a href=\"$targetpage?page=1\">1</a>";
                                            $pagination .= "<a href=\"$targetpage?page=2\">2</a>";
                                            $pagination .= "...";
                                            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                                if ($counter == $page)
                                                    $pagination .= "<span class=\"current\">$counter</span>";
                                                else
                                                    $pagination .= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                            }
                                        }
                                    }

                                    if ($page < $counter - 1)
                                        $pagination .= "<a href=\"$targetpage?page=$next\">Tiếp &#187;</a>";
                                    else
                                        $pagination .= "<span class=\"disabled\">Tiếp &#187;</span>";
                                    $pagination .= "</div>\n";
                                }
                                /* Kết thúc mã phân trang */
                                ?>

                                <?php
                                $tip = $page * 10 - 10;
                                foreach ($result as $row) {
                                    $tip++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?php echo $tip; ?></td>
                                        <td style="width: 45%;">
                                            <?php
                                            $query1 = $pdo->prepare("SELECT * FROM table_order WHERE payment_id=?");
                                            $query1->execute(array($row['payment_id']));
                                            $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result1 as $row1) {
                                                echo 'Tên sản phẩm: ' . $row1['product_name'];
                                                echo '<br>Kích thước: ' . $row1['size'];
                                                echo '<br>Màu sắc: ' . $row1['color'];
                                                echo '<br>Số lượng: ' . $row1['quantity'];
                                                echo '<br>Giá đơn vị: ' . $row1['unit_price'] . 'VND';
                                                echo '<br><br>';
                                            }
                                            ?>
                                        </td>
                                        <td style="width: 15%;"><?php echo $row['payment_date']; ?></td>
                                        <td style="width: 15%;"><?php echo $row['txnid']; ?></td>
                                        <td style="width: 10%;"><?php echo $row['paid_amount'] . 'VND'; ?></td>
                                        <td style="width: 10%;"><?php echo $row['payment_status']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                        <div class="pagination" style="overflow: hidden;">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>