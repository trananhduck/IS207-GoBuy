<?php require_once('header.php'); ?>

<?php
// Thay đổi Logo
if (isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn một ảnh<br>';
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'Bạn chỉ được tải lên tệp có định dạng jpg, jpeg, gif hoặc png<br>';
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $logo = $row['logo'];
            unlink('../assets/uploads/' . $logo);
        }

        // Cập nhật dữ liệu mới
        $final_name = 'logo' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET logo=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
            $(document).ready(function() {
                toastr.success('Cập nhập Logo thành công');
            });
        </script>";
    }
}
// Thay đổi Favicon
if (isset($_POST['form2'])) {
    $valid = 1;

    $path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải chọn một ảnh<br>');
            });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn chỉ được tải lên tệp có định dạng jpg, jpeg, gif hoặc png<br>');
            });
        </script>";        
    }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $favicon = $row['favicon'];
            unlink('../assets/uploads/' . $favicon);
        }

        // Cập nhật dữ liệu mới
        $final_name = 'favicon' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET favicon=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
            $(document).ready(function() {
                toastr.success('Cập nhập Favicon thành công');
            });
        </script>";
    }
}

// Cập nhật phần Footer & trang Liên hệ
if (isset($_POST['form3'])) {
    // Cập nhật cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_settings SET footer_copyright=?, contact_address=?, 
        contact_email=?, contact_phone=?, contact_map_iframe=? WHERE id=1");
    $query->execute(array(
        $_POST['footer_copyright'],
        $_POST['contact_address'],
        $_POST['contact_email'],
        $_POST['contact_phone'],
        $_POST['contact_map_iframe']
    ));

    echo "<script>
            $(document).ready(function() {
                toastr.success('Cập nhật cài đặt nội dung chung thành công.');
            });
        </script>";
}

// Cài đặt Email
if (isset($_POST['form4'])) {
    // Cập nhật cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_settings SET receive_email=?, receive_email_subject=?, 
        receive_email_thank_you_message=?, forget_password_message=? WHERE id=1");
    $query->execute(array(
        $_POST['receive_email'],
        $_POST['receive_email_subject'],
        $_POST['receive_email_thank_you_message'],
        $_POST['forget_password_message']
    ));

    echo "<script>
    $(document).ready(function() {
        toastr.success('Cập nhật thông tin cài đặt biểu mẫu liên hệ thành công.');
    });
</script>";
}

// Không thể hoàn thành phần này, để lại
if (isset($_POST['form5'])) {
    // Kiểm tra nếu key không tồn tại thì đặt giá trị mặc định (ví dụ: 0)
    $total_latest_product = isset($_POST['total_latest_product']) ? $_POST['total_latest_product'] : 0;
    $total_popular_product = isset($_POST['total_popular_product']) ? $_POST['total_popular_product'] : 0;

    // Cập nhật cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_settings SET total_latest_product=?, 
        total_popular_product=? WHERE id=1");
    $query->execute(array(
        $total_latest_product,
        $total_popular_product
    ));

    echo "<script>
    $(document).ready(function() {
        toastr.success('Cập nhật cài đặt thanh bên thành công.');
    });
</script>";
}


// Cài đặt bật/tắt các phần trên trang chủ
if (isset($_POST['form6_0'])) {
    // Kiểm tra nếu key không tồn tại thì đặt giá trị mặc định (0: tắt, 1: bật)
    $service_on_off = isset($_POST['service_on_off']) ? $_POST['service_on_off'] : 0;
    $latest_product_on_off = isset($_POST['latest_product_on_off']) ? $_POST['latest_product_on_off'] : 0;
    $popular_product_on_off = isset($_POST['popular_product_on_off']) ? $_POST['popular_product_on_off'] : 0;

    // Cập nhật cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_settings SET service_on_off=?, 
        latest_product_on_off=?, popular_product_on_off=? WHERE id=1");
    $query->execute(array(
        $service_on_off,
        $latest_product_on_off,
        $popular_product_on_off
    ));

    echo "<script>
    $(document).ready(function() {
        toastr.success('Cập nhật cài đặt bật/tắt các phần thành công.');
    });
</script>";
}

