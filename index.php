<?php require_once('header.php'); ?>

<?php
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

    <?php
    $querry = $pdo->prepare("SELECT * FROM table_slider");
    $querry->execute();
    $slides = $querry->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <!-- Chuyển các slider -->
    <ol class="carousel-indicators">
        <?php foreach ($slides as $index => $slide) : ?>
        <li data-target="#bootstrap-touch-slider" data-slide-to="<?= $index ?>"
            <?= $index == 0 ? 'class="active"' : '' ?>></li>
        <?php endforeach; ?>
    </ol>

    <!-- Wrapper cho các slider -->
    <div class="carousel-inner" role="listbox">
        <?php foreach ($slides as $index => $slide) : ?>
        <?php
            $position = strtolower($slide['position']); // Convert to lowercase
            $position_classes = [
                'left' => ['slide_style_left', 'zoomInLeft', 'fadeInLeft'],
                'center' => ['slide_style_center', 'flipInX', 'fadeInDown'],
                'right' => ['slide_style_right', 'zoomInRight', 'fadeInRight']
            ];
            $classes = $position_classes[$position] ?? ['slide_style_center', 'flipInX', 'fadeInDown']; // Default center
            ?>
        <div class="item <?= $index == 0 ? 'active' : '' ?>"
            style="background-image:url(assets/uploads/<?= $slide['photo'] ?>);">
            <div class="bs-slider-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="slide-text <?= $classes[0] ?>">
                        <h1 data-animation="animated <?= $classes[1] ?>"><?= $slide['heading'] ?></h1>
                        <p data-animation="animated <?= $classes[2] ?>"><?= nl2br($slide['content']) ?></p>
                        <a href="<?= $slide['button_url'] ?>" target="_blank" class="btn btn-primary"
                            data-animation="animated <?= $classes[2] ?>"><?= $slide['button_text'] ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
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