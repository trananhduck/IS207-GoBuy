<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: index.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ không
    $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: index.php');
        exit;
    }
}
// Lặp qua mảng kết quả $result để lấy thông tin sản phẩm
foreach ($result as $row) {
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_condition = $row['p_condition'];
    $p_return_policy = $row['p_return_policy'];
    $p_total_view = $row['p_total_view'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}
//Lấy thông tin danh mục sản phẩm từ db
$querry = $pdo->prepare("SELECT
                        t1.ecat_id,t1.ecat_name,t1.mcat_id,
                        t2.mcat_id,t2.mcat_name,t2.tcat_id,
                        t3.tcat_id,t3.tcat_name

                        FROM table_end_category t1
                        JOIN table_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN table_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$querry->execute(array($ecat_id));
$total = $querry->rowCount();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);

// Lặp để lấy thông tin danh mục sản phẩm
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $mcat_name = $row['mcat_name'];
    $tcat_id = $row['tcat_id'];
    $tcat_name = $row['tcat_name'];
}

$p_total_view = $p_total_view + 1;

$querry = $pdo->prepare("UPDATE table_product SET p_total_view=? WHERE p_id=?");
$querry->execute(array($p_total_view, $_REQUEST['id']));

// Lấy danh sách kích thước và màu sắc sản phẩm từ database
$querry = $pdo->prepare("SELECT * FROM table_product_size WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $size[] = $row['size_id'];
}

$querry = $pdo->prepare("SELECT * FROM table_product_color WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $color[] = $row['color_id'];
}

// Xử lý đánh giá sản phẩm từ khách hàng

if (isset($_POST['form_review'])) {

    $querry = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=? AND cust_id=?");
    $querry->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
    $total = $querry->rowCount();

    if ($total) {
        $errorMsg = 'Bạn đã đánh giá';
    } else {
        $querry = $pdo->prepare("INSERT INTO table_rating (p_id,cust_id,comment,rating) VALUES (?,?,?,?)");
        $querry->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id'], $_POST['comment'], $_POST['rating']));
        $success_message = 'Đánh giá được ghi nhận';
    }
}

// Lấy xếp hạng trung bình của sản phẩm
$t_rating = 0;
$querry = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$tot_rating = $querry->rowCount();
if ($tot_rating == 0) {
    $avg_rating = 0;
} else {
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $t_rating = $t_rating + $row['rating'];
    }
    $avg_rating = $t_rating / $tot_rating;
}


//Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['form_add_to_cart'])) {

    // Lấy số lượng sản phẩm hiện có trong kho
    $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $querry->execute(array($_REQUEST['id']));
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $current_p_qty = $row['p_qty'];
    }
    if ($_POST['p_qty'] > $current_p_qty):
        $temp_msg = 'Xin lỗi, chỉ có' . $current_p_qty . 'sản phẩm trong kho';
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
                $errorMsg1 = 'Sản phẩm này đã được thêm vào giỏ hàng';
            } else {

                $i = 0;
                foreach ($_SESSION['cart_p_id'] as $key => $res) {
                    $i++;
                }
                $new_key = $i + 1;

                if (isset($_POST['size_id'])) {

                    $size_id = $_POST['size_id'];

                    $querry = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
                    $querry->execute(array($size_id));
                    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        $size_name = $row['size_name'];
                    }
                } else {
                    $size_id = 0;
                    $size_name = '';
                }

                if (isset($_POST['color_id'])) {
                    $color_id = $_POST['color_id'];
                    $querry = $pdo->prepare("SELECT * FROM table_color WHERE color_id=?");
                    $querry->execute(array($color_id));
                    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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

                $success_message1 = 'Product is added to the cart successfully!';
            }
        } else {

            if (isset($_POST['size_id'])) {

                $size_id = $_POST['size_id'];

                $querry = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
                $querry->execute(array($size_id));
                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $size_name = $row['size_name'];
                }
            } else {
                $size_id = 0;
                $size_name = '';
            }

            if (isset($_POST['color_id'])) {
                $color_id = $_POST['color_id'];
                $querry = $pdo->prepare("SELECT * FROM table_color WHERE color_id=?");
                $querry->execute(array($color_id));
                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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

            $success_message1 = 'Product is added to the cart successfully!';
        }
    endif;
}
?>

