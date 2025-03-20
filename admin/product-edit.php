<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {  // Kiểm tra xem biểu mẫu có được gửi hay không
    $valid = 1; // Biến kiểm tra tính hợp lệ của dữ liệu đầu vào

    if (empty($_POST['tcat_id'])) {  // Kiểm tra xem danh mục cấp cao đã được chọn chưa
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục cấp cao<br>";
    }

    if (empty($_POST['mcat_id'])) {  // Kiểm tra xem danh mục cấp trung đã được chọn chưa
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục cấp trung<br>";
    }

    if (empty($_POST['ecat_id'])) {  // Kiểm tra xem danh mục cấp cuối đã được chọn chưa
        $valid = 0;
        $errorMsg .= "Bạn phải chọn một danh mục cấp cuối<br>";
    }

    if (empty($_POST['p_name'])) {  // Kiểm tra xem tên sản phẩm có bị trống không
        $valid = 0;
        $errorMsg .= "Tên sản phẩm không được để trống<br>";
    }

    if (empty($_POST['p_current_price'])) {  // Kiểm tra xem giá hiện tại có bị trống không
        $valid = 0;
        $errorMsg .= "Giá hiện tại không được để trống<br>";
    }

    if (empty($_POST['p_qty'])) {  // Kiểm tra xem số lượng có bị trống không
        $valid = 0;
        $errorMsg .= "Số lượng không được để trống<br>";
    }

    $path = $_FILES['p_featured_photo']['name']; // Lấy tên tệp ảnh sản phẩm nổi bật
    $path_tmp = $_FILES['p_featured_photo']['tmp_name']; // Lấy đường dẫn tạm thời của ảnh

    if ($path != '') {  // Nếu có tệp ảnh được tải lên
        $ext = pathinfo($path, PATHINFO_EXTENSION); // Lấy phần mở rộng của tệp
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') { // Kiểm tra định dạng ảnh hợp lệ
            $valid = 0;
            $errorMsg .= 'Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {  // Nếu dữ liệu hợp lệ
        if (isset($_FILES['photo']["name"]) && isset($_FILES['photo']["tmp_name"])) {
            // Nếu có ảnh sản phẩm bổ sung được tải lên

            $photo = array();
            $photo = $_FILES['photo']["name"]; // Lấy danh sách tên tệp ảnh
            $photo = array_values(array_filter($photo)); // Lọc bỏ các phần tử rỗng

            $photo_temp = array();
            $photo_temp = $_FILES['photo']["tmp_name"]; // Lấy danh sách đường dẫn tạm thời của ảnh
            $photo_temp = array_values(array_filter($photo_temp));

            // Lấy ID sản phẩm tiếp theo từ bảng table_product_photo
            $query = $pdo->prepare("SHOW TABLE STATUS LIKE 'table_product_photo'");
            $query->execute();
            $result = $query->fetchAll();
            foreach ($result as $row) {
                $next_id1 = $row[10];
            }
            $z = $next_id1;

            // Xử lý từng ảnh sản phẩm bổ sung
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

            // Lưu ảnh vào database
            if (isset($final_name1)) {
                for ($i = 0; $i < count($final_name1); $i++) {
                    $query = $pdo->prepare("INSERT INTO table_product_photo (photo,p_id) VALUES (?,?)");
                    $query->execute(array($final_name1[$i], $_REQUEST['id']));
                }
            }
        }

        if ($path == '') {  // Nếu không có ảnh sản phẩm nổi bật mới
            $query = $pdo->prepare("UPDATE table_product SET 
                                    p_name=?, 
                                    p_old_price=?, 
                                    p_current_price=?, 
                                    p_qty=?,
                                    p_description=?,
                                    p_short_description=?,
                                    p_feature=?,
                                    p_return_policy=?,
                                    p_is_featured=?,
                                    p_is_active=?,
                                    ecat_id=?
                                    WHERE p_id=?");
            $query->execute(array(
                $_POST['p_name'],
                $_POST['p_old_price'],
                $_POST['p_current_price'],
                $_POST['p_qty'],
                $_POST['p_description'],
                $_POST['p_short_description'],
                $_POST['p_feature'],
                $_POST['p_return_policy'],
                $_POST['p_is_featured'],
                $_POST['p_is_active'],
                $_POST['ecat_id'],
                $_REQUEST['id']
            ));
        } else {  // Nếu có ảnh sản phẩm nổi bật mới
            unlink('../assets/uploads/' . $_POST['current_photo']); // Xóa ảnh cũ

            $final_name = 'product-featured-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name); // Lưu ảnh mới

            $query = $pdo->prepare("UPDATE table_product SET 
                                    p_name=?, 
                                    p_old_price=?, 
                                    p_current_price=?, 
                                    p_qty=?,
                                    p_featured_photo=?,
                                    p_description=?,
                                    p_short_description=?,
                                    p_feature=?,
                                    p_return_policy=?,
                                    p_is_featured=?,
                                    p_is_active=?,
                                    ecat_id=?
                                    WHERE p_id=?");
            $query->execute(array(
                $_POST['p_name'],
                $_POST['p_old_price'],
                $_POST['p_current_price'],
                $_POST['p_qty'],
                $final_name,
                $_POST['p_description'],
                $_POST['p_short_description'],
                $_POST['p_feature'],
                $_POST['p_return_policy'],
                $_POST['p_is_featured'],
                $_POST['p_is_active'],
                $_POST['ecat_id'],
                $_REQUEST['id']
            ));
        }

        // Xử lý kích thước sản phẩm
        if (isset($_POST['size'])) {
            $query = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
            $query->execute(array($_REQUEST['id']));

            foreach ($_POST['size'] as $value) {
                $query = $pdo->prepare("INSERT INTO table_product_size (size_id,p_id) VALUES (?,?)");
                $query->execute(array($value, $_REQUEST['id']));
            }
        } else {
            $query = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
            $query->execute(array($_REQUEST['id']));
        }

        // Xử lý màu sắc sản phẩm
        if (isset($_POST['color'])) {
            $query = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
            $query->execute(array($_REQUEST['id']));

            foreach ($_POST['color'] as $value) {
                $query = $pdo->prepare("INSERT INTO table_product_color (color_id,p_id) VALUES (?,?)");
                $query->execute(array($value, $_REQUEST['id']));
            }
        } else {
            $query = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
            $query->execute(array($_REQUEST['id']));
        }

        $successMsg = 'Sản phẩm đã được cập nhật thành công.';
    }
}
?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Kiểm tra xem ID có hợp lệ không
    $query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
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
        <h1>Chỉnh sửa sản phẩm</h1>
    </div>
    <div class="content-header-right">
        <a href="product.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<?php
$query = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $p_name = $row['p_name'];
    $p_old_price = $row['p_old_price'];
    $p_current_price = $row['p_current_price'];
    $p_qty = $row['p_qty'];
    $p_featured_photo = $row['p_featured_photo'];
    $p_description = $row['p_description'];
    $p_short_description = $row['p_short_description'];
    $p_feature = $row['p_feature'];
    $p_return_policy = $row['p_return_policy'];
    $p_is_featured = $row['p_is_featured'];
    $p_is_active = $row['p_is_active'];
    $ecat_id = $row['ecat_id'];
}

$query = $pdo->prepare("SELECT * 
                        FROM table_end_category t1
                        JOIN table_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN table_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$query->execute(array($ecat_id));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $tcat_id = $row['tcat_id'];
}

$query = $pdo->prepare("SELECT * FROM table_product_size WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $size_id[] = $row['size_id'];
}

$query = $pdo->prepare("SELECT * FROM table_product_color WHERE p_id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $color_id[] = $row['color_id'];
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
                                    $statement = $pdo->prepare("SELECT * FROM table_top_category ORDER BY tcat_name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['tcat_id']; ?>" <?php if ($row['tcat_id'] == $tcat_id) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                        <?php echo $row['tcat_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục cấp trung <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="mcat_id" class="form-control select2 mid-cat">
                                    <option value="">Chọn danh mục cấp trung</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id = ? ORDER BY mcat_name ASC");
                                    $statement->execute(array($tcat_id));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['mcat_id']; ?>" <?php if ($row['mcat_id'] == $mcat_id) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                        <?php echo $row['mcat_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục cấp cuối <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="ecat_id" class="form-control select2 end-cat">
                                    <option value="">Chọn danh mục cấp cuối</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id = ? ORDER BY ecat_name ASC");
                                    $statement->execute(array($mcat_id));
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                    ?>
                                    <option value="<?php echo $row['ecat_id']; ?>" <?php if ($row['ecat_id'] == $ecat_id) {
                                                                                            echo 'selected';
                                                                                        } ?>>
                                        <?php echo $row['ecat_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên sản phẩm <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_name" class="form-control" value="<?php echo $p_name; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Giá cũ<br><span
                                    style="font-size:10px;font-weight:normal;">(Tính bằng USD)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_old_price" class="form-control"
                                    value="<?php echo $p_old_price; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Giá hiện tại <span>*</span><br><span
                                    style="font-size:10px;font-weight:normal;">(Tính bằng USD)</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_current_price" class="form-control"
                                    value="<?php echo $p_current_price; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Số lượng <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_qty" class="form-control" value="<?php echo $p_qty; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Chọn kích thước</label>
                            <div class="col-sm-4">
                                <select name="size[]" class="form-control select2" multiple="multiple">
                                    <?php
									$is_select = '';
									$statement = $pdo->prepare("SELECT * FROM table_size ORDER BY size_id ASC");
									$statement->execute();
									$result = $statement->fetchAll(PDO::FETCH_ASSOC);			
									foreach ($result as $row) {
										if(isset($size_id)) {
											if(in_array($row['size_id'],$size_id)) {
												$is_select = 'selected';
											} else {
												$is_select = '';
											}
										}
										?>
                                    <option value="<?php echo $row['size_id']; ?>" <?php echo $is_select; ?>>
                                        <?php echo $row['size_name']; ?></option>
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
                                    $is_select = '';
                                    $query = $pdo->prepare("SELECT * FROM table_color ORDER BY color_id ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        if (isset($color_id)) {
                                            if (in_array($row['color_id'], $color_id)) {
                                                $is_select = 'selected';
                                            } else {
                                                $is_select = '';
                                            }
                                        }
                                    ?>
                                    <option value="<?php echo $row['color_id']; ?>" <?php echo $is_select; ?>>
                                        <?php echo $row['color_name']; ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Ảnh nổi bật hiện tại</label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <img src="../assets/uploads/<?php echo $p_featured_photo; ?>" alt=""
                                    style="width:150px;">
                                <input type="hidden" name="current_photo" value="<?php echo $p_featured_photo; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Thay đổi ảnh nổi bật</label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <input type="file" name="p_featured_photo">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Ảnh khác</label>
                            <div class="col-sm-4" style="padding-top:4px;">
                                <table id="ProductTable" style="width:100%;">
                                    <tbody>
                                        <?php
                                        $query = $pdo->prepare("SELECT * FROM table_product_photo WHERE p_id=?");
                                        $query->execute(array($_REQUEST['id']));
                                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <img src="../assets/uploads/product_photos/<?php echo $row['photo']; ?>"
                                                    alt="" style="width:150px;margin-bottom:5px;">
                                            </td>
                                            <td style="width:28px;">
                                                <a onclick="return confirmDelete();"
                                                    href="product-other-photo-delete.php?id=<?php echo $row['pp_id']; ?>&id1=<?php echo $_REQUEST['id']; ?>"
                                                    class="btn btn-danger btn-xs">Xóa</a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                <input type="button" id="btnAddNew" value="Thêm mục"
                                    style="margin-top: 5px;margin-bottom:10px;border:0;color: #fff;font-size: 14px;border-radius:3px;"
                                    class="btn btn-warning btn-xs">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <textarea name="p_description" class="form-control" cols="30" rows="10"
                                    id="editor1"><?php echo $p_description; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Mô tả ngắn</label>
                            <div class="col-sm-8">
                                <textarea name="p_short_description" class="form-control" cols="30" rows="10"
                                    id="editor1"><?php echo $p_short_description; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tính năng</label>
                            <div class="col-sm-8">
                                <textarea name="p_feature" class="form-control" cols="30" rows="10"
                                    id="editor3"><?php echo $p_feature; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Chính sách hoàn trả</label>
                            <div class="col-sm-8">
                                <textarea name="p_return_policy" class="form-control" cols="30" rows="10"
                                    id="editor5"><?php echo $p_return_policy; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Sản phẩm nổi bật?</label>
                            <div class="col-sm-8">
                                <select name="p_is_featured" class="form-control" style="width:auto;">
                                    <option value="0" <?php if ($p_is_featured == '0') {
                                                            echo 'selected';
                                                        } ?>>Không</option>
                                    <option value="1" <?php if ($p_is_featured == '1') {
                                                            echo 'selected';
                                                        } ?>>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Sản phẩm đang hoạt động?</label>
                            <div class="col-sm-8">
                                <select name="p_is_active" class="form-control" style="width:auto;">
                                    <option value="0" <?php if ($p_is_active == '0') {
                                                            echo 'selected';
                                                        } ?>>Không</option>
                                    <option value="1" <?php if ($p_is_active == '1') {
                                                            echo 'selected';
                                                        } ?>>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
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

<?php require_once('footer.php'); ?>