<?php require_once('header.php'); ?>

<?php

if (isset($_POST['form_about'])) {

    $valid = 1;

    if (empty($_POST['about_title'])) {
        $valid = 0;
        $errorMsg .= 'Tiêu đề không được để trống<br>';
    }

    if (empty($_POST['about_content'])) {
        $valid = 0;
        $errorMsg .= 'Nội dung không được để trống<br>';
    }

    $path = $_FILES['about_banner']['name'];
    $path_tmp = $_FILES['about_banner']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {

        if ($path != '') {
            // Xóa ảnh hiện có
            $query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $about_banner = $row['about_banner'];
                unlink('../assets/uploads/' . $about_banner);
            }

            // Cập nhật dữ liệu
            $final_name = 'about-banner' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);
        }

        $successMsg = 'Thông tin Trang About đã được cập nhật thành công.';
    }
}

// Xử lý form FAQ
if (isset($_POST['form_faq'])) {

    $valid = 1;

    if (empty($_POST['faq_title'])) {
        $valid = 0;
        $errorMsg .= 'Tiêu đề không được để trống<br>';
    }

    $path = $_FILES['faq_banner']['name'];
    $path_tmp = $_FILES['faq_banner']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {

        if ($path != '') {
            // Xóa ảnh hiện có
            $query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $faq_banner = $row['faq_banner'];
                unlink('../assets/uploads/' . $faq_banner);
            }

            // Cập nhật dữ liệu
            $final_name = 'faq-banner' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);
        }

        $successMsg = 'Thông tin Trang FAQ đã được cập nhật thành công.';
    }
}

// Xử lý form Liên hệ
if (isset($_POST['form_contact'])) {

    $valid = 1;

    if (empty($_POST['contact_title'])) {
        $valid = 0;
        $errorMsg .= 'Tiêu đề không được để trống<br>';
    }

    $path = $_FILES['contact_banner']['name'];
    $path_tmp = $_FILES['contact_banner']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {

        if ($path != '') {
            // Xóa ảnh hiện có
            $query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $contact_banner = $row['contact_banner'];
                unlink('../assets/uploads/' . $contact_banner);
            }

            // Cập nhật dữ liệu
            $final_name = 'contact-banner' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);
        }

        $successMsg = 'Thông tin Trang Liên Hệ đã được cập nhật thành công.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Page Settings</h1>
    </div>
</section>
<?php
$query = $pdo->prepare("SELECT * FROM table_page WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_banner = $row['about_banner'];
    $faq_title = $row['faq_title'];
    $faq_banner = $row['faq_banner'];
    $contact_title = $row['contact_title'];
    $contact_banner = $row['contact_banner'];
}
?>

<section class="content" style="min-height:auto;margin-bottom: -30px;">
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
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">About</a></li>
                    <li><a href="#tab_2" data-toggle="tab">FAQ</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Liên hệ</a></li>
                </ul>

                <!-- Nội dung trang About -->

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu đề trang * </label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="about_title"
                                                value="<?php echo $about_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Nội dung trang * </label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="about_content"
                                                id="editor1"><?php echo $about_content; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh biểu ngữ hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $about_banner; ?>"
                                                class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh biểu ngữ mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="about_banner">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left"
                                                name="form_about">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- FAQ Page Content -->
                    <div class="tab-pane" id="tab_2">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu đề trang * </label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="faq_title"
                                                value="<?php echo $faq_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh banner hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $faq_banner; ?>"
                                                class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh banner mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="faq_banner">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form_faq">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- End of FAQ Page Content -->

                    <div class="tab-pane" id="tab_4">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu đề trang * </label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" name="contact_title"
                                                value="<?php echo $contact_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh banner hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $contact_banner; ?>"
                                                class="existing-photo" style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Ảnh banner mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="contact_banner">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left"
                                                name="form_contact">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    </form>
                </div>
            </div>
</section>

<?php require_once('footer.php'); ?>