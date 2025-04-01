<?php require_once('header.php'); ?>

<?php
// Kiểm tra nếu form đã được gửi
if (isset($_POST['form1'])) {
    $valid = 1;

    // Lấy thông tin tệp ảnh được tải lên
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    // Kiểm tra định dạng ảnh hợp lệ
    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION); // Lấy phần mở rộng của tệp
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải tải lên tệp có định dạng jpg, jpeg, gif hoặc png<br>');
            });
            </script>";
        }
    }

    // Nếu dữ liệu hợp lệ
    if ($valid == 1) {

        // Nếu không có ảnh mới được tải lên
        if ($path == '') {
            $query = $pdo->prepare("UPDATE table_slider SET heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
            $query->execute(array($_POST['heading'], $_POST['content'], $_POST['button_text'], $_POST['button_url'], $_POST['position'], $_REQUEST['id']));
        } else {
            // Xóa ảnh cũ
            unlink('../assets/uploads/' . $_POST['current_photo']);

            // Đổi tên ảnh mới theo định dạng "slider-id.extension"
            $final_name = 'slider-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

            // Cập nhật dữ liệu vào database, bao gồm ảnh mới
            $query = $pdo->prepare("UPDATE table_slider SET photo=?, heading=?, content=?, button_text=?, button_url=?, position=? WHERE id=?");
            $query->execute(array($final_name, $_POST['heading'], $_POST['content'], $_POST['button_text'], $_POST['button_url'], $_POST['position'], $_REQUEST['id']));
        }

        echo "<script>
            $(document).ready(function() {
                toastr.success('Cập nhật slider thành công!');
            });
        </script>";
    }
}
?>

<?php
// Kiểm tra tham số id có tồn tại không
if (!isset($_REQUEST['id'])) {
    header('location: logout.php'); // Điều hướng về trang đăng xuất nếu không có id
    exit;
} else {
    // Kiểm tra id có hợp lệ hay không
    $query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
    $query->execute(array($_REQUEST['id']));
    $total = $query->rowCount();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: logout.php'); // Điều hướng nếu id không hợp lệ
        exit;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Chỉnh sửa Slider</h1>
    </div>
    <div class="content-header-right">
        <a href="slider.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>

<?php
// Lấy dữ liệu slider theo id
$query = $pdo->prepare("SELECT * FROM table_slider WHERE id=?");
$query->execute(array($_REQUEST['id']));
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo       = $row['photo'];
    $heading     = $row['heading'];
    $content     = $row['content'];
    $button_text = $row['button_text'];
    $button_url  = $row['button_url'];
    $position    = $row['position'];
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
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Ảnh hiện tại</label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <img src="../assets/uploads/<?php echo $photo; ?>" alt="Slider Photo"
                                    style="width:400px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Ảnh mới</label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" name="photo">(Chỉ chấp nhận định dạng jpg, jpeg, gif và png)
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Tiêu đề</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="heading"
                                    value="<?php echo $heading; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="content"
                                    style="height:140px;"><?php echo $content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Văn bản nút</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="button_text"
                                    value="<?php echo $button_text; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Liên kết nút</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="button_url"
                                    value="<?php echo $button_url; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Vị trí</label>
                            <div class="col-sm-6">
                                <select name="position" class="form-control">
                                    <option value="Left" <?php if ($position == 'Left') {
                                                                echo 'selected';
                                                            } ?>>Left
                                    </option>
                                    <option value="Center" <?php if ($position == 'Center') {
                                                                echo 'selected';
                                                            } ?>>Center
                                    </option>
                                    <option value="Right" <?php if ($position == 'Right') {
                                                                echo 'selected';
                                                            } ?>>Right
                                    </option>
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

<?php require_once('footer.php'); ?>