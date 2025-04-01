<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['faq_title'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Tiêu đề không được để trống<br>');
            });
            </script>";
    }

    if (empty($_POST['faq_content'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Nội dung không được để trống<br>');
            });
            </script>";
    }

    if ($valid == 1) {
        $query = $pdo->prepare("INSERT INTO table_faq (faq_title,faq_content) VALUES (?,?)");
        $query->execute(array($_POST['faq_title'], $_POST['faq_content']));

        echo "<script>
            $(document).ready(function() {
                toastr.success('FAQ đã được thêm thành công!');
            });
        </script>";

        unset($_POST['faq_title']);
        unset($_POST['faq_content']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm FAQ</h1>
    </div>
    <div class="content-header-right">
        <a href="faq.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($errorMsg): ?>
            <div class="callout callout-danger">
                <p><?php echo $errorMsg; ?></p>
            </div>
            <?php endif; ?>

            <?php if ($successMsg): ?>
            <div class="callout callout-success">
                <p><?php echo $successMsg; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tiêu đề <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="faq_title" value="<?php if (isset($_POST['faq_title'])) {
                                                echo $_POST['faq_title'];
                                            } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nội dung <span>*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="faq_content" id="editor1" style="height:200px;"><?php if (isset($_POST['faq_content'])) {
                                                                echo $_POST['faq_content'];
                                                            } ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Gửi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>