if (isset($_POST['form6'])) {
    echo "<script>
    $(document).ready(function() {
        toastr.success('Cài đặt Meta trang chủ đã được cập nhật thành công.');
    });
</script>";
}

if (isset($_POST['form6_7'])) {

    $valid = 1;

    if (empty($_POST['cta_title'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Tiêu đề Kêu gọi hành động không được để trống<br>');
        });
        </script>";
        }

    if (empty($_POST['cta_content'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Nội dung Kêu gọi hành động không được để trống<br>');
        });
        </script>";    }

    if (empty($_POST['cta_read_more_text'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Văn bản 'Đọc thêm' của Kêu gọi hành động không được để trống<br>');
        });
        </script>";    }

    if (empty($_POST['cta_read_more_url'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('URL 'Đọc thêm' của Kêu gọi hành động không được để trống<br>');
        });
        </script>";    }

    $path = $_FILES['cta_photo']['name'];
    $path_tmp = $_FILES['cta_photo']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
            });
            </script>";        }
    }

    if ($valid == 1) {

        if ($path != '') {
            // xóa ảnh hiện có
            $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $cta_photo = $row['cta_photo'];
                unlink('../assets/uploads/' . $cta_photo);
            }

            // cập nhật dữ liệu
            $final_name = 'cta' . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

            // cập nhật cơ sở dữ liệu
            $query = $pdo->prepare("UPDATE table_settings SET cta_title=?, cta_content=?, cta_read_more_text=?, cta_read_more_url=?, cta_photo=? WHERE id=1");
            $query->execute(array(
                $_POST['cta_title'],
                $_POST['cta_content'],
                $_POST['cta_read_more_text'],
                $_POST['cta_read_more_url'],
                $final_name
            ));
        } else {
            // cập nhật cơ sở dữ liệu (không có ảnh)
            $query = $pdo->prepare("UPDATE table_settings SET cta_title=?, cta_content=?, cta_read_more_text=?, cta_read_more_url=? WHERE id=1");
            $query->execute(array(
                $_POST['cta_title'],
                $_POST['cta_content'],
                $_POST['cta_read_more_text'],
                $_POST['cta_read_more_url']
            ));
        }

        echo "<script>
        $(document).ready(function() {
            toastr.success('Dữ liệu Kêu gọi hành động đã được cập nhật thành công.');
        });
    </script>";    }
}
if (isset($_POST['form6_5'])) {

    $valid = 1;

    if (empty($_POST['latest_product_title'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Tiêu đề Sản phẩm Nổi bật không được để trống<br>');
        });
        </script>";    }

    if (empty($_POST['latest_product_subtitle'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Phụ đề Sản phẩm Nổi bật không được để trống<br>');
        });
        </script>";    }

    if ($valid == 1) {

        // cập nhật cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET latest_product_title=?,latest_product_subtitle=? WHERE id=1");
        $query->execute(array($_POST['latest_product_title'], $_POST['latest_product_subtitle']));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Dữ liệu Sản phẩm Nổi bật đã được cập nhật thành công.');
        });
        </script>";    }
}

if (isset($_POST['form6_6'])) {

    $valid = 1;

    if (empty($_POST['popular_product_title'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Tiêu đề Sản phẩm Mới nhất không được để trống<br>');
        });
        </script>";    }

    if (empty($_POST['popular_product_subtitle'])) {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Phụ đề Sản phẩm Mới nhất không được để trống<br>');
        });
        </script>";    }

    if ($valid == 1) {

        // cập nhật cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET popular_product_title=?,popular_product_subtitle=? WHERE id=1");
        $query->execute(array($_POST['popular_product_title'], $_POST['popular_product_subtitle']));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Dữ liệu Sản phẩm Mới nhất đã được cập nhật thành công.');
        });
        </script>";    }
}

