<?php require_once('header.php'); ?>
<?php
require_once '../vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['export_excel'])) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tiêu Đề');
        $sheet->setCellValue('C1', 'Nội Dung');
        $sheet->setCellValue('D1', 'Hình Ảnh');
        
        $stmt = $pdo->prepare("SELECT * FROM table_service");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $rowIndex = 2;
        foreach ($rows as $row) {
            $sheet->setCellValue("A$rowIndex", $row['id']);
            $sheet->setCellValue("B$rowIndex", $row['title']);
            $sheet->setCellValue("C$rowIndex", $row['content']);
            $sheet->setCellValue("D$rowIndex", $row['photo']);
            $rowIndex++;
        }
        ob_end_clean(); // Xóa hết dữ liệu đệm
        ob_start(); // Bắt đầu bộ nhớ đệm mới
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="export_service.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['excel_file'])) {
        if ($_FILES['excel_file']['error'] != 0) {
            die("Lỗi: Vui lòng chọn file Excel hợp lệ!");
        }
    
        $filePath = 'uploads/' . basename($_FILES['excel_file']['name']);
        if (!move_uploaded_file($_FILES['excel_file']['tmp_name'], $filePath)) {
            die("Lỗi: Không thể lưu file upload!");
        }
    
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
    
        foreach ($rows as $index => $cells) {
            if ($index == 0) continue; // Bỏ qua hàng tiêu đề

            list($id, $title, $content, $photo) = $cells;
            try {
                $query = $pdo->prepare("INSERT INTO table_service (id, title, content, photo) VALUES (?, ?, ?, ?)");
                $query->execute([$id, $title, $content, $photo]);
            } catch (PDOException $e) {
                die("Lỗi SQL: " . $e->getMessage());
            }
        }
    
        echo "<script>localStorage.setItem('toastMessage', 'Nhập thành công!'); window.location.href='service.php';</script>";
    }
}
?>
<?php
    if (isset($_POST['clear_all'])) {
        try {
            $pdo->beginTransaction();
            $pdo->exec("DELETE FROM table_service");
            $pdo->commit();
            echo "<script>localStorage.setItem('toastMessage', 'Đã xóa toàn bộ dữ liệu!'); window.location.href='service.php';</script>";
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "<script>showToast('error', 'Lỗi khi xóa dữ liệu!');</script>";
        }
    }
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Xem Dịch Vụ</h1>
    </div>
    <div class="content-header-right">
        <form method="post" enctype="multipart/form-data" action="">
            <button type="button" id="clear_all" class="btn btn-danger">Xóa Tất Cả</button>
            <button type="submit" name="export_excel" class="btn btn-success">Xuất Excel</button>
            <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" style="display: none;">
            <button type="button" id="import_button" class="btn btn-success">Nhập Excel</button>
            <button type="submit" id="import_excel" name="import_excel" class="btn btn-success" style="display: none;">Xác nhận nhập</button>
        </form>
        <a href="service-add.php" class="btn btn-primary btn-sm">Thêm Dịch Vụ</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="30">STT</th>
                                <th>Hình Ảnh</th>
                                <th width="100">Tiêu Đề</th>
                                <th>Nội Dung</th>
                                <th width="80">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * FROM table_service");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td style="width:130px;"><img src="../assets/uploads/<?php echo $row['photo']; ?>"
                                            alt="<?php echo $row['title']; ?>" style="width:120px;"></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['content']; ?></td>
                                    <td>
                                        <a href="service-edit.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-primary btn-xs edit-btn">Sửa</a>
                                        <a href="#" class="btn btn-danger btn-xs"
                                            data-href="service-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal"
                                            data-target="#confirm-delete">Xóa</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác Nhận Xóa</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa mục này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok" id="confirm-delete-btn">Xóa</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#confirm-delete-btn').click(function (e) {
            e.preventDefault();
            toastr.success("Xóa thành công!");
            setTimeout(function () {
                window.location.href = $('.btn-ok').attr('href');
            }, 2000); // Chuyển hướng sau 2 giây
        });
    });
    $(document).ready(function () {
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            toastr.info("Chuyển đến trang chỉnh sửa...");
            setTimeout(() => {
                window.location.href = $(this).attr('href');
            }, 1500); // Chuyển hướng sau 1.5 giây
        });
    });
    $(document).ready(function () {
        $('#confirm-delete').on('show.bs.modal', function (e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

        $('.btn-ok').click(function (e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('href');
            $('#confirm-delete').modal('hide');
            toastr.success('Sản phẩm đã bị xóa!');
            setTimeout(() => {
                window.location.href = deleteUrl;
            }, 2000);
        });
    });
    $(document).ready(function () {
        $('.edit-btn').click(function (e) {
            e.preventDefault();
            toastr.info("Chuyển đến trang chỉnh sửa...");
            setTimeout(() => {
                window.location.href = $(this).attr('href');
            }, 1500); // Chuyển hướng sau 1.5 giây
        });
    });
    document.getElementById("import_button").addEventListener("click", function() {
        document.getElementById("excel_file").click();
    });

    document.getElementById("excel_file").addEventListener("change", function() {
        if (this.files.length > 0) {
            document.getElementById("import_excel").click();
        }
    });
    document.getElementById("clear_all").addEventListener("click", function () {
        if (confirm("Bạn có chắc chắn muốn xóa tất cả sản phẩm không?")) {
            let form = document.createElement("form");
            form.method = "POST";
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "clear_all";
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    });
    window.onload = function() {
        let message = localStorage.getItem('toastMessage');
        if (message) {
            console.log(message);
            toastr.success(message);
            localStorage.removeItem('toastMessage'); // Xóa sau khi hiển thị để tránh hiển thị lại khi tải lại trang
        }
    };
    function showToast(type, message) {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        
        if (type === 'success') {
            toastr.success(message);
        } else if (type === 'error') {
            toastr.error(message);
        } else if (type === 'info') {
            toastr.info(message);
        } else if (type === 'warning') {
            toastr.warning(message);
        }
    }
</script>
<?php require_once('footer.php'); ?>