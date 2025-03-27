<?php require_once('header.php'); ?>
<?php
$statement = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
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
            <div class="footer-item">
                <p>📍 Địa chỉ: <?php echo htmlspecialchars($contact_address); ?></p>
            </div>
            <div class="footer-item">
                <p>📧 Email: <?php echo htmlspecialchars($contact_email); ?></p>
            </div>
        </div>
        <div class="footer-bottom-info">
            <p>📞 Số điện thoại: <?php echo htmlspecialchars($contact_phone); ?></p>
            <p>© <?php echo htmlspecialchars($footer_copyright); ?></p>
        </div>
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