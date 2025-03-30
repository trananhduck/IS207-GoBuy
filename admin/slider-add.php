<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    // Lấy thông tin tệp ảnh được tải lên
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);

        // Kiểm tra định dạng ảnh hợp lệ
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn chỉ được tải lên tệp jpg, jpeg, gif hoặc png<br>';
        }
    } else {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn một ảnh<br>';
    }

    if ($valid == 1) {
        // Lấy ID tự động tăng
        $query = $pdo->prepare("SHOW TABLE STATUS LIKE 'table_slider'");
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $row) {
            $ai_id = $row[10];
        }

        // Lưu ảnh với tên mới
        $final_name = 'slider-' . $ai_id . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Chèn dữ liệu vào bảng table_slider
        $query = $pdo->prepare("INSERT INTO table_slider (photo,heading,content,button_text,button_url,position) VALUES (?,?,?,?,?,?)");
        $query->execute(array($final_name, $_POST['heading'], $_POST['content'], $_POST['button_text'], $_POST['button_url'], $_POST['position']));

        $successMsg = 'Thêm slider thành công!';

        // Xóa dữ liệu đã nhập để tránh nhập lại khi reload trang
        unset($_POST['heading']);
        unset($_POST['content']);
        unset($_POST['button_text']);
        unset($_POST['button_url']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm Slider</h1>
    </div>
    <div class="content-header-right">
        <a href="slider.php" class="btn btn-primary btn-sm">Thoát</a>
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

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ảnh <span>*</span></label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <input type="file" name="photo">(Chỉ chấp nhận jpg, jpeg, gif và png)
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tiêu đề</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="heading"
                                    value="<?php if (isset($_POST['heading'])) {
                                                                                                                        echo $_POST['heading'];
                                                                                                                    } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="content" style="height:140px;"><?php if (isset($_POST['content'])) {
                                                                                                        echo $_POST['content'];
                                                                                                    } ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nút bấm</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="button_text"
                                    value="<?php if (isset($_POST['button_text'])) {
                                                                                                                            echo $_POST['button_text'];
                                                                                                                        } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">URL nút bấm</label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="button_url"
                                    value="<?php if (isset($_POST['button_url'])) {
                                                                                                                        echo $_POST['button_url'];
                                                                                                                    } ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Vị trí</label>
                            <div class="col-sm-6">
                                <select name="position" class="form-control">
                                    <option value="Left">Left</option>
                                    <option value="Center">Center</option>
                                    <option value="Right">Right</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
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