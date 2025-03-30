<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Kiểm tra id hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: index.php');
        exit;
    }
}

foreach ($result as $row) {
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_return_policy = $row['p_return_policy'];
    $p_total_order = $row['p_total_order'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}

// Lấy tên các danh mục
$query = $pdo->prepare("SELECT
                        t1.ecat_id,t1.ecat_name,t1.mcat_id,
                        t2.mcat_id,t2.mcat_name,t2.tcat_id,
                        t3.tcat_id,t3.tcat_name

                        FROM table_end_category t1
                        JOIN table_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN table_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$query->execute(array($ecat_id));
$total = $query->rowCount();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $mcat_name = $row['mcat_name'];
    $tcat_id = $row['tcat_id'];
    $tcat_name = $row['tcat_name'];
}


$query = $pdo->prepare("SELECT * FROM table_product_size WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $size[] = $row['size_id'];
}

$query = $pdo->prepare("SELECT * FROM table_product_color WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $color[] = $row['color_id'];
}


if (isset($_POST['form_review'])) {

    $query = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=? AND cust_id=?");
    $query->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
    $total = $query->rowCount();

    if ($total) {
        $errorMsg = 'Bạn đã đưa ra đánh giá!';
    } else {
        $query = $pdo->prepare("INSERT INTO table_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
        $query->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id'], $_POST['comment'], $_POST['rating']));
        $successMsg = 'Đánh giá của bạn đã được gửi thành công!';
    }
}

// Lấy trung bình đánh giá cho sản phẩm
$t_rating = 0;
$query = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$tot_rating = $query->rowCount();
if ($tot_rating == 0) {
    $avg_rating = 0;
} else {
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $t_rating = $t_rating + $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}

if (isset($_POST['form_add_to_cart'])) {

    // lấy số lượng hàng còn trong kho
    $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $query->execute(array($_REQUEST['id']));
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $current_p_qty = $row['p_qty'];
    }
    if ($_POST['p_qty'] > $current_p_qty):
        $temp_msg = 'Xin lỗi, chúng tôi chỉ có ' . $current_p_qty . ' món trong kho';
?>
<script type="text/javascript">
alert('<?php echo $temp_msg; ?>');
</script>
<?php
    else:
        if (isset($_SESSION['cart_p_id'])) {
            $arr_cart_p_id = array();
            $arr_cart_size_id = array();
            $arr_cart_color_id = array();
            $arr_cart_p_qty = array();
            $arr_cart_p_current_price = array();

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
            foreach ($_SESSION['cart_color_id'] as $key => $value) {
                $i++;
                $arr_cart_color_id[$i] = $value;
            }


            $added = 0;
            if (!isset($_POST['size_id'])) {
                $size_id = 0;
            } else {
                $size_id = $_POST['size_id'];
            }
            if (!isset($_POST['color_id'])) {
                $color_id = 0;
            } else {
                $color_id = $_POST['color_id'];
            }
            for ($i = 1; $i <= count($arr_cart_p_id); $i++) {
                if (($arr_cart_p_id[$i] == $_REQUEST['id']) && ($arr_cart_size_id[$i] == $size_id) && ($arr_cart_color_id[$i] == $color_id)) {
                    $added = 1;
                    break;
                }
            }
            if ($added == 1) {
                $errorMsg1 = 'Sản phẩm này đã được thêm vào giỏ hàng.';
            } else {

                $i = 0;
                foreach ($_SESSION['cart_p_id'] as $key => $res) {
                    $i++;
                }
                $new_key = $i + 1;

                if (isset($_POST['size_id'])) {

                    $size_id = $_POST['size_id'];

                    $query = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
                    $query->execute(array($size_id));
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $size_name = $row['size_name'];
                    }
                } else {
                    $size_id = 0;
                    $size_name = '';
                }

                if (isset($_POST['color_id'])) {
                    $color_id = $_POST['color_id'];
                    $query = $pdo->prepare("SELECT * FROM table_color WHERE color_id=?");
                    $query->execute(array($color_id));
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $color_name = $row['color_name'];
                    }
                } else {
                    $color_id = 0;
                    $color_name = '';
                }


                $_SESSION['cart_p_id'][$new_key] = $_REQUEST['id'];
                $_SESSION['cart_size_id'][$new_key] = $size_id;
                $_SESSION['cart_size_name'][$new_key] = $size_name;
                $_SESSION['cart_color_id'][$new_key] = $color_id;
                $_SESSION['cart_color_name'][$new_key] = $color_name;
                $_SESSION['cart_p_qty'][$new_key] = $_POST['p_qty'];
                $_SESSION['cart_p_current_price'][$new_key] = $_POST['p_current_price'];
                $_SESSION['cart_p_name'][$new_key] = $_POST['p_name'];
                $_SESSION['cart_p_featured_photo'][$new_key] = $_POST['p_featured_photo'];

                $successMsg1 = 'Sản phẩm được thêm vào giỏ hàng thành công!';
            }
        } else {

            if (isset($_POST['size_id'])) {

                $size_id = $_POST['size_id'];

                $query = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
                $query->execute(array($size_id));
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $size_name = $row['size_name'];
                }
            } else {
                $size_id = 0;
                $size_name = '';
            }

            if (isset($_POST['color_id'])) {
                $color_id = $_POST['color_id'];
                $query = $pdo->prepare("SELECT * FROM table_color WHERE color_id=?");
                $query->execute(array($color_id));
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $color_name = $row['color_name'];
                }
            } else {
                $color_id = 0;
                $color_name = '';
            }


            $_SESSION['cart_p_id'][1] = $_REQUEST['id'];
            $_SESSION['cart_size_id'][1] = $size_id;
            $_SESSION['cart_size_name'][1] = $size_name;
            $_SESSION['cart_color_id'][1] = $color_id;
            $_SESSION['cart_color_name'][1] = $color_name;
            $_SESSION['cart_p_qty'][1] = $_POST['p_qty'];
            $_SESSION['cart_p_current_price'][1] = $_POST['p_current_price'];
            $_SESSION['cart_p_name'][1] = $_POST['p_name'];
            $_SESSION['cart_p_featured_photo'][1] = $_POST['p_featured_photo'];

            $successMsg1 = 'Product is added to the cart successfully!';
        }
    endif;
}
?>

