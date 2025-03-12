<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    // Kiểm tra nếu tên danh mục cấp cao bị bỏ trống
    if (empty($_POST['tcat_name'])) {
        $valid = 0;
        $errorMsg .= "Tên danh mục cấp cao không được để trống<br>";
    } else {
        // Kiểm tra danh mục trùng lặp
        $querry = $pdo->prepare("SELECT * FROM tbl_top_category WHERE tcat_name=?");
        $querry->execute(array($_POST['tcat_name']));
        $total = $querry->rowCount();
        if ($total) {
            $valid = 0;
            $errorMsg .= "Tên danh mục cấp cao đã tồn tại<br>";
        }
    }

    // Nếu không có lỗi, tiến hành thêm vào cơ sở dữ liệu
    if ($valid == 1) {
        $querry = $pdo->prepare("INSERT INTO tbl_top_category (tcat_name,show_on_menu) VALUES (?,?)");
        $querry->execute(array($_POST['tcat_name'], $_POST['show_on_menu']));

        $successMsg = 'Danh mục cấp cao đã được thêm thành công.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm danh mục cấp cao</h1>
    </div>
    <div class="content-header-right">
        <a href="top-category.php" class="btn btn-primary btn-sm">Xem tất cả</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if ($errorMsg): ?>
                <div class="callout callout-danger">
                    <p><?php echo $errorMsg; ?></p>
                </div>
            <?php endif; ?>

            <!-- Hiển thị thông báo thành công nếu có -->
            <?php if ($successMsg): ?>
                <div class="callout callout-success">
                    <p><?php echo $successMsg; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">

                        <!-- Nhập tên danh mục cấp cao -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tên danh mục cấp cao <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tcat_name">
                            </div>
                        </div>

                        <!-- Lựa chọn có hiển thị trên menu không -->
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hiển thị trên menu? <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="show_on_menu" class="form-control" style="width:auto;">
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nút gửi form -->
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