<?php
if ($errorMsg1 != '') {
    echo "<script>alert('" . $errorMsg1 . "')</script>";
}
if ($success_message1 != '') {
    echo "<script>alert('" . $success_message1 . "')</script>";
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

                                <li style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>);">
                                    <a class="popup" href="assets/uploads/<?php echo $p_featured_photo; ?>"></a>
                                </li>
                                <?php
                                $querry = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
                                $querry->execute(array($_REQUEST['id']));
                                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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
                                        style="background-image: url(assets/uploads/<?php echo $p_featured_photo; ?>">
                                    </div>
                                </a>
                                <?php
                                $i = 1;
                                $querry = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
                                $querry->execute(array($_REQUEST['id']));
                                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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
                                <h2><?php echo $p_name; ?></h2>
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

                                            <div class="col-md-12 mb_20">
                                                <?php echo 'Chọn kích thước' ?> <br>
                                                <select name="size_id" class="form-control select2" style="width:auto;">
                                                    <?php

                                                    $querry = $pdo->prepare("SELECT * FROM table_size");
                                                    $querry->execute();
                                                    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        if (in_array($row['size_id'], $size)) {
                                                    ?>
                                                            <option value="<?php echo $row['size_id']; ?>">
                                                                <?php echo $row['size_name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (isset($color)): ?>
                                            <div class="col-md-12">
                                                <?php echo 'Chọn màu' ?> <br>
                                                <select name="color_id" class="form-control select2" style="width:auto;">
                                                    <?php

                                                    $querry = $pdo->prepare("SELECT * FROM table_color");
                                                    $querry->execute();
                                                    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        if (in_array($row['color_id'], $color)) {
                                                    ?>

                                                            <option value="<?php echo $row['color_id']; ?>">
                                                                <?php echo $row['color_name']; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        <?php endif; ?>

                                    </div>

                                </div>
                                <div class="p-price">
                                    <span style="font-size:14px;"><?php echo 'Giá sản phẩm' ?></span><br>
                                    <span>
                                        <!--Gia cu-->
                                        <?php if ($p_old_price != ''): ?>
                                            <del><?php echo $p_old_price; ?><?php echo 'VND' ?></del>
                                        <?php endif; ?>
                                        <!--Gia moi-->
                                        <?php echo $p_current_price; ?><?php echo 'VND' ?>
                                    </span>
                                </div>
                                <input type="hidden" name="p_current_price" value="<?php echo $p_current_price; ?>">
                                <input type="hidden" name="p_name" value="<?php echo $p_name; ?>">
                                <input type="hidden" name="p_featured_photo" value="<?php echo $p_featured_photo; ?>">
                                <div class="p-quantity">
                                    <?php echo 'Số lượng' ?> <br>
                                    <input type="number" class="input-text qty" step="1" min="1" max="" name="p_qty"
                                        value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                                </div>
                                <div class="btn-cart btn-cart1">
                                    <input type="submit" value="<?php echo 'Thêm vào giỏ hàng' ?>"
                                        name="form_add_to_cart">
                                </div>
                            </form>
                            <div class="share">
                                <?php echo 'Chia sẻ sản phẩm này' ?> <br>
                                <div class="sharethis-inline-share-buttons"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#description"
                                        aria-controls="description" role="tab"
                                        data-toggle="tab"><?php echo 'Mô tả sản phẩm' ?></a></li>
                                <li role="presentation"><a href="#feature" aria-controls="feature" role="tab"
                                        data-toggle="tab"><?php echo 'Đặc điểm' ?></a></li>
                                <li role="presentation"><a href="#condition" aria-controls="condition" role="tab"
                                        data-toggle="tab"><?php echo 'Điều kiện' ?></a></li>
                                <li role="presentation"><a href="#return_policy" aria-controls="return_policy"
                                        role="tab" data-toggle="tab"><?php echo 'Chính sách đổi trả' ?></a></li>
                                <!-- <li role="presentation"><a href="#review" aria-controls="review" role="tab" data-toggle="tab"><?php echo 'Nhận xét' ?></a></li> -->
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="description"
                                    style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_description == '') {
                                            echo 'Không tìm thấy mô tả';
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
                                            echo 'Không tìm thấy đặc điểm';
                                        } else {
                                            echo $p_feature;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="condition" style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_condition == '') {
                                            echo 'Không tìm thấy điều kiện';
                                        } else {
                                            echo $p_condition;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="return_policy" style="margin-top: -30px;">
                                    <p>
                                        <?php
                                        if ($p_return_policy == '') {
                                            echo 'Không tìm thấy chính sách đổi trả';
                                        } else {
                                            echo $p_return_policy;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="review" style="margin-top: -30px;">

                                    <div class="review-form">
                                        <?php
                                        $querry = $pdo->prepare("SELECT * 
                                                            FROM table_rating t1 
                                                            JOIN table_customer t2 
                                                            ON t1.cust_id = t2.cust_id 
                                                            WHERE t1.p_id=?");
                                        $querry->execute(array($_REQUEST['id']));
                                        $total = $querry->rowCount();
                                        ?>
                                        <h2><?php echo 'Nhận xét' ?> (<?php echo $total; ?>)</h2>
                                        <?php
                                        if ($total) {
                                            $j = 0;
                                            $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result as $row) {
                                                $j++;
                                        ?>

                                                <div class="mb_10"><b><u><?php echo 'Nhận xét' ?>
                                                            <?php echo $j; ?></u></b>
                                                </div>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th style="width:170px;"><?php echo 'Tên khách hàng' ?></th>
                                                        <td><?php echo $row['cust_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo 'Bình luận' ?></th>
                                                        <td><?php echo $row['comment']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo 'Đánh giá' ?></th>
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
                                            echo 'Không tìm thấy nhận xét';
                                        }
                                        ?>

                                        <h2><?php echo 'Cho 1 nhận xét' ?></h2>
                                        <?php
                                        if ($errorMsg != '') {
                                            echo "<script>alert('" . $errorMsg . "')</script>";
                                        }
                                        if ($success_message != '') {
                                            echo "<script>alert('" . $success_message . "')</script>";
                                        }
                                        ?>
                                        <?php if (isset($_SESSION['customer'])): ?>

                                            <?php


                                            $querry = $pdo->prepare("SELECT * 
                                                                FROM table_rating
                                                                WHERE p_id=? AND cust_id=?");
                                            $querry->execute(array($_REQUEST['id'], $_SESSION['customer']['cust_id']));
                                            $total = $querry->rowCount();
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
                                                        value="<?php echo 'Nộp nhận xét' ?>">
                                                </form>
                                            <?php else: ?>
                                                <span style="color:red;"><?php echo 'Bạn đã đánh giá sản phẩm' ?></span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <p class="error">
                                                <?php echo 'Bạn phải đăng nhập để nhận xét' ?> <br>
                                                <a href="login.php"
                                                    style="color:red;text-decoration: underline;"><?php echo 'Đăng nhập' ?></a>
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
                    <h2><?php echo 'Những sản phẩm liên quan' ?></h2>
                    <h3><?php echo 'Xem những sản phẩm liên quan dưới đây' ?></h3>
                </div>
            </div>
        </div>
        <div class="ow">
            <div class="col-md-12">

                <div class="product-carousel">

                    <?php
                    $querry = $pdo->prepare("SELECT * FROM table_product WHERE ecat_id=? AND p_id!=?");
                    $querry->execute(array($ecat_id, $_REQUEST['id']));
                    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>

                        <div class="item">
                            <div class="thumb">
                                <div class="photo"
                                    style="background-image:url(assets/uploads/<?php echo $row['p_featured_photo']; ?>);">
                                </div>
                                <div class="overlay"></div>
                            </div>
                            <div class="text">
                                <h3><a href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo $row['p_name']; ?></a>
                                </h3>
                                <h4>
                                    <?php echo 'VND' ?><?php echo $row['p_current_price']; ?>
                                    <?php if ($row['p_old_price'] != ''): ?>
                                        <del>
                                            <?php echo 'VND' ?><?php echo $row['p_old_price']; ?>
                                        </del>
                                    <?php endif; ?>
                                </h4>
                                <div class="rating">
                                    <?php

                                    $t_rating = 0;
                                    $querry1 = $pdo->prepare("SELECT * FROM table_rating WHERE p_id=?");
                                    $querry1->execute(array($row['p_id']));
                                    $tot_rating = $querry1->rowCount();
                                    if ($tot_rating == 0) {
                                        $avg_rating = 0;
                                    } else {
                                        $result1 = $querry1->fetchAll(PDO::FETCH_ASSOC);
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
                                        href="product.php?id=<?php echo $row['p_id']; ?>"><?php echo 'Thêm vào giỏ hàng' ?></a>
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