if (isset($_POST['form6_3'])) {

    // cập nhật cơ sở dữ liệu
    $query = $pdo->prepare("UPDATE table_settings SET newsletter_text=? WHERE id=1");
    $query->execute(array($_POST['newsletter_text']));

    echo "<script>
        $(document).ready(function() {
            toastr.success('Nội dung Bản tin đã được cập nhật thành công.');
        });
        </script>";
}
if (isset($_POST['form7_1'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn 1 ảnh<br>');
        });
        </script>";
        } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_login = $row['banner_login'];
            unlink('../assets/uploads/' . $banner_login);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_login' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_login=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang đăng nhập đã được cập nhật thành công.');
        });
        </script>";
    }
}

if (isset($_POST['form7_2'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn 1 ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
            });
            </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_registration = $row['banner_registration'];
            unlink('../assets/uploads/' . $banner_registration);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_registration' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_registration=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang đăng kí đã được cập nhật thành công.');
        });
        </script>";
    }
}

if (isset($_POST['form7_3'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
            });
            </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_forget_password = $row['banner_forget_password'];
            unlink('../assets/uploads/' . $banner_forget_password);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_forget_password' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_forget_password=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang quên mật khẩu đã được cập nhật thành công.');
        });
        </script>";
    }
}

if (isset($_POST['form7_4'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_reset_password = $row['banner_reset_password'];
            unlink('../assets/uploads/' . $banner_reset_password);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_reset_password' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_reset_password=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang đặt lại mật khẩu đã được cập nhật thành công.');
        });
        </script>";
    }
}
if (isset($_POST['form7_6'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_search = $row['banner_search'];
            unlink('../assets/uploads/' . $banner_search);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_search' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_search=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang tìm kiếm đã được cập nhật thành công.');
        });
        </script>";
    }
}

if (isset($_POST['form7_7'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_cart = $row['banner_cart'];
            unlink('../assets/uploads/' . $banner_cart);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_cart' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_cart=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang giỏ hàng đã được cập nhật thành công.');
        });
        </script>";
    }
    }
}
if (isset($_POST['form7_8'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_checkout = $row['banner_checkout'];
            unlink('../assets/uploads/' . $banner_checkout);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_checkout' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật vào cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_checkout=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Banner trang thanh toán đã được cập nhật thành công.');
        });
        </script>";
    }
}
if (isset($_POST['form7_9'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }

    if ($valid == 1) {
        // Xóa ảnh hiện tại
        $query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $banner_product_category = $row['banner_product_category'];
            unlink('../assets/uploads/' . $banner_product_category);
        }

        // Cập nhật dữ liệu
        $final_name = 'banner_product_category' . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

        // Cập nhật cơ sở dữ liệu
        $query = $pdo->prepare("UPDATE table_settings SET banner_product_category=? WHERE id=1");
        $query->execute(array($final_name));

        echo "<script>
        $(document).ready(function() {
            toastr.success('Ảnh banner trang danh mục sản phẩm đã được cập nhật thành công.');
        });
        </script>";
    }
}

if (isset($_POST['form7_10'])) {
    $valid = 1;

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải chọn một ảnh<br>');
        });
        </script>";
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            echo "<script>
        $(document).ready(function() {
            toastr.error('Bạn phải tải lên tệp jpg, jpeg, gif hoặc png<br>');
        });
        </script>";
        }
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Cài đặt Website</h1>
    </div>
</section>

