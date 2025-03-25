<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['tcat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn danh mục cấp cao nhất<br>";
    }

    if (empty($_POST['mcat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn danh mục cấp trung<br>";
    }

    if (empty($_POST['ecat_id'])) {
        $valid = 0;
        $errorMsg .= "Bạn phải chọn danh mục cấp cuối<br>";
    }

    if (empty($_POST['p_name'])) {
        $valid = 0;
        $errorMsg .= "Tên sản phẩm không được để trống<br>";
    }

    if (empty($_POST['p_current_price'])) {
        $valid = 0;
        $errorMsg .= "Giá hiện tại không được để trống<br>";
    }

    if (empty($_POST['p_qty'])) {
        $valid = 0;
        $errorMsg .= "Số lượng không được để trống<br>";
    }

    $path = $_FILES['p_featured_photo']['name'];
    $temp_path = $_FILES['p_featured_photo']['temp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn phải tải lên tệp có định dạng jpg, jpeg, gif hoặc png<br>';
        }
    } else {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn một ảnh đại diện cho sản phẩm<br>';
    }

    if ($valid == 1) {

        $query = $pdo->prepare("SHOW TABLE STATUS LIKE 'table_product'");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        if (isset($_FILES['photo']["name"]) && isset($_FILES['photo']["temp_name"])) {
            $photo = array();
            $photo = $_FILES['photo']["name"];
            $photo = array_values(array_filter($photo));

            $photo_temp = array();
            $photo_temp = $_FILES['photo']["temp_name"];
            $photo_temp = array_values(array_filter($photo_temp));

            $query = $pdo->prepare("SHOW TABLE STATUS LIKE 'table_product_photo'");
            $query->execute();
            $result = $query->fetchAll();
            foreach ($result as $row) {
                $next_id1 = $row[10];
            }
            $z = $next_id1;

            $m = 0;
            for ($i = 0; $i < count($photo); $i++) {
                $my_ext1 = pathinfo($photo[$i], PATHINFO_EXTENSION);
                if ($my_ext1 == 'jpg' || $my_ext1 == 'png' || $my_ext1 == 'jpeg' || $my_ext1 == 'gif') {
                    $final_name1[$m] = $z . '.' . $my_ext1;
                    move_uploaded_file($photo_temp[$i], "../assets/uploads/product_photos/" . $final_name1[$m]);
                    $m++;
                    $z++;
                }
            }

            if (isset($final_name1)) {
                for ($i = 0; $i < count($final_name1); $i++) {
                    $query = $pdo->prepare("INSERT INTO table_product_photo (photo,p_id) VALUES (?,?)");
                    $query->execute(array($final_name1[$i], $ai_id));
                }
            }
        }

        $final_name = 'product-featured-' . $ai_id . '.' . $ext;
        move_uploaded_file($temp_path, '../assets/uploads/' . $final_name);

        // Lưu dữ liệu vào bảng sản phẩm chính table_product
        $query = $pdo->prepare("INSERT INTO table_product(
										p_name,
										p_old_price,
										p_current_price,
										p_qty,
										p_featured_photo,
										p_description,
										p_short_description,
										p_feature,
										p_condition,
										p_return_policy,
										p_total_view,
										p_is_featured,
										p_is_active,
										ecat_id
									) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $query->execute(array(
            $_POST['p_name'],
            $_POST['p_old_price'],
            $_POST['p_current_price'],
            $_POST['p_qty'],
            $final_name,
            $_POST['p_description'],
            $_POST['p_short_description'],
            $_POST['p_feature'],
            $_POST['p_condition'],
            $_POST['p_return_policy'],
            0,
            $_POST['p_is_featured'],
            $_POST['p_is_active'],
            $_POST['ecat_id']
        ));

        if (isset($_POST['size'])) {
            foreach ($_POST['size'] as $value) {
                $query = $pdo->prepare("INSERT INTO table_product_size (size_id,p_id) VALUES (?,?)");
                $query->execute(array($value, $ai_id));
            }
        }

        if (isset($_POST['color'])) {
            foreach ($_POST['color'] as $value) {
                $query = $pdo->prepare("INSERT INTO table_product_color (color_id,p_id) VALUES (?,?)");
                $query->execute(array($value, $ai_id));
            }
        }

        $successMsg = 'Sản phẩm đã được thêm thành công.';
    }
}

?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Tất cả sản phẩm</h1>
    </div>
    <div class="content-header-right">
        <a href="product.php" class="btn btn-primary btn-sm">Xem tất cả</a>
    </div>
</section>


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

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục cấp cao nhất
                                <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="tcat_id" class="form-control select2 top-cat">
                                    <option value="">Chọn danh mục cấp cao nhất</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_top_category ORDER BY tcat_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['tcat_id']; ?>"><?php echo $row['tcat_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục trung cấp <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="mcat_id" class="form-control select2 mid-cat">
                                    <option value="">Chọn danh mục trung cấp</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_mid_category ORDER BY mcat_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['mcat_id']; ?>"><?php echo $row['mcat_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục cuối <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="ecat_id" class="form-control select2 end-cat">
                                    <option value="">Chọn danh mục cuối</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_end_category ORDER BY ecat_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['ecat_id']; ?>"><?php echo $row['ecat_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên sản phẩm <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Giá cũ <br><span
                                    style="font-size:10px;font-weight:normal;">(Đơn vị: USD)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_old_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Giá hiện tại <span>*</span><br><span
                                    style="font-size:10px;font-weight:normal;">(Đơn vị: USD)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_current_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Số lượng <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_qty" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Chọn kích cỡ</label>
                            <div class="col-sm-4">
                                <select name="size[]" class="form-control select2" multiple="multiple">
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_size ORDER BY size_id ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['size_id']; ?>"><?php echo $row['size_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Chọn màu sắc</label>
                            <div class="col-sm-4">
                                <select name="color[]" class="form-control select2" multiple="multiple">
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_color ORDER BY color_id ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                        <option value="<?php echo $row['color_id']; ?>"><?php echo $row['color_name']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Ảnh nổi bật <span>*</span></label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <input type="file" name="p_featured_photo">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Ảnh khác</label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <input type="file" name="photo[]" style="margin-bottom:5px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea name="p_description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Thêm sản
                                    phẩm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>