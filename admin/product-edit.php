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

            // Lấy ID sản phẩm tiếp theo từ bảng `table_product_photo`
            $querry = $pdo->prepare("SHOW TABLE STATUS LIKE 'table_product_photo'");
            $querry->execute();
            $result = $querry->fetchAll();
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
                    $querry = $pdo->prepare("INSERT INTO table_product_photo (photo,p_id) VALUES (?,?)");
                    $querry->execute(array($final_name1[$i], $_REQUEST['id']));
                }
            }
        }

        if ($path == '') {  // Nếu không có ảnh sản phẩm nổi bật mới
            $querry = $pdo->prepare("UPDATE table_product SET 
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
            $querry->execute(array(
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

            $querry = $pdo->prepare("UPDATE table_product SET 
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
            $querry->execute(array(
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
            $querry = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
            $querry->execute(array($_REQUEST['id']));

            foreach ($_POST['size'] as $value) {
                $querry = $pdo->prepare("INSERT INTO table_product_size (size_id,p_id) VALUES (?,?)");
                $querry->execute(array($value, $_REQUEST['id']));
            }
        } else {
            $querry = $pdo->prepare("DELETE FROM table_product_size WHERE p_id=?");
            $querry->execute(array($_REQUEST['id']));
        }

        // Xử lý màu sắc sản phẩm
        if (isset($_POST['color'])) {
            $querry = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
            $querry->execute(array($_REQUEST['id']));

            foreach ($_POST['color'] as $value) {
                $querry = $pdo->prepare("INSERT INTO table_product_color (color_id,p_id) VALUES (?,?)");
                $querry->execute(array($value, $_REQUEST['id']));
            }
        } else {
            $querry = $pdo->prepare("DELETE FROM table_product_color WHERE p_id=?");
            $querry->execute(array($_REQUEST['id']));
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
    $querry = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
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
$querry = $pdo->prepare("SELECT * FROM table_product WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
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

$querry = $pdo->prepare("SELECT * 
                        FROM table_end_category t1
                        JOIN table_mid_category t2
                        ON t1.mcat_id = t2.mcat_id
                        JOIN table_top_category t3
                        ON t2.tcat_id = t3.tcat_id
                        WHERE t1.ecat_id=?");
$querry->execute(array($ecat_id));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $tcat_id = $row['tcat_id'];
}

$querry = $pdo->prepare("SELECT * FROM table_product_size WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $size_id[] = $row['size_id'];
}

$querry = $pdo->prepare("SELECT * FROM table_product_color WHERE p_id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $color_id[] = $row['color_id'];
}
?>