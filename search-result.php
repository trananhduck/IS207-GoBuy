<?php require_once('header.php'); ?>

<?php
// Kiểm tra nếu không có search_text hoặc search_text rỗng thì quay về trang chủ
if (empty($_REQUEST['search_text'])) {
    header('Location: index.php');
    exit;
}

// Lấy dữ liệu banner từ bảng cài đặt
$statement = $pdo->prepare("SELECT banner_search FROM table_settings WHERE id = 1");
$statement->execute();
$row = $statement->fetch(PDO::FETCH_ASSOC);
$banner_search = $row['banner_search'] ?? 'default-banner.jpg'; // Nếu không có thì dùng ảnh mặc định

// Xử lý chuỗi tìm kiếm an toàn hơn
$search_text = htmlspecialchars(trim($_REQUEST['search_text']), ENT_QUOTES, 'UTF-8');
?>

<div class="page-banner" style="background-image: url('assets/uploads/<?php echo $banner_search; ?>');">
    <div class="overlay"></div>
    <div class="inner">
        <h1>Kết quả tìm kiếm cho: <?php echo $search_text; ?></h1>
    </div>
</div>


<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product product-cat">

                    <div class="row">
                        <?php
                        $search_text = '%' . $search_text . '%';
                        ?>

                        <!--Phân trang hiển thị danh sách sản phẩm-->
                        <?php
                        // Kết nối PDO (giả định $pdo đã được khai báo trước đó)
                        $adjacents = 5; // Số trang lân cận hiển thị
                        $limit = 12; // Số lượng sản phẩm trên mỗi trang

                        // Lấy từ khóa tìm kiếm từ request
                        $search_text = isset($_REQUEST['search_text']) ? "%" . $_REQUEST['search_text'] . "%" : "%";

                        // Đếm tổng số sản phẩm thỏa mãn điều kiện
                        $statement = $pdo->prepare("SELECT COUNT(*) FROM table_product WHERE p_is_active = ? AND p_name LIKE ?");
                        $statement->execute([1, $search_text]);
                        $total_pages = $statement->fetchColumn(); // Lấy tổng số bản ghi

                        // Xác định trang hiện tại
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        $page = max(1, $page); // Đảm bảo trang không nhỏ hơn 1
                        $start = ($page - 1) * $limit; // Tính vị trí bắt đầu

                        // Truy vấn lấy dữ liệu sản phẩm của trang hiện tại
                        $statement = $pdo->prepare("SELECT * FROM table_product WHERE p_is_active = ? AND p_name LIKE ? LIMIT ?, ?");
                        $statement->bindValue(1, 1, PDO::PARAM_INT);
                        $statement->bindValue(2, $search_text, PDO::PARAM_STR);
                        $statement->bindValue(3, $start, PDO::PARAM_INT);
                        $statement->bindValue(4, $limit, PDO::PARAM_INT);
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                        // Tính toán các trang liên quan
                        $lastpage = ceil($total_pages / $limit); // Tổng số trang
                        $prev = max(1, $page - 1); // Trang trước
                        $next = min($lastpage, $page + 1); // Trang kế tiếp
                        $lpm1 = $lastpage - 1; // Trang gần cuối
                        $targetpage = BASE_URL . 'search-result.php?search_text=' . urlencode($_REQUEST['search_text']);

                        // Tạo giao diện phân trang nếu có nhiều hơn 1 trang
                        $pagination = "";
                        if ($lastpage > 1) {
                            $pagination .= "<div class='pagination'>";

                            // Nút Previous
                            $pagination .= ($page > 1) ? "<a href='$targetpage&page=$prev'>&#171; Previous</a>" : "<span class='disabled'>&#171; Previous</span>";

                            // Hiển thị số trang
                            if ($lastpage <= 7 + ($adjacents * 2)) {
                                for ($counter = 1; $counter <= $lastpage; $counter++) {
                                    $pagination .= ($counter == $page) ? "<span class='current'>$counter</span>" : "<a href='$targetpage&page=$counter'>$counter</a>";
                                }
                            } else {
                                if ($page < 1 + ($adjacents * 2)) {
                                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                        $pagination .= ($counter == $page) ? "<span class='current'>$counter</span>" : "<a href='$targetpage&page=$counter'>$counter</a>";
                                    }
                                    $pagination .= "...<a href='$targetpage&page=$lpm1'>$lpm1</a><a href='$targetpage&page=$lastpage'>$lastpage</a>";
                                } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                    $pagination .= "<a href='$targetpage&page=1'>1</a><a href='$targetpage&page=2'>2</a>...";
                                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                        $pagination .= ($counter == $page) ? "<span class='current'>$counter</span>" : "<a href='$targetpage&page=$counter'>$counter</a>";
                                    }
                                    $pagination .= "...<a href='$targetpage&page=$lpm1'>$lpm1</a><a href='$targetpage&page=$lastpage'>$lastpage</a>";
                                } else {
                                    $pagination .= "<a href='$targetpage&page=1'>1</a><a href='$targetpage&page=2'>2</a>...";
                                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                        $pagination .= ($counter == $page) ? "<span class='current'>$counter</span>" : "<a href='$targetpage&page=$counter'>$counter</a>";
                                    }
                                }
                            }

                            // Nút Next
                            $pagination .= ($page < $lastpage) ? "<a href='$targetpage&page=$next'>Next &#187;</a>" : "<span class='disabled'>Next &#187;</span>";
                            $pagination .= "</div>";
                        }

                        // Xuất kết quả (có thể dùng $pagination trong HTML)
                        // echo $pagination;
                        // 
                        ?>

                        <?php

                        if (!$total_pages):
                            echo '<span style="color:red;font-size:18px;">No result found</span>';
                        else:
                            foreach ($result as $row) {
                        ?>
                        <div class="col-md-3 item item-search-result">
                            <div class="inner">
                                <div class="thumb">
                                    <div class="photo"
                                        style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);">
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a
                                            href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
                                    </h3>
                                    <h4>
                                        $<?php echo $row['p_current_price']; ?>
                                        <?php if ($row['p_old_price'] != ''): ?>
                                        <del>
                                            $<?php echo $row['p_old_price']; ?>
                                        </del>
                                        <?php endif; ?>
                                    </h4>
                                    <div class="rating">
                                        <?php
                                                $t_rating = 0;
                                                $statement1 = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=?");
                                                $statement1->execute(array($row['p_id']));
                                                $tot_rating = $statement1->rowCount();
                                                if ($tot_rating == 0) {
                                                    $avg_rating = 0;
                                                } else {
                                                    $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result1 as $row1) {
                                                        $t_rating = $t_rating + $row1['rating'];
                                                    }
                                                    $avg_rating = $t_rating / $tot_rating;
                                                }
                                                ?>
                                        <?php
                                                if ($avg_rating == 0) {
                                                    echo '';
                                                } elseif ($avg_rating == 1.5) {
                                                    echo '
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    ';
                                                } elseif ($avg_rating == 2.5) {
                                                    echo '
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    ';
                                                } elseif ($avg_rating == 3.5) {
                                                    echo '
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    ';
                                                } elseif ($avg_rating == 4.5) {
                                                    echo '
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    ';
                                                } else {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                ?>
                                        <?php if ($i > $avg_rating): ?>
                                        <i class="fa fa-star-o"></i>
                                        <?php else: ?>
                                        <i class="fa fa-star"></i>
                                        <?php endif; ?>
                                        <?php
                                                    }
                                                }
                                                ?>
                                    </div>
                                    <?php if ($row['p_qty'] == 0): ?>
                                    <div class="out-of-stock">
                                        <div class="inner">
                                            Out Of Stock
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <p><a href="product.php?id=<?php echo $row['p_id']; ?>">Add to Cart</a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            ?>
                        <div class="clear"></div>
                        <div class="pagination">
                            <?php
                                echo $pagination;
                                ?>
                        </div>
                        <?php
                        endif;
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>