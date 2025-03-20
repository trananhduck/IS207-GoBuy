<?php require_once('header.php'); ?>

<?php
// Lấy thông tin trang FAQ từ cơ sở dữ liệu
$query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $faq_title = $row['faq_title'];  // Tiêu đề trang FAQ
    $faq_banner = $row['faq_banner']; // Ảnh banner của trang FAQ
}
?>

<!-- Hiển thị banner trang FAQ -->
<div class="page-banner" style="background-image: url(assets/uploads/<?php echo $faq_banner; ?>);">
    <div class="inner">
        <h1><?php echo $faq_title; ?></h1> <!-- Tiêu đề trang FAQ -->
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel-group" id="faqAccordion">

                    <?php
                    // Lấy danh sách câu hỏi từ bảng table_faq
                    $query = $pdo->prepare("SELECT * FROM table_faq");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                    ?>
                        <div class="panel panel-default">
                            <!-- Tiêu đề câu hỏi, có thể mở rộng hoặc thu gọn -->
                            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse"
                                data-parent="#faqAccordion" data-target="#question<?php echo $row['faq_id']; ?>">
                                <h4 class="panel-title">
                                    Hỏi: <?php echo $row['faq_title']; ?>
                                    <!-- Tiêu đề câu hỏi -->
                                </h4>
                            </div>
                            <!-- Nội dung câu trả lời -->
                            <div id="question<?php echo $row['faq_id']; ?>" class="panel-collapse collapse"
                                style="height: 0px;">
                                <div class="panel-body">
                                    <h5><span class="label label-primary">Trả lời</span></h5>
                                    <p>
                                        <?php echo $row['faq_content']; ?>
                                        <!-- Nội dung câu trả lời -->
                                    </p>
                                </div>
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