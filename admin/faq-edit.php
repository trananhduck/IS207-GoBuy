<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['faq_title'])) {
        $valid = 0;
        $errorMsg .= 'Tiêu đề không được để trống<br>';
    }

    if (empty($_POST['faq_content'])) {
        $valid = 0;
        $errorMsg .= 'Nội dung không được để trống<br>';
    }

    if ($valid == 1) {
        $query = $pdo->prepare("UPDATE table_faq SET faq_title=?, faq_content=? WHERE faq_id=?");
        $query->execute(array($_POST['faq_title'], $_POST['faq_content'], $_REQUEST['id']));

        $successMsg = 'FAQ đã được cập nhật thành công!';
    }
}
?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem id có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_faq WHERE faq_id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Chỉnh sửa FAQ</h1>
    </div>
    <div class="content-header-right">
        <a href="faq.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>

<?php
$query = $pdo->prepare("SELECT * FROM table_faq WHERE faq_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $faq_title = $row['faq_title'];
    $faq_content = $row['faq_content'];
}
?>

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
                                <input type="text" autocomplete="off" class="form-control" name="faq_title"
                                    value="<?php echo $faq_title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nội dung <span>*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="faq_content" id="editor1"
                                    style="height:140px;"><?php echo $faq_content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>