<?php
$query = $pdo->prepare("SELECT * FROM table_settings WHERE id=1");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $logo                            = $row['logo'];
    $favicon                         = $row['favicon'];
    $footer_about                    = $row['footer_about'];
    $footer_copyright                = $row['footer_copyright'];
    $contact_address                 = $row['contact_address'];
    $contact_email                   = $row['contact_email'];
    $contact_phone                   = $row['contact_phone'];
    $contact_map_iframe              = $row['contact_map_iframe'];
    $receive_email                   = $row['receive_email'];
    $receive_email_subject           = $row['receive_email_subject'];
    $receive_email_thank_you_message = $row['receive_email_thank_you_message'];
    $forget_password_message         = $row['forget_password_message'];
    $total_latest_product       = $row['total_latest_product'];
    $total_popular_product      = $row['total_popular_product'];
    $meta_title                 = $row['meta_title'];
    $banner_login                    = $row['banner_login'];
    $banner_registration             = $row['banner_registration'];
    $banner_forget_password          = $row['banner_forget_password'];
    $banner_reset_password           = $row['banner_reset_password'];
    $banner_search                   = $row['banner_search'];
    $banner_cart                     = $row['banner_cart'];
    $banner_checkout                 = $row['banner_checkout'];
    $banner_product_category         = $row['banner_product_category'];
    $latest_product_title            = $row['latest_product_title'];
    $latest_product_subtitle         = $row['latest_product_subtitle'];
    $popular_product_title           = $row['popular_product_title'];
    $popular_product_subtitle        = $row['popular_product_subtitle'];
    $bank_detail                     = $row['bank_detail'];
    $service_on_off             = $row['service_on_off'];
    $latest_product_on_off      = $row['latest_product_on_off'];
    $popular_product_on_off     = $row['popular_product_on_off'];
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
                    <li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Footer & Liên hệ</a></li>
                    <li><a href="#tab_4" data-toggle="tab">Cài đặt tin nhắn</a></li>
                    <li><a href="#tab_5" data-toggle="tab">Sản phẩm</a></li>
                    <li><a href="#tab_6" data-toggle="tab">Cài đặt trang chủ</a></li>
                    <li><a href="#tab_7" data-toggle="tab">Cài đặt banner</a></li>
                    <li><a href="#tab_9" data-toggle="tab">Cài đặt thanh toán</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">


                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $logo; ?>" class="existing-photo"
                                                style="height:80px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_logo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form1">Cập
                                                nhật Logo</button>
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
                                        <label for="" class="col-sm-2 control-label">Ảnh hiện tại</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <img src="../assets/uploads/<?php echo $favicon; ?>" class="existing-photo"
                                                style="height:40px;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Ảnh mới</label>
                                        <div class="col-sm-6" style="padding-top:6px;">
                                            <input type="file" name="photo_favicon">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form2">Cập
                                                nhật Favicon</button>
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
                                        <label for="" class="col-sm-2 control-label">Footer - Bản quyền</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="footer_copyright"
                                                value="<?php echo $footer_copyright; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Địa chỉ liên hệ</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" name="contact_address"
                                                style="height:140px;"><?php echo $contact_address; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Email liên hệ</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contact_email"
                                                value="<?php echo $contact_email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Số điện thoại liên hệ</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="contact_phone"
                                                value="<?php echo $contact_phone; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Bản đồ iFrame liên hệ</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="contact_map_iframe"
                                                style="height:200px;"><?php echo $contact_map_iframe; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form3">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="tab_4">
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Địa chỉ email liên hệ</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="receive_email"
                                                value="<?php echo $receive_email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu đề email liên hệ</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="receive_email_subject"
                                                value="<?php echo $receive_email_subject; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tin nhắn cảm ơn email liên
                                            hệ</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control"
                                                name="receive_email_thank_you_message"><?php echo $receive_email_thank_you_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tin nhắn quên mật khẩu</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control"
                                                name="forget_password_message"><?php echo $forget_password_message; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-5">
                                            <button type="submit" class="btn btn-success pull-left" name="form4">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="tab-pane" id="tab_5">
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Trang chủ (Số lượng sản phẩm mới
                                            nhất?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_latest_product"
                                                value="<?php echo $total_latest_product; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label">Trang chủ (Số lượng sản phẩm phổ
                                            biến?)<span>*</span></label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" name="total_popular_product"
                                                value="<?php echo $total_popular_product; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-4 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form5">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="tab_6">
                        <h3>Bật/Tắt Các Phần</h3>
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Phần Dịch Vụ</label>
                                        <div class="col-sm-4">
                                            <select name="service_on_off" class="form-control" style="width:auto;">
                                                <option value="1" <?php if ($service_on_off == 1) {
                                                                        echo 'selected';
                                                                    } ?>>Bật
                                                </option>
                                                <option value="0" <?php if ($service_on_off == 0) {
                                                                        echo 'selected';
                                                                    } ?>>Tắt
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Phần Sản Phẩm Mới Nhất</label>
                                        <div class="col-sm-4">
                                            <select name="latest_product_on_off" class="form-control"
                                                style="width:auto;">
                                                <option value="1" <?php if ($latest_product_on_off == 1) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                    Bật</option>
                                                <option value="0" <?php if ($latest_product_on_off == 0) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                    Tắt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Phần Sản Phẩm Phổ Biến</label>
                                        <div class="col-sm-4">
                                            <select name="popular_product_on_off" class="form-control"
                                                style="width:auto;">
                                                <option value="1" <?php if ($popular_product_on_off == 1) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                    Bật</option>
                                                <option value="0" <?php if ($popular_product_on_off == 0) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                    Tắt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_0">Cập
                                                Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <h3>Phần Meta</h3>
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu Đề Meta</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="meta_title" class="form-control"
                                                value="<?php echo $meta_title ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6">Cập
                                                Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <h3>Phần Sản Phẩm Mới Nhất</h3>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu Đề Sản Phẩm Mới
                                            Nhất<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_title"
                                                value="<?php echo $latest_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Phụ Đề Sản Phẩm Mới
                                            Nhất<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="latest_product_subtitle"
                                                value="<?php echo $latest_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_5">Cập
                                                Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <h3>Phần Sản Phẩm Phổ Biến</h3>
                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Tiêu Đề Sản Phẩm Phổ
                                            Biến<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_title"
                                                value="<?php echo $popular_product_title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Phụ Đề Sản Phẩm Phổ
                                            Biến<span>*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="popular_product_subtitle"
                                                value="<?php echo $popular_product_subtitle; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form6_6">Cập
                                                Nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane" id="tab_7">
                        <table class="table table-bordered">
                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang đăng nhập hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_login; ?>" alt=""
                                                style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang đăng nhập</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_1">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang đăng ký hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_registration; ?>" alt=""
                                                style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang đăng ký</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_2">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang quên mật khẩu hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_forget_password; ?>"
                                                alt="" style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang quên mật khẩu</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_3">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang đặt lại mật khẩu hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_reset_password; ?>"
                                                alt="" style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang đặt lại mật khẩu</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_4">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang tìm kiếm hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_search; ?>" alt=""
                                                style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang tìm kiếm</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_6">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang giỏ hàng hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_cart; ?>" alt=""
                                                style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang giỏ hàng</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_7">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang thanh toán hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_checkout; ?>" alt=""
                                                style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang thanh toán</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_8">
                                    </td>
                                </form>
                            </tr>

                            <tr>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <td style="width:50%">
                                        <h4>Banner trang danh mục sản phẩm hiện tại</h4>
                                        <p>
                                            <img src="<?php echo '../assets/uploads/' . $banner_product_category; ?>"
                                                alt="" style="width: 100%;height:auto;">
                                        </p>
                                    </td>
                                    <td style="width:50%">
                                        <h4>Thay đổi Banner trang danh mục sản phẩm</h4>
                                        Chọn ảnh<input type="file" name="photo">
                                        <input type="submit" class="btn btn-primary btn-xs" value="Thay đổi"
                                            style="margin-top:10px;" name="form7_9">
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </div>

                    <!-- TAB PHƯƠNG THỨC THANH TOÁN -->
                    <div class="tab-pane" id="tab_9">
                        <form class="form-horizontal" action="" method="post">
                            <div class="box box-info">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label">Thông tin ngân hàng </label>
                                        <div class="col-sm-5">
                                            <textarea name="bank_detail" class="form-control" cols="30"
                                                rows="10"><?php echo $bank_detail; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-success pull-left" name="form9">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<?php require_once('footer.php'); ?>