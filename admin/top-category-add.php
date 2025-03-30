<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $errorMsg = "";
    $successMsg = "";

    // Lấy danh sách danh mục lớn từ input, tách thành mảng
    $tcat_names = array_map('trim', explode(',', $_POST['tcat_name']));

    if (empty($tcat_names)) {
        $valid = 0;
        $errorMsg .= "Vui lòng nhập ít nhất một danh mục lớn.<br>";
    }

    if ($valid == 1) {
        $inserted = 0;
        foreach ($tcat_names as $tcat_name) {
            if ($tcat_name == "") {
                continue;
            }

            // Kiểm tra danh mục trùng lặp
            $query = $pdo->prepare("SELECT * FROM table_top_category WHERE tcat_name=?");
            $query->execute(array($tcat_name));
            $total = $query->rowCount();

            if ($total == 0) {
                // Thêm danh mục vào cơ sở dữ liệu nếu chưa tồn tại
                $query = $pdo->prepare("INSERT INTO table_top_category (tcat_name, show_on_menu) VALUES (?,?)");
                $query->execute(array($tcat_name, $_POST['show_on_menu']));
                $inserted++;
            } else {
                $errorMsg .= "Danh mục '$tcat_name' đã tồn tại.<br>";
            }
        }

        if ($inserted > 0) {
            $successMsg = "$inserted danh mục lớn đã được thêm thành công.";
        }
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm danh mục lớn</h1>
    </div>
    <div class="content-header-right">
        <a href="top-category.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (!empty($errorMsg)): ?>
                <div class="callout callout-danger">
                    <p><?php echo $errorMsg; ?></p>
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

                        <!-- Nhập danh mục lớn -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tên danh mục lớn <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="tcat_name"
                                    placeholder="Nhập tên danh mục">
                                <small class="text-muted">Có thể nhập một hoặc nhiều danh mục cùng lúc. Nếu nhập
                                    nhiều,
                                    vui lòng phân tách bằng dấu phẩy (,).</small>
                            </div>
                        </div>

                        <!-- Hiển thị trên menu -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hiển thị trên menu? <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="show_on_menu" class="form-control" style="width:auto;">
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                            </div>
                        </div>
                        <!-- Nút gửi -->
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