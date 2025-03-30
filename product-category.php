<?php require_once('header.php'); ?>

<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $banner_product_category = $row['banner_product_category'];
}
?>

<?php
if (!isset($_REQUEST['id']) || !isset($_REQUEST['type'])) {
    header('location: index.php');
    exit;
} else {

    if (($_REQUEST['type'] != 'top-category') && ($_REQUEST['type'] != 'mid-category') && ($_REQUEST['type'] != 'end-category')) {
        header('location: index.php');
        exit;
    } else {

        $query = $pdo->prepare("SELECT * FROM table_top_category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $top[] = $row['tcat_id'];
            $top1[] = $row['tcat_name'];
        }

        $query = $pdo->prepare("SELECT * FROM table_mid_category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $mid[] = $row['mcat_id'];
            $mid1[] = $row['mcat_name'];
            $mid2[] = $row['tcat_id'];
        }

        $query = $pdo->prepare("SELECT * FROM table_end_category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $end[] = $row['ecat_id'];
            $end1[] = $row['ecat_name'];
            $end2[] = $row['mcat_id'];
        }

        if ($_REQUEST['type'] == 'top-category') {
            if (!in_array($_REQUEST['id'], $top)) {
                header('location: index.php');
                exit;
            } else {

                // Lấy điêu đề
                for ($i = 0; $i < count($top); $i++) {
                    if ($top[$i] == $_REQUEST['id']) {
                        $title = $top1[$i];
                        break;
                    }
                }
                $arr1 = array();
                $arr2 = array();
                // Tìm tất cả id của end-category
                for ($i = 0; $i < count($mid); $i++) {
                    if ($mid2[$i] == $_REQUEST['id']) {
                        $arr1[] = $mid[$i];
                    }
                }
                for ($j = 0; $j < count($arr1); $j++) {
                    for ($i = 0; $i < count($end); $i++) {
                        if ($end2[$i] == $arr1[$j]) {
                            $arr2[] = $end[$i];
                        }
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if ($_REQUEST['type'] == 'mid-category') {
            if (!in_array($_REQUEST['id'], $mid)) {
                header('location: index.php');
                exit;
            } else {
                // Lấy tiêu đề
                for ($i = 0; $i < count($mid); $i++) {
                    if ($mid[$i] == $_REQUEST['id']) {
                        $title = $mid1[$i];
                        break;
                    }
                }
                $arr2 = array();
                // Tìm tất cả id của end-category
                for ($i = 0; $i < count($end); $i++) {
                    if ($end2[$i] == $_REQUEST['id']) {
                        $arr2[] = $end[$i];
                    }
                }
                $final_ecat_ids = $arr2;
            }
        }

        if ($_REQUEST['type'] == 'end-category') {
            if (!in_array($_REQUEST['id'], $end)) {
                header('location: index.php');
                exit;
            } else {
                // Lấy tiêu đề
                for ($i = 0; $i < count($end); $i++) {
                    if ($end[$i] == $_REQUEST['id']) {
                        $title = $end1[$i];
                        break;
                    }
                }
                $final_ecat_ids = array($_REQUEST['id']);
            }
        }
    }
}
?>

<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $banner_product_category; ?>)">
    <div class="inner">
        <h1><?php echo 'Danh mục:' ?> <?php echo $title; ?></h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('sidebar-category.php'); ?>
            </div>
            <div class="col-md-9">

                <h3><?php echo 'Tất cả sản phẩm' ?> "<?php echo $title; ?>"</h3>
                <div class="product product-cat">

                    <div class="row">
                        <?php
                        // Kiểm tra xem sản phẩm có tồn tại không
                        $prod_count = 0;
                        $query = $pdo->prepare("SELECT * FROM table_product");
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $prod_table_ecat_ids[] = $row['ecat_id'];
                        }

                        for ($ii = 0; $ii < count($final_ecat_ids); $ii++):
                            if (in_array($final_ecat_ids[$ii], $prod_table_ecat_ids)) {
                                $prod_count++;
                            }
                        endfor;

                        if ($prod_count == 0) {
                            echo '<div class="pl_15">' . 'Không tìm thấy sản phẩm' . '</div>';
                        } else {
                            for ($ii = 0; $ii < count($final_ecat_ids); $ii++) {
                                $query = $pdo->prepare("SELECT * FROM table_product WHERE ecat_id=? AND p_is_active=?");
                                $query->execute(array($final_ecat_ids[$ii], 1));
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                        ?>
                        <div class="col-md-4 item item-product-cat">
                            <div class="inner">
                                <div class="thumb">
                                    <div class="photo"
                                        style="background-image:url(assets/uploads/product_photos/<?php echo $row['p_featured_photo']; ?>);">
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                                <div class="text">
                                    <h3><a
                                            href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
                                    </h3>
                                    <h4>
                                        <span>
                                            <?php if ($row['p_old_price'] != ''): ?>
                                            <del>
                                                <?php echo $row['p_old_price']; ?><span class="vnd">VND</span>
                                            </del>
                                        </span>
                                        <?php endif; ?>
                                        <span>
                                            <?php echo $row['p_current_price']; ?><span class="vnd">VND</span>
                                        </span>
                                    </h4>
                                    <div class="rating">
                                        <?php
                                                    $t_rating = 0;
                                                    $query1 = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=?");
                                                    $query1->execute(array($row['p_id']));
                                                    $tot_rating = $query1->rowCount();
                                                    if ($tot_rating == 0) {
                                                        $avg_rating = 0;
                                                    } else {
                                                        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);
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
                                            Hết hàng
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <p><a href="product.php?id=<?php echo $row['p_id']; ?>"></i>
                                            <?php echo 'Xem sản phẩm' ?></a>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('footer.php'); ?>