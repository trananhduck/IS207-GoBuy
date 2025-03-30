<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['tcat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục lớn<br>";
    }

    if (empty($_POST['mcat_names'])) {
        $valid = 0;
        $errorMsg .= "Tên danh mục trung gian không được để trống<br>";
    }

    if ($valid == 1) {
        $mcat_names = explode(',', $_POST['mcat_names']); // Tách danh sách tên danh mục

        foreach ($mcat_names as $mcat_name) {
            $mcat_name = trim($mcat_name); // Xóa khoảng trắng thừa
            if (!empty($mcat_name)) {
                $query = $pdo->prepare("INSERT INTO table_mid_category (mcat_name, tcat_id) VALUES (?, ?)");
                $query->execute(array($mcat_name, $_POST['tcat_id']));
            }
        }

        $successMsg = 'Danh mục trung gian đã được thêm thành công.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm Danh Mục trung gian</h1>
    </div>
    <div class="content-header-right">
        <a href="mid-category.php" class="btn btn-primary btn-sm">Thoát</a>
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
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục lớn <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="tcat_id" class="form-control select2">
                                    <option value="">Chọn danh mục lớn</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_top_category ORDER BY tcat_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        echo "<option value='" . $row['tcat_id'] . "'>" . $row['tcat_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục trung gian <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="mcat_names"
                                    placeholder="Nhập tên danh mục">
                                <small class="text-muted">Có thể nhập một hoặc nhiều danh mục cùng lúc. Nếu nhập
                                    nhiều,
                                    vui lòng phân tách bằng dấu phẩy (,).</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Xác Nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>