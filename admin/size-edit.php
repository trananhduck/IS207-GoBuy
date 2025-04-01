<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['size_name'])) {
        $valid = 0;
        $errorMsg .= "Tên kích thước không được để trống<br>";
    } else {
        // Kiểm tra kích thước trùng lặp
        // Lấy tên kích thước hiện tại trong cơ sở dữ liệu
        $query = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
        $query->execute(array($_REQUEST['id']));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $current_size_name = $row['size_name'];
        }

        $query = $pdo->prepare("SELECT * FROM table_size WHERE size_name=? and size_name!=?");
        $query->execute(array($_POST['size_name'], $current_size_name));
        $total = $query->rowCount();
        if ($total) {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Tên kích thước đã tồn tại<br>');
            });
            </script>";
        }
    }

    if ($valid == 1) {
        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_size SET size_name=? WHERE size_id=?");
        $query->execute(array($_POST['size_name'], $_REQUEST['id']));

        echo "<script>
            $(document).ready(function() {
                toastr.success('Kích thước đã được cập nhật thành công.');
            });
        </script>";
    }
}
?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra ID có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_size WHERE size_id=?");
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
        <h1>Chỉnh Sửa Kích Thước</h1>
    </div>
    <div class="content-header-right">
        <a href="size.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>
<?php
foreach ($result as $row) {
    $size_name = $row['size_name'];
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
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tên Kích Thước <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="size_name"
                                    value="<?php echo $size_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Cập Nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác Nhận Xóa</h4>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa mục này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>