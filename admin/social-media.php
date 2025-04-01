<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    // Cập nhật URL mạng xã hội vào cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_social SET social_url=? WHERE social_name=?");
    $query->execute(array($_POST['facebook'], 'Facebook'));

    $query = $pdo->prepare("UPDATE table_social SET social_url=? WHERE social_name=?");
    $query->execute(array($_POST['twitter'], 'Twitter'));

    $query = $pdo->prepare("UPDATE table_social SET social_url=? WHERE social_name=?");
    $query->execute(array($_POST['youtube'], 'YouTube'));

    $query = $pdo->prepare("UPDATE table_social SET social_url=? WHERE social_name=?");
    $query->execute(array($_POST['instagram'], 'Instagram'));

    echo "<script>
            $(document).ready(function() {
                toastr.success('Các URL mạng xã hội đã được cập nhật thành công.');
            });
        </script>";
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Mạng Xã Hội</h1>
    </div>
</section>

<?php
// Lấy dữ liệu mạng xã hội từ cơ sở dữ liệu
$query = $pdo->prepare("SELECT * FROM table_social");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    if ($row['social_name'] == 'Facebook') {
        $facebook = $row['social_url'];
    }
    if ($row['social_name'] == 'Twitter') {
        $twitter = $row['social_url'];
    }
    if ($row['social_name'] == 'YouTube') {
        $youtube = $row['social_url'];
    }
    if ($row['social_name'] == 'Instagram') {
        $instagram = $row['social_url'];
    }
}
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if ($errorMsg): ?>
            <div class="callout callout-danger">
                <p>
                    <?php echo $errorMsg; ?>
                </p>
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
                        <p style="padding-bottom: 20px;">Nếu bạn không muốn hiển thị một mạng xã hội trên trang giao
                            diện người dùng, chỉ cần để trống ô nhập.</p>

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Facebook </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="facebook"
                                    value="<?php echo $facebook; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Twitter </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="twitter" value="<?php echo $twitter; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">YouTube </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="youtube" value="<?php echo $youtube; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Instagram </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="instagram"
                                    value="<?php echo $instagram; ?>">
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