<?php
if ($errorMsg1 != '') {
    echo "<script>alert('" . $errorMsg1 . "')</script>";
}
if ($successMsg1 != '') {
    echo "<script>alert('" . $successMsg1 . "')</script>";
    header('location: product.php?id=' . $_REQUEST['id']);
}
?>


<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb mb_30">
                    <ul>
                        <li><a href="<?php echo BASE_URL; ?>">Trang chủ</a></li>
                        <li>></li>
                        <li><a
                                href="<?php echo BASE_URL . 'product-category.php?id=' . $tcat_id . '&type=top-category' ?>"><?php echo $tcat_name; ?></a>
                        </li>
                        <li>></li>
                        <li><a
                                href="<?php echo BASE_URL . 'product-category.php?id=' . $mcat_id . '&type=mid-category' ?>"><?php echo $mcat_name; ?></a>
                        </li>
                        <li>></li>
                        <li><a
                                href="<?php echo BASE_URL . 'product-category.php?id=' . $ecat_id . '&type=end-category' ?>"><?php echo $ecat_name; ?></a>
                        </li>
                        <li>></li>
                        <li><?php echo $p_name; ?></li>
                    </ul>
                </div>

                <div class="product">
                    <div class="row">
                        <div class="col-md-5">
                            <ul class="prod-slider">
                                <li
                                    style="background-image: url(assets/uploads/product_photos/<?php echo $p_featured_photo; ?>);">
                                    <a class="popup"
                                        href="assets/uploads/product_photos/<?php echo $p_featured_photo; ?>"></a>
                                </li>
                                <?php
                                $query = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
                                $query->execute(array($_REQUEST['id']));
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                <li
                                    style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>);">
                                    <a class="popup"
                                        href="assets/uploads/product_photos/<?php echo $row['photo']; ?>"></a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                            <div id="prod-pager">
                                <a data-slide-index="0" href="">
                                    <div class="prod-pager-thumb"
                                        style="background-image: url(assets/uploads/product_photos/<?php echo $p_featured_photo; ?>">
                                    </div>
                                </a>
                                <?php
                                $i = 1;
                                $query = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
                                $query->execute(array($_REQUEST['id']));
                                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $row) {
                                ?>
                                <a data-slide-index="<?php echo $i; ?>" href="">
                                    <div class="prod-pager-thumb"
                                        style="background-image: url(assets/uploads/product_photos/<?php echo $row['photo']; ?>">
                                    </div>
                                </a>
                                <?php
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="p-title">
                                <h1><?php echo $p_name; ?></h1>
                            </div>
                            <div class="p-review">
                                <div class="rating">
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
                            </div>
                            <div class="p-short-des">
                                <p>
                                    <?php echo $p_short_description; ?>
                                </p>
                            </div>
                            <form action="" method="post">
                                <div class="p-quantity">
                                    <div class="row">
                                        <?php if (isset($size)): ?>
                                        <div class="col-md-4 mb-3">
                                            <?php echo 'Chọn kích thước'; ?> <br>
                                            <select name="size_id" class="form-control select2" style="width:100%;">
                                                <?php
                                                    $query = $pdo->prepare("SELECT * FROM table_size");
                                                    $query->execute();
                                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        if (in_array($row['size_id'], $size)) {
                                                    ?>
                                                <option value="<?php echo $row['size_id']; ?>">
                                                    <?php echo $row['size_name']; ?>
                                                </option>
                                                <?php
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <?php endif; ?>

                                        <?php if (isset($color)): ?>
                                        <div class="col-md-4 mb-3">
                                            <?php echo 'Chọn màu'; ?> <br>
                                            <select name="color_id" class="form-control select2" style="width:100%;">
                                                <?php
                                                    $query = $pdo->prepare("SELECT * FROM table_color");
                                                    $query->execute();
                                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        if (in_array($row['color_id'], $color)) {
                                                    ?>
                                                <option value="<?php echo $row['color_id']; ?>">
                                                    <?php echo $row['color_name']; ?>
                                                </option>
                                                <?php
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <?php endif; ?>

                                        <div class="col-md-4 mb-3">
                                            <?php echo 'Số lượng'; ?> <br>
                                            <input type="number" class="form-control qty" step="1" min="1" name="p_qty"
                                                value="1" pattern="[0-9]*" inputmode="numeric">
                                        </div>
                                    </div>


                                </div>
                                <div class="p-price">
                                    <span style="font-size:20px; color: #000"><?php echo 'Giá sản phẩm'; ?></span><br>
                                    <span>
                                        <?php if ($p_old_price != ''): ?>
                                        <del><?php echo $p_old_price; ?><?php echo 'VND'; ?></del>
                                        <?php endif; ?>
                                        <?php echo $p_current_price; ?><?php echo 'VND'; ?>
                                    </span>
                                </div>
                                <div class="p-total-order">
                                    <span style="font-size: 16px; color: #555;">
                                        <?php echo 'Đã bán: '; ?>
                                        <strong style="color: #d9534f;"><?php echo $p_total_order; ?></strong> sản phẩm
                                    </span>
                                </div>
                                <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                                <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                                <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">

                                <div class="btn-cart btn-cart1">
                                    <input type="submit" value="<?php echo 'Thêm vào giỏ hàng'; ?>"
                                        name="form_add_to_cart">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description"
                                        aria-controls="description" role="tab"
                                        data-toggle="tab"><?php echo 'Mô tả sản phẩm'; ?></a></li>
                                <li role="presentation"><a href="#feature" aria-controls="feature" role="tab"
                                        data-toggle="tab"><?php echo 'Các đặc điểm'; ?></a></li>
                                <li role="presentation"><a href="#return_policy" aria-controls="return_policy"
                                        role="tab" data-toggle="tab"><?php echo 'Chính sách đổi trả'; ?></a></li>
                                <li role="presentation"><a href="#review" aria-controls="review" role="tab"
                                        data-toggle="tab"><?php echo 'Reviews'; ?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="description"
                                    style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_description == '') {
                                            echo 'Không có mô tả nào được tìm thấy';
                                        } else {
                                            echo $p_description;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="feature" style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_feature == '') {
                                            echo 'Không có đặc điểm nào được tìm thấy';
                                        } else {
                                            echo $p_feature;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="return_policy" style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_return_policy == '') {
                                            echo 'Không có chính sách đổi trả nào';
                                        } else {
                                            echo $p_return_policy;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="review" style="margin-top: -30px;">

                                    <div class="review-form">
                                        <?php
                                        $query = $pdo->prepare("SELECT * 
                                                            FROM table_rating t1 
                                                            JOIN table_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?");
                                        $query->execute(array($_REQUEST['id']));
                                        $total = $query->rowCount();
                                        ?>
                                        <h2><?php echo 'Reviews'; ?> (<?php echo $total; ?>)</h2>
                                        <?php
                                        if ($total) {
                                            $j = 0;
                                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                $j++;
                                        ?>
                                        <div class="mb_10"><b><u><?php echo 'Review'; ?>
                                                    <?php echo $j; ?></u></b>
                                        </div>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="width:170px;"><?php echo 'Tên khách hàng'; ?></th>
                                                <td><?php echo $row['cust_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo 'Bình luận'; ?></th>
                                                <td><?php echo $row['comment']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><?php echo 'Đánh giá'; ?></th>
                                                <td>
                                                    <div class="rating">
                                                        <?php
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                ?>
                                                        <?php if ($i > $row['rating']): ?>
                                                        <i class="fa fa-star-o"></i>
                                                        <?php else: ?>
                                                        <i class="fa fa-star"></i>
                                                        <?php endif; ?>
                                                        <?php
                                                                }
                                                                ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php
                                            }
                                        } else {
                                            echo 'Không có review nào';
                                        }
                                        ?>

                                        <h2><?php echo 'Đưa ra đánh giá'; ?></h2>
                                        <?php
                                        if ($errorMsg != '') {
                                            echo "<script>alert('" . $errorMsg . "')</script>";
                                        }
                                        if ($successMsg != '') {
                                            echo "<script>alert('" . $successMsg . "')</script>";
                                        }
                                        ?>
                                        <?php if (isset($_SESSION['customer'])): ?>

                                        <?php
                                            $query = $pdo->prepare("SELECT * 
                                                                FROM table_rating
                                                                WHERE p_id=? AND cust_id=?");
                                            $query->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
                                            $total = $query->rowCount();
                                            ?>
                                        <?php if ($total == 0): ?>
                                        <form action="" method="post">
                                            <div class="rating-section">
                                                <input type="radio" name="rating" class="rating" value="1" checked>
                                                <input type="radio" name="rating" class="rating" value="2" checked>
                                                <input type="radio" name="rating" class="rating" value="3" checked>
                                                <input type="radio" name="rating" class="rating" value="4" checked>
                                                <input type="radio" name="rating" class="rating" value="5" checked>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="comment" class="form-control" cols="30" rows="10"
                                                    placeholder="Write your comment (optional)"
                                                    style="height:100px;"></textarea>
                                            </div>
                                            <input type="submit" class="btn btn-default" name="form_review"
                                                value="<?php echo 'Gửi đánh giá'; ?>">
                                        </form>
                                        <?php else: ?>
                                        <span style="color:red;"><?php echo 'Bạn đã đưa ra đánh giá'; ?></span>
                                        <?php endif; ?>


                                        <?php else: ?>
                                        <p class="error">
                                            <?php echo 'Bạn phải đăng nhập để đánh giá'; ?> <br>
                                            <a href="login-customer.php"
                                                style="color:red;text-decoration: underline;"><?php echo 'Đăng nhập'; ?></a>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product bg-gray pt_70 pb_70">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="headline">
                    <h2><?php echo 'Các sản phẩm liên quan'; ?></h2>
                    <h3><?php echo 'Xem tất cả sản phẩm liên quan bên dưới'; ?></h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="product-carousel">

                    <?php
                    $query = $pdo->prepare("SELECT * FROM table_product WHERE ecat_id=? AND p_id!=?");
                    $query->execute(array($ecat_id, $_REQUEST['id']));
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>
                    <div class="item">
                        <div class="thumb">
                            <div class="photo"
                                style="background-image:url(assets/uploads/product_photos/<?php echo $row['p_featured_photo']; ?>);">
                            </div>
                            <div class="overlay"></div>
                        </div>
                        <div class="text">
                            <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
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
                            <p><a
                                    href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo 'Thêm vào giỏ hàng'; ?></a>
                            </p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>