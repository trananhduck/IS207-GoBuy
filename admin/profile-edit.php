<?php require_once('header.php'); ?>

<?php
// Kiểm tra nếu người dùng gửi form cập nhật thông tin cá nhân
if (isset($_POST['form1'])) {

    $valid = 1;

    if (empty($_POST['full_name'])) {
        $valid = 0;
        $errorMsg .= "Tên không được để trống<br>";
    }

    if (empty($_POST['email'])) {
        $valid = 0;
        $errorMsg .= 'Email không được để trống<br>';
    } else {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
            $errorMsg .= 'Email phải hợp lệ<br>';
        } else {
            // Lấy email hiện tại từ cơ sở dữ liệu
            $query = $pdo->prepare("SELECT * FROM table_admin WHERE id=?");
            $query->execute(array($_SESSION['admin']['id']));
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $current_email = $row['email'];
            }

            // Kiểm tra xem email mới có bị trùng không
            $query = $pdo->prepare("SELECT * FROM table_admin WHERE email=? and email!=?");
            $query->execute(array($_POST['email'], $current_email));
            $total = $query->rowCount();
            if ($total) {
                $valid = 0;
                $errorMsg .= 'Email đã tồn tại<br>';
            }
        }
    }

    if ($valid == 1) {
        // Cập nhật thông tin vào session
        $_SESSION['admin']['full_name'] = $_POST['full_name'];
        $_SESSION['admin']['email'] = $_POST['email'];

        // Cập nhật dữ liệu vào database
        $query = $pdo->prepare("UPDATE table_admin SET full_name=?, email=?, phone=? WHERE id=?");
        $query->execute(array($_POST['full_name'], $_POST['email'], $_POST['phone'], $_SESSION['admin']['id']));

        $successMsg = 'Thông tin người dùng đã được cập nhật thành công.';
    }
}

// Xử lý cập nhật ảnh đại diện
if (isset($_POST['form2'])) {
    $valid = 1;
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn chỉ có thể tải lên file jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {
        // Kiểm tra xem ảnh cũ có tồn tại không trước khi xóa
        if (!empty($_SESSION['admin']['photo'])) {
            $old_photo_path = '../assets/uploads/' . $_SESSION['admin']['photo'];
            if (file_exists($old_photo_path) && is_writable($old_photo_path)) {
                unlink($old_photo_path);
            }
        }

        // Cập nhật ảnh mới
        $final_name = 'admin-' . $_SESSION['admin']['id'] . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);
        $_SESSION['admin']['photo'] = $final_name;

        // Cập nhật vào database
        $query = $pdo->prepare("UPDATE table_admin SET photo=? WHERE id=?");
        $query->execute(array($final_name, $_SESSION['admin']['id']));

        $successMsg = 'Ảnh đại diện đã được cập nhật thành công.';
    }
}

// Xử lý thay đổi mật khẩu
if (isset($_POST['form3'])) {
    $valid = 1;

    if (empty($_POST['password']) || empty($_POST['re_password'])) {
        $valid = 0;
        $errorMsg .= "Mật khẩu không được để trống<br>";
    }

    if (!empty($_POST['password']) && !empty($_POST['re_password'])) {
        if ($_POST['password'] != $_POST['re_password']) {
            $valid = 0;
            $errorMsg .= "Mật khẩu không khớp<br>";
        }
    }

    if ($valid == 1) {
        $_SESSION['admin']['password'] = md5($_POST['password']);

        // Cập nhật mật khẩu vào database
        $query = $pdo->prepare("UPDATE table_admin SET password=? WHERE id=?");
        $query->execute(array(md5($_POST['password']), $_SESSION['admin']['id']));

        $successMsg = 'Mật khẩu đã được cập nhật thành công.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Chỉnh sửa hồ sơ</h1>
    </div>
</section>

<?php
// Lấy thông tin người dùng từ database
$query = $pdo->prepare("SELECT * FROM table_admin WHERE id=?");
$query->execute(array($_SESSION['admin']['id']));
$query->rowCount();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $full_name = $row['full_name'];
    $email     = $row['email'];
    $phone     = $row['phone'];
    $photo     = $row['photo'];
    $status    = $row['status'];
}
?>


<section class="content">

    <div class="row">
        <div class="col-md-12">

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Cập nhật thông tin</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Cập nhật ảnh</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Cập nhật mật khẩu</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Họ và tên <span>*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="full_name"
                                                value="<?php echo $full_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $photo; ?>" class="existing-photo"
                                                width="140">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Địa chỉ Email
                                            <span>*</span></label>
                                        <div class="col-sm-4">
                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo $email; ?>">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Số điện thoại </label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="phone"
                                                value="<?php echo $phone; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form1">Cập
                                                nhật thông tin</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form2">Cập
                                                nhật ảnh</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab_3">
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Mật khẩu mới</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Nhập lại mật khẩu</label>
                                        <div class="col-sm-4">
                                            <input type="password" class="form-control" name="re_password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form3">Cập
                                                nhật mật khẩu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once('footer.php'); ?>