<?php require_once('header.php'); ?>
<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
// ✅ CHỨC NĂNG XUẤT EXCEL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['export_excel'])) {
        // Tạo file Excel mới
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Thiết lập tiêu đề cột
        $headers = [
            'STT',
            'Tên danh mục lớn',
            'Tên danh mục trung bình',
            'Tên danh mục con',
            'Tên sản phẩm',
            'Giá cũ',
            'Giá hiện tại',
            'Số lượng',
            'Chọn kích thước',
            'Chọn màu sắc',
            'Ảnh đại diện',
            'Ảnh khác',
            'Mô tả',
            'Mô tả ngắn',
            'Tính năng',
            'Chính sách hoàn trả',
            'Có nổi bật không?',
            'Có hoạt động không?'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '1', $header);
            $col++;
        }

        // Truy vấn dữ liệu từ DB
        $query = $pdo->prepare("SELECT t1.p_id, t1.p_name, t1.p_old_price, t1.p_current_price, t1.p_qty, 
                                t1.p_featured_photo, t1.p_description, t1.p_short_description, 
                                t1.p_feature, t1.p_return_policy, t1.p_is_featured, t1.p_is_active,
                                t4.tcat_name, t3.mcat_name, t2.ecat_name
                                FROM table_product t1
                                JOIN table_end_category t2 ON t1.ecat_id = t2.ecat_id
                                JOIN table_mid_category t3 ON t2.mcat_id = t3.mcat_id
                                JOIN table_top_category t4 ON t3.tcat_id = t4.tcat_id
                                ORDER BY t1.p_id DESC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // Đổ dữ liệu vào Excel
        $rowIndex = 2;
        $i = 0;
        foreach ($result as $row) {
            $i++;
            $imageName = basename($row['p_featured_photo']); // Chỉ lấy tên file

            // Lấy danh sách kích thước
            $sizeQuery = $pdo->prepare("SELECT size_name FROM table_size ts 
                                        JOIN table_product_size ps ON ts.size_id = ps.size_id
                                        WHERE ps.p_id = ?");
            $sizeQuery->execute([$row['p_id']]);
            $sizes = implode(', ', $sizeQuery->fetchAll(PDO::FETCH_COLUMN));

            // Lấy danh sách màu sắc
            $colorQuery = $pdo->prepare("SELECT color_name FROM table_color tc 
                                        JOIN table_product_color pc ON tc.color_id = pc.color_id
                                        WHERE pc.p_id = ?");
            $colorQuery->execute([$row['p_id']]);
            $colors = implode(', ', $colorQuery->fetchAll(PDO::FETCH_COLUMN));

            // Lấy danh sách ảnh khác
            $photoQuery = $pdo->prepare("SELECT photo FROM table_product_photo WHERE p_id = ?");
            $photoQuery->execute([$row['p_id']]);
            $otherPhotoNames = implode(', ', array_map(fn($photo) => basename($photo), $photoQuery->fetchAll(PDO::FETCH_COLUMN)));

            $sheet->setCellValue('A' . $rowIndex, $i);
            $sheet->setCellValue('B' . $rowIndex, $row['tcat_name']);
            $sheet->setCellValue('C' . $rowIndex, $row['mcat_name']);
            $sheet->setCellValue('D' . $rowIndex, $row['ecat_name']);
            $sheet->setCellValue('E' . $rowIndex, $row['p_name']);
            $sheet->setCellValue('F' . $rowIndex, $row['p_old_price']);
            $sheet->setCellValue('G' . $rowIndex, $row['p_current_price']);
            $sheet->setCellValue('H' . $rowIndex, $row['p_qty']);
            $sheet->setCellValue('I' . $rowIndex, $sizes);
            $sheet->setCellValue('J' . $rowIndex, $colors);
            $sheet->setCellValue('K' . $rowIndex, $imageName);
            $sheet->setCellValue('L' . $rowIndex, $otherPhotoNames);
            $sheet->setCellValue('M' . $rowIndex, $row['p_description']);
            $sheet->setCellValue('N' . $rowIndex, $row['p_short_description']);
            $sheet->setCellValue('O' . $rowIndex, $row['p_feature']);
            $sheet->setCellValue('P' . $rowIndex, $row['p_return_policy']);
            $sheet->setCellValue('Q' . $rowIndex, $row['p_is_featured'] ? 'Có' : 'Không');
            $sheet->setCellValue('R' . $rowIndex, $row['p_is_active'] ? 'Có' : 'Không');

            $rowIndex++;
        }

        ob_end_clean(); // Xóa hết dữ liệu đệm
        ob_start(); // Bắt đầu bộ nhớ đệm mới
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="export_san_pham.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
    // ✅ CHỨC NĂNG NHẬP EXCEL
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
        array_reverse($rows);
        foreach ($rows as $index => $cells) {
            if ($index == 0) continue; // bỏ dòng tiêu đề

            list($stt, $tenDML, $tenDMTB, $tenDMC, $tenSP, $giaCu, $giaHienTai, $soLuong, $kichthuoc, $mausac, $anhDaiDien, $anhkhac, $moTa, $moTaNgan, $tinhNang, $chinhSach, $noiBat, $hoatDong) = $cells;

            // ✅ Bỏ qua nếu thiếu bất kỳ trường bắt buộc nào
            if (
                empty($tenDML) ||
                empty($tenDMTB) ||
                empty($tenDMC) ||
                empty($tenSP) ||
                empty($giaHienTai) ||
                empty($soLuong)
            ) {
                continue;
            }

            // 🔁 Chuyển đổi "Có"/"Không" thành 1/0
            $noiBat = ($noiBat == "Có") ? 1 : 0;
            $hoatDong = ($hoatDong == "Có") ? 1 : 0;

            // 🔍 Tìm ecat_id như cũ
            $stmt = $pdo->prepare("SELECT ecat_id FROM table_end_category WHERE ecat_name = ?");
            $stmt->execute([$tenDMC]);
            $ecatID = $stmt->fetchColumn();

            if (!$ecatID) continue;

            // ✅ Gán giá trị NULL nếu các trường này trống
            $giaCu = $giaCu ?: '';
            $anhDaiDien = $anhDaiDien ?: '';
            $moTa = $moTa ?: '';
            $moTaNgan = $moTaNgan ?: '';
            $tinhNang = $tinhNang ?: '';
            $chinhSach = $chinhSach ?: '';

            // 📥 Insert sản phẩm
            $query = $pdo->prepare("INSERT INTO table_product (
            p_name, p_old_price, p_current_price, p_qty, p_featured_photo,
            p_description, p_short_description, p_feature, p_return_policy,
            p_is_featured, p_is_active, ecat_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $query->execute([
                $tenSP,
                $giaCu,
                $giaHienTai,
                $soLuong,
                $anhDaiDien,
                $moTa,
                $moTaNgan,
                $tinhNang,
                $chinhSach,
                $noiBat,
                $hoatDong,
                $ecatID
            ]);

            // Lấy p_id của sản phẩm vừa thêm
            $p_id = $pdo->lastInsertId();

            // Thêm dữ liệu vào bảng table_product_size nếu có size
            if (!empty($kichthuoc)) {
                $sizes = explode(',', $kichthuoc); // Nếu có nhiều size, chia thành mảng
                foreach ($sizes as $size) {
                    $sizeStmt = $pdo->prepare("SELECT size_id FROM table_size WHERE size_name = ?");
                    $sizeStmt->execute([trim($size)]);
                    $sizeID = $sizeStmt->fetchColumn();
                    if ($sizeID) {
                        $sizeQuery = $pdo->prepare("INSERT INTO table_product_size (size_id, p_id) VALUES (?, ?)");
                        $sizeQuery->execute([$sizeID, $p_id]);
                    }
                }
            }

            // Thêm dữ liệu vào bảng table_product_color nếu có màu sắc
            if (!empty($mausac)) {
                $colors = explode(',', $mausac); // Nếu có nhiều màu, chia thành mảng
                foreach ($colors as $color) {
                    $colorStmt = $pdo->prepare("SELECT color_id FROM table_color WHERE color_name = ?");
                    $colorStmt->execute([trim($color)]);
                    $colorID = $colorStmt->fetchColumn();
                    if ($colorID) {
                        $colorQuery = $pdo->prepare("INSERT INTO table_product_color (color_id, p_id) VALUES (?, ?)");
                        $colorQuery->execute([$colorID, $p_id]);
                    }
                }
            }

            // Thêm ảnh vào bảng table_product_photo nếu có ảnh khác
            if (!empty($anhkhac)) {
                $photoQuery = $pdo->prepare("INSERT INTO table_product_photo (photo, p_id) VALUES (?, ?)");
                $photoQuery->execute([$anhkhac, $p_id]);
            }
        }

        echo "<script>localStorage.setItem('toastMessage', 'Nhập thành công'); window.location.href='product.php';</script>";
    }
}
?>
<?php
if (isset($_POST['clear_all'])) {
    try {
        $pdo->beginTransaction();
        $pdo->exec("DELETE FROM table_product_photo");
        $pdo->exec("DELETE FROM table_product_size");
        $pdo->exec("DELETE FROM table_product_color");
        $pdo->exec("DELETE FROM table_product");
        $pdo->commit();
        echo "<script>localStorage.setItem('toastMessage', 'Đã xóa toàn bộ dữ liệu!'); window.location.href='product.php';</script>";
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "<script>showToast('error', 'Lỗi khi xóa dữ liệu!');</script>";
    }
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Danh Sách Sản Phẩm</h1>
    </div>
    <div class="content-header-right">
        <form method="post" enctype="multipart/form-data" action="">
            <button type="button" id="clear_all" class="btn btn-danger">Xóa Tất Cả</button>
            <button type="submit" name="export_excel" class="btn btn-success">Xuất Excel</button>
            <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" style="display: none;">
            <button type="button" id="import_button" class="btn btn-success">Nhập Excel</button>
            <button type="submit" id="import_excel" name="import_excel" class="btn btn-success" style="display: none;">Xác nhận nhập</button>
        </form>
        <a href="product-add.php" class="btn btn-primary btn-sm">Thêm Sản Phẩm</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá Cũ</th>
                                <th>Giá Hiện Tại</th>
                                <th>Số Lượng</th>
                                <th>Nổi Bật?</th>
                                <th>Hoạt Động?</th>
                                <th>Danh Mục</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $query = $pdo->prepare("SELECT t1.p_id, t1.p_name, t1.p_old_price, t1.p_current_price, t1.p_qty, t1.p_featured_photo, t1.p_is_featured, t1.p_is_active, t4.tcat_name, t3.mcat_name, t2.ecat_name 
                                                    FROM table_product t1
                                                    JOIN table_end_category t2 ON t1.ecat_id = t2.ecat_id
                                                    JOIN table_mid_category t3 ON t2.mcat_id = t3.mcat_id
                                                    JOIN table_top_category t4 ON t3.tcat_id = t4.tcat_id
                                                    ORDER BY t1.p_id DESC");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><img src="../assets/uploads/product_photos/<?= $row['p_featured_photo']; ?>"
                                            alt="<?= $row['p_name']; ?>" style="width:80px;"></td>
                                    <td><?= $row['p_name']; ?></td>
                                    <td>$<?= $row['p_old_price']; ?></td>
                                    <td>$<?= $row['p_current_price']; ?></td>
                                    <td><?= $row['p_qty']; ?></td>
                                    <td><span class="badge"
                                            style="background-color:<?= $row['p_is_featured'] ? 'green' : 'red'; ?>;"><?= $row['p_is_featured'] ? 'Có' : 'Không'; ?></span>
                                    </td>
                                    <td><span class="badge"
                                            style="background-color:<?= $row['p_is_active'] ? 'green' : 'red'; ?>;"><?= $row['p_is_active'] ? 'Có' : 'Không'; ?></span>
                                    </td>
                                    <td><?= $row['tcat_name']; ?><br><?= $row['mcat_name']; ?><br><?= $row['ecat_name']; ?>
                                    </td>
                                    <td>
                                        <a href="product-edit.php?id=<?= $row['p_id']; ?>"
                                            class="btn btn-primary btn-xs edit-btn">Sửa</a>
                                        <a href="#" class="btn btn-danger btn-xs"
                                            data-href="product-delete.php?id=<?= $row['p_id']; ?>" data-toggle="modal"
                                            data-target="#confirm-delete">Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xác Nhận Xóa</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa sản phẩm này?</p>
                <p style="color:red;">Lưu ý! Sản phẩm sẽ bị xóa khỏi tất cả đơn hàng, thanh toán, bảng kích cỡ, bảng màu
                    và bảng đánh giá.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

        $('.btn-ok').click(function(e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('href');
            $('#confirm-delete').modal('hide');
            toastr.success('Sản phẩm đã bị xóa!');
            setTimeout(() => {
                window.location.href = deleteUrl;
            }, 2000);
        });
    });
    $(document).ready(function() {
        $('.edit-btn').click(function(e) {
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
    document.getElementById("clear_all").addEventListener("click", function() {
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