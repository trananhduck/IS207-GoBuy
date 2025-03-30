<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $sizeNames = explode(',', $_POST['size_name']); // Tách các kích thước theo dấu phẩy
    $sizeNames = array_map('trim', $sizeNames); // Loại bỏ khoảng trắng hai bên

    $errorMsg = "";
    $successMsg = "";
    $insertedSizes = [];

    foreach ($sizeNames as $size) {
        if (empty($size)) {
            $valid = 0;
            $errorMsg .= "Tên kích thước không được để trống<br>";
            continue;
        }

        // Kiểm tra kích thước trùng lặp
        $query = $pdo->prepare("SELECT * FROM table_size WHERE size_name=?");
        $query->execute(array($size));
        $total = $query->rowCount();
        if ($total) {
            $valid = 0;
            $errorMsg .= "Tên kích thước '$size' đã tồn tại<br>";
            continue;
        }

        if ($valid == 1) {
            // Lưu dữ liệu vào bảng table_size
            $query = $pdo->prepare("INSERT INTO table_size (size_name) VALUES (?)");
            $query->execute(array($size));
            $insertedSizes[] = $size;
        }
    }

    if (!empty($insertedSizes)) {
        $successMsg = 'Các kích thước sau đã được thêm thành công: ' . implode(', ', $insertedSizes);
    }
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm kích thước</h1>
    </div>
    <div class="content-header-right">
        <a href="size.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (!empty($errorMsg)): ?>
            <div class="callout callout-danger">
                <p>
                    <?php echo $errorMsg; ?>
                </p>
            </div>
            <?php endif; ?>

            <?php if (!empty($successMsg)): ?>
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
                                    placeholder="Nhập một hoặc nhiều kích thước, cách nhau bằng dấu phẩy">
                                <small class="text-muted">Có thể nhập một hoặc nhiều kích thước cùng lúc. Nếu nhập
                                    nhiều,
                                    vui lòng phân tách bằng dấu phẩy (,).</small>
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