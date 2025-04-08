<?php require_once('header.php'); ?>
<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $footer_about = $row['footer_about'];
    $contact_email = $row['contact_email'];
    $contact_phone = $row['contact_phone'];
    $contact_address = $row['contact_address'];
    $footer_copyright = $row['footer_copyright'];
}
?>


<div class="footer-bottom">
    <div class="container">
        <div class="footer-top">
            <?php echo str_replace(['<p>', '</p>'], '', $footer_about); ?>
        </div>
        <div class="footer-info">
            <p>📍 Địa chỉ: <?php echo htmlspecialchars($contact_address); ?></p>
        </div>
        <div class="footer-info">
            <div class="footer-item">
                <p>📧 Email: <?php echo htmlspecialchars($contact_email); ?></p>
            </div>
            <div class="footer-item">
                <p>📞 Số điện thoại: <?php echo htmlspecialchars($contact_phone); ?></p>
            </div>
        </div>
        <div class="footer-bottom-info">
            <p>© <?php echo htmlspecialchars($footer_copyright); ?></p>
            <ul class="social">
                <?php
                $query = $pdo->prepare("SELECT * FROM table_social");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                ?>
                    <?php if ($row['social_url'] != ''): ?>
                        <li><a href="<?php echo $row['social_url']; ?>"><i
                                    class="<?php echo $row['social_icon']; ?>"></i></a></li>
                    <?php endif; ?>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <a href="#" class="scrollup">
        <i class="fa fa-angle-up"></i>
    </a>

    <script src="assets/js/jquery-2.2.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/megamenu.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/owl.animate.js"></script>
    <script src="assets/js/jquery.bxslider.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/rating.js"></script>
    <script src="assets/js/jquery.touchSwipe.min.js"></script>
    <script src="assets/js/bootstrap-touch-slider.js"></script>
    <script src="assets/js/select2.full.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>