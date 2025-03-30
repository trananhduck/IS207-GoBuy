<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $errorMsg = "";

    if (empty($_POST['tcat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục lớn<br>";
    }

    if (empty($_POST['mcat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục trung gian<br>";
    }

    if (empty($_POST['ecat_name'])) {
        $valid = 0;
        $errorMsg .= "Tên danh mục con không được để trống<br>";
    }

    if ($valid == 1) {
        // Tách các danh mục nhập vào theo dấu phẩy
        $ecat_names = explode(',', $_POST['ecat_name']);
        
        foreach ($ecat_names as $ecat_name) {
            $ecat_name = trim($ecat_name); // Xóa khoảng trắng thừa
            if (!empty($ecat_name)) {
                // Lưu từng danh mục vào database
                $query = $pdo->prepare("INSERT INTO table_end_category (ecat_name, mcat_id) VALUES (?, ?)");
                $query->execute([$ecat_name, $_POST['mcat_id']]);
            }
        }
        $successMsg = 'Các danh mục con đã được thêm thành công.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm danh mục con</h1>
    </div>
    <div class="content-header-right">
        <a href="end-category.php" class="btn btn-primary btn-sm">Thoát</a>
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
                        <?php
                        // Lấy danh sách danh mục lớn
                        $query = $pdo->prepare("SELECT * FROM table_top_category ORDER BY tcat_name ASC");
                        $query->execute();
                        $top_categories = $query->fetchAll(PDO::FETCH_ASSOC);

                        // Xác định giá trị tcat_id đã chọn (nếu có)
                        $tcat_id_selected = isset($_POST['tcat_id']) ? $_POST['tcat_id'] : "";

                        // Lấy danh sách danh mục trung gian theo tcat_id đã chọn
                        $mid_categories = [];
                        if ($tcat_id_selected !== "") {
                            $query = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id = ? ORDER BY mcat_name ASC");
                            $query->execute([$tcat_id_selected]);
                            $mid_categories = $query->fetchAll(PDO::FETCH_ASSOC);
                        }
                        ?>

                        <form method="post">
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Tên danh mục lớn
                                    <span>*</span></label>
                                <div class="col-sm-4">
                                    <select name="tcat_id" class="form-control select2 top-cat"
                                        onchange="this.form.submit()">
                                        <option value="">Chọn danh mục lớn</option>
                                        <?php foreach ($top_categories as $row) { ?>
                                        <option value="<?php echo $row['tcat_id']; ?>"
                                            <?php echo ($row['tcat_id'] == $tcat_id_selected) ? 'selected' : ''; ?>>
                                            <?php echo $row['tcat_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Tên danh mục trung gian
                                    <span>*</span></label>
                                <div class="col-sm-4">
                                    <select name="mcat_id" class="form-control select2 mid-cat">
                                        <option value="">Chọn danh mục trung gian</option>
                                        <?php foreach ($mid_categories as $row) { ?>
                                        <option value="<?php echo $row['mcat_id']; ?>">
                                            <?php echo $row['mcat_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục con <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ecat_name"
                                    placeholder="Nhập tên danh mục">
                                <small class="text-muted">Có thể nhập một hoặc nhiều danh mục cùng lúc. Nếu nhập
                                    nhiều,
                                    vui lòng phân tách bằng dấu phẩy (,).</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
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