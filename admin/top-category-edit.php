<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['tcat_name'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Tên danh mục lớn không được để trống<br>');
            });
            </script>";
    } else {
        // Kiểm tra trùng lặp danh mục lớn
        // Lấy tên danh mục lớn hiện tại trong cơ sở dữ liệu
        $query = $pdo->prepare("SELECT * FROM table_top_category WHERE tcat_id=?");
        $query->execute(array($_REQUEST['id']));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $current_tcat_name = $row['tcat_name'];
        }

        $query = $pdo->prepare("SELECT * FROM table_top_category WHERE tcat_name=? and tcat_name!=?");
        $query->execute(array($_POST['tcat_name'], $current_tcat_name));
        $total = $query->rowCount();
        if ($total) {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Tên danh mục lớn đã tồn tại<br>');
            });
            </script>";
        }
    }

    if ($valid == 1) {
        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_top_category SET tcat_name=?,show_on_menu=? WHERE tcat_id=?");
        $query->execute(array($_POST['tcat_name'], $_POST['show_on_menu'], $_REQUEST['id']));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Danh mục lớn đã được cập nhật thành công.');
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
    // Kiểm tra id hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_top_category WHERE tcat_id=?");
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
        <h1>Chỉnh sửa danh mục lớn</h1>
    </div>
    <div class="content-header-right">
        <a href="top-category.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>


<?php
foreach ($result as $row) {
    $tcat_name = $row['tcat_name'];
    $show_on_menu = $row['show_on_menu'];
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
                            <label for="" class="col-sm-2 control-label">Tên danh mục lớn <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tcat_name"
                                    value="<?php echo $tcat_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hiển thị trên menu? <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="show_on_menu" class="form-control" style="width:auto;">
                                    <option value="0" <?php if ($show_on_menu == 0) {
                                                            echo 'selected';
                                                        } ?>>Không</option>
                                    <option value="1" <?php if ($show_on_menu == 1) {
                                                            echo 'selected';
                                                        } ?>>Có</option>
                                </select>
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
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