<?php require_once('header.php'); ?>
<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_latest_product = $row['total_latest_product'];
    $total_popular_product = $row['total_popular_product'];
    $service_on_off = $row['service_on_off'];
    $latest_product_on_off = $row['latest_product_on_off'];
    $popular_product_on_off = $row['popular_product_on_off'];
}


?>

<div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel"
    data-pause="hover" data-interval="false">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        $query = $pdo->prepare("SELECT * FROM table_slider");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        ?>
            <li data-target="#bootstrap-touch-slider" data-slide-to="<?php echo $i; ?>" <?php if ($i == 0) {
                                                                                            echo 'class="active"';
                                                                                        } ?>></li>
        <?php
            $i++;
        }
        ?>
    </ol>

    <!-- Wrapper cho cac slides -->
    <div class="carousel-inner" role="listbox">

        <?php
        $i = 0;
        $query = $pdo->prepare("SELECT * FROM table_slider");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
        ?>
            <div class="item <?php if ($i == 0) {
                                    echo 'active';
                                } ?>" style="background-image:url(assets/uploads/<?php echo $row['photo']; ?>);">
                <div class="bs-slider-overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="slide-text <?php if ($row['position'] == 'Left') {
                                                    echo 'slide_style_left';
                                                } elseif ($row['position'] == 'Center') {
                                                    echo 'slide_style_center';
                                                } elseif ($row['position'] == 'Right') {
                                                    echo 'slide_style_right';
                                                } ?>">
                            <h1 data-animation="animated <?php if ($row['position'] == 'Left') {
                                                                echo 'zoomInLeft';
                                                            } elseif ($row['position'] == 'Center') {
                                                                echo 'flipInX';
                                                            } elseif ($row['position'] == 'Right') {
                                                                echo 'zoomInRight';
                                                            } ?>">
                                <?php echo $row['heading']; ?></h1>
                            <p data-animation="animated <?php if ($row['position'] == 'Left') {
                                                            echo 'fadeInLeft';
                                                        } elseif ($row['position'] == 'Center') {
                                                            echo 'fadeInDown';
                                                        } elseif ($row['position'] == 'Right') {
                                                            echo 'fadeInRight';
                                                        } ?>">
                                <?php echo nl2br($row['content']); ?></p>
                            <a href="<?php echo $row['button_url']; ?>" target="_blank" class="btn btn-slider"
                                data-animation="animated <?php if ($row['position'] == 'Left') {
                                                                echo 'fadeInLeft';
                                                            } elseif ($row['position'] == 'Center') {
                                                                echo 'fadeInDown';
                                                            } elseif ($row['position'] == 'Right') {
                                                                echo 'fadeInRight';
                                                            } ?>"><?php echo $row['button_text']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            $i++;
        }
        ?>
    </div>

    <!-- Điều hướng Slider trái -->
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Trước</span>
    </a>

    <!-- Điều hướng Slider phải -->
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Sau</span>
    </a>

</div>


<?php if ($service_on_off == 1): ?>
    <div class="service pt_70 pb_70">
        <div class="container">
            <div class="row">
                <?php
                $query = $pdo->prepare("SELECT * FROM table_service");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                ?>
                    <div class="col-md-3">
                        <div class="item">
                            <div class="photo"><img src="assets/uploads/<?php echo $row['photo']; ?>" width="150px"
                                    alt="<?php echo $row['title']; ?>"></div>
                            <h3><?php echo $row['title']; ?></h3>
                            <p>
                                <?php echo nl2br($row['content']); ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($popular_product_on_off == 1): ?>
    <div class="product bg-gray pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $popular_product_title; ?></h2>
                        <h3><?php echo $popular_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $query = $pdo->prepare("SELECT * FROM table_product WHERE p_is_active=? ORDER BY p_total_order DESC LIMIT " . $total_popular_product);
                        $query->execute(array(1));
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
                                                    <?php echo number_format($row['p_old_price'], 0, ',', ','); ?><span class="vnd">
                                                        VND</span>
                                                </del>
                                            <?php endif; ?>
                                        </span>
                                        <span>
                                            <?php echo number_format($row['p_current_price'], 0, ',', ','); ?><span class="vnd">
                                                VND</span>
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
                                                $t_rating += $row1['rating'];
                                            }
                                            $avg_rating = $t_rating / $tot_rating;
                                        }

                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $avg_rating) {
                                                echo '<i class="fa fa-star rated"></i>';
                                            } elseif ($i - 0.5 <= $avg_rating) {
                                                echo '<i class="fa fa-star-half-o rated"></i>';
                                            } else {
                                                echo '<i class="fa fa-star-o"></i>';
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
                                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                Xem sản phẩm</a></p>
                                    <?php endif; ?>
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
<?php endif; ?>

<?php if ($latest_product_on_off == 1): ?>
    <div class="product pt_70 pb_30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $latest_product_title; ?></h2>
                        <h3><?php echo $latest_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $query = $pdo->prepare("SELECT * FROM table_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT " . $total_latest_product);
                        $query->execute(array(1));
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
                                                    <?php echo number_format($row['p_old_price'], 0, ',', ','); ?><span class="vnd">
                                                        VND</span>
                                                </del>
                                            <?php endif; ?>
                                        </span>
                                        <span>
                                            <?php echo number_format($row['p_current_price'], 0, ',', ','); ?><span class="vnd">
                                                VND</span>
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
                                                $t_rating += $row1['rating'];
                                            }
                                            $avg_rating = $t_rating / $tot_rating;
                                        }

                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $avg_rating) {
                                                echo '<i class="fa fa-star rated"></i>';
                                            } elseif ($i - 0.5 <= $avg_rating) {
                                                echo '<i class="fa fa-star-half-o rated"></i>';
                                            } else {
                                                echo '<i class="fa fa-star-o"></i>';
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
                                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>">
                                                Xem sản phẩm</a></p>
                                    <?php endif; ?>
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
<?php endif; ?>






<?php require_once('footer.php'); ?>


<!-- Toast Container -->
<div id="toast"></div>
<style>
    #toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #333;
        color: #fff;
        padding: 15px 25px;
        border-radius: 8px;
        opacity: 0;
        transition: opacity 0.5s ease, transform 0.5s ease;
        z-index: 9999;
        transform: translateY(-20px);
    }

    #toast.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    function showToast(message, bg = "#333") {
        const toast = document.getElementById("toast");
        toast.innerText = message;
        toast.style.backgroundColor = bg;
        toast.classList.add("show");
        setTimeout(() => toast.classList.remove("show"), 4000);
    }
</script>

<?php
if (isset($_SESSION['success_message'])) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
        showToast(" . json_encode($_SESSION['success_message']) . ", '#2ecc71');
    });</script>";
    unset($_SESSION['success_message']);
}
?>

<?php require_once('footer.php'); ?>