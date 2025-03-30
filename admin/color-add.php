<?php require_once('header.php'); ?>
<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['color_name'])) {
        $valid = 0;
        $errorMsg .= "Tên màu không được để trống<br>";
    } else {
        $color_names = explode(',', $_POST['color_name']); // Tách chuỗi thành mảng các màu
        $color_names = array_map('trim', $color_names); // Xóa khoảng trắng dư thừa

        foreach ($color_names as $color) {
            if ($color == '') continue;
            // Kiểm tra trùng lặp tên màu
            $query = $pdo->prepare("SELECT * FROM table_color WHERE color_name=?");
            $query->execute(array($color));
            $total = $query->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= "Tên màu '$color' đã tồn tại<br>";
            }
        }
    }

    if ($valid == 1) {
        foreach ($color_names as $color) {
            if ($color == '') continue;
            // Lưu dữ liệu vào bảng table_color
            $query = $pdo->prepare("INSERT INTO table_color (color_name) VALUES (?)");
            $query->execute(array($color));
        }

        $successMsg = 'Màu đã được thêm thành công.';
    }
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm màu</h1>
    </div>
    <div class="content-header-right">
        <a href="color.php" class="btn btn-primary btn-sm">Thoát</a>
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
                            <label for="" class="col-sm-2 control-label">Tên màu <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="color_name"
                                    placeholder="Nhập một hoặc nhiều màu, cách nhau bằng dấu phẩy">
                                <small class="text-muted">Có thể nhập một hoặc nhiều màu cùng lúc. Nếu nhập nhiều màu
                                    cùng lúc, vui lòng phân tách bằng dấu phẩy (,).</small>
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