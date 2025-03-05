<?php require_once('header.php'); ?>

<?php
$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
$querry = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$querry->execute();
$result = $querry->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    $cta_title = $row['cta_title'];
    $cta_content = $row['cta_content'];
    $cta_read_more_text = $row['cta_read_more_text'];
    $cta_read_more_url = $row['cta_read_more_url'];
    $cta_photo = $row['cta_photo'];
    $featured_product_title = $row['featured_product_title'];
    $featured_product_subtitle = $row['featured_product_subtitle'];
    $latest_product_title = $row['latest_product_title'];
    $latest_product_subtitle = $row['latest_product_subtitle'];
    $popular_product_title = $row['popular_product_title'];
    $popular_product_subtitle = $row['popular_product_subtitle'];
    $total_featured_product_home = $row['total_featured_product_home'];
    $total_latest_product_home = $row['total_latest_product_home'];
    $total_popular_product_home = $row['total_popular_product_home'];
    $home_service_on_off = $row['home_service_on_off'];
    $home_welcome_on_off = $row['home_welcome_on_off'];
    $home_featured_product_on_off = $row['home_featured_product_on_off'];
    $home_latest_product_on_off = $row['home_latest_product_on_off'];
    $home_popular_product_on_off = $row['home_popular_product_on_off'];
}

?>

<div id="bootstrap-touch-slider" class="carousel bs-slider fade control-round indicators-line" data-ride="carousel"
    data-pause="hover" data-interval="false">

    <!-- Chuyển các slider -->
    <ol class="carousel-indicators">
        <?php
        $i = 0;
        $querry = $pdo->prepare("SELECT * FROM table_slider");
        $querry->execute();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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

    <!-- Wrapper cho các slider -->
    <div class="carousel-inner" role="listbox">

        <?php
        $i = 0;
        $querry = $pdo->prepare("SELECT * FROM table_slider");
        $querry->execute();
        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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
                            <a href="<?php echo $row['button_url']; ?>" target="_blank" class="btn btn-primary"
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

    <!-- chuyển qua slider trái -->
    <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
        <span class="fa fa-angle-left" aria-hidden="true"></span>
        <span class="sr-only">Trước</span>
    </a>

    <!-- Chuyển qua slider phải -->
    <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
        <span class="fa fa-angle-right" aria-hidden="true"></span>
        <span class="sr-only">Sau</span>
    </a>

</div>

<?php if ($home_service_on_off == 1): ?>
    <div class="service bg-gray">
        <div class="container">
            <div class="row">
                <?php
                $querry = $pdo->prepare("SELECT * FROM table_service");
                $querry->execute();
                $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                ?>
                    <div class="col-md-4">
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


<?php if ($home_featured_product_on_off == 1): ?>
    <div class="product pt_70 pb_70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="headline">
                        <h2><?php echo $featured_product_title; ?></h2>
                        <h3><?php echo $featured_product_subtitle; ?></h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="product-carousel">

                        <?php
                        $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_is_featured=? AND p_is_active=? LIMIT " . $total_featured_product_home);
                        $querry->execute(array(1, 1));
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
                                        <?php if (!empty($row['p_old_price'])): ?>
                                            <del>
                                                <?php echo number_format($row['p_old_price']) ?><?php echo ' VND' ?>
                                            </del>
                                        <?php endif; ?>
                                        <?php echo number_format($row['p_current_price']) ?><?php echo ' VND' ?>
                                    </h4>


                                    <?php if ($row['p_qty'] == 0): ?>
                                        <div class="out-of-stock">
                                            <div class="inner">
                                                Hết hàng
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i>
                                                Thêm vào giỏ hàng</a></p>
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


<?php if ($home_latest_product_on_off == 1): ?>
    <div class="product bg-gray pt_70 pb_30">
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
                        $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_is_active=? ORDER BY p_id DESC LIMIT " . $total_latest_product_home);
                        $querry->execute(array(1));
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
                                        <?php if (!empty($row['p_old_price'])): ?>
                                            <del>
                                                <?php echo number_format($row['p_old_price']) ?><?php echo ' VND' ?>
                                            </del>
                                        <?php endif; ?>
                                        <?php echo number_format($row['p_current_price']) ?><?php echo ' VND' ?>
                                    </h4>


                                    <?php if ($row['p_qty'] == 0): ?>
                                        <div class="out-of-stock">
                                            <div class="inner">
                                                Hết hàng
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p><a href="product.php?id=<?php echo $row['p_id']; ?>"><i class="fa fa-shopping-cart"></i>
                                                Thêm vào giỏ hàng</a></p>
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