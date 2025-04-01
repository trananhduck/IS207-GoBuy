<?php require_once('header.php'); ?>
<!-- Nhúng tệp header.php vào trang -->
<?php
require_once '../vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// ✅ CHỨC NĂNG XUẤT EXCEL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['export_excel'])) {
        // Khởi tạo file Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Đặt tiêu đề cột
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Hình Ảnh');
        $sheet->setCellValue('C1', 'Tiêu Đề');
        $sheet->setCellValue('D1', 'Nội Dung');
        $sheet->setCellValue('E1', 'Nút Bấm');
        $sheet->setCellValue('F1', 'Link Nút Bấm');
        $sheet->setCellValue('G1', 'Vị Trí');

        // Kết nối database và lấy dữ liệu từ bảng `table_slider`
        $stmt = $pdo->prepare("SELECT * FROM table_slider");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Ghi dữ liệu vào từng hàng của Excel
        $rowIndex = 2;
        foreach ($rows as $row) {
            $sheet->setCellValue("A$rowIndex", $row['id']);
            $sheet->setCellValue("B$rowIndex", $row['photo']);
            $sheet->setCellValue("C$rowIndex", $row['heading']);
            $sheet->setCellValue("D$rowIndex", $row['content']);
            $sheet->setCellValue("E$rowIndex", $row['button_text']);
            $sheet->setCellValue("F$rowIndex", $row['button_url']);
            $sheet->setCellValue("G$rowIndex", $row['position']);
            $rowIndex++;
        }

        // Xuất file Excel về cho người dùng
        ob_end_clean(); // Xóa dữ liệu đệm tránh lỗi
        ob_start(); // Bắt đầu bộ nhớ đệm mới
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="export_slider.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit();
    }
}
?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Danh sách Slider</h1> <!-- Tiêu đề trang -->
    </div>
    <div class="content-header-right">
        <form method="post" enctype="multipart/form-data" action="">
            <button type="submit" name="export_excel" class="btn btn-success">Xuất Excel</button>
        </form>
        <a href="slider-add.php" class="btn btn-primary btn-sm">Thêm Slider</a> <!-- Nút thêm mới Slider -->
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
                                <th>STT</th> <!-- Cột số thứ tự -->
                                <th>Ảnh</th> <!-- Cột hiển thị ảnh -->
                                <th>Tiêu đề</th> <!-- Cột hiển thị tiêu đề slider -->
                                <th>Nội dung</th> <!-- Cột hiển thị nội dung slider -->
                                <th>Văn bản nút</th> <!-- Cột hiển thị chữ trên nút -->
                                <th>Đường dẫn nút</th> <!-- Cột hiển thị URL của nút -->
                                <th>Vị trí</th> <!-- Cột hiển thị vị trí của slider -->
                                <th width="140">Hành động</th> <!-- Cột chứa các hành động (sửa, xóa) -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            // Truy vấn danh sách slider từ cơ sở dữ liệu
                            $query = $pdo->prepare("SELECT id,photo,heading,content,button_text,button_url,position FROM table_slider");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);

                            // Lặp qua danh sách slider và hiển thị lên bảng
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td> <!-- Hiển thị số thứ tự -->
                                    <td style="width:150px;">
                                        <img src="../assets/uploads/<?php echo $row['photo']; ?>"
                                            alt="<?php echo $row['heading']; ?>" style="width:140px;">
                                    </td> <!-- Hiển thị ảnh slider -->
                                    <td><?php echo $row['heading']; ?></td> <!-- Hiển thị tiêu đề -->
                                    <td><?php echo $row['content']; ?></td> <!-- Hiển thị nội dung -->
                                    <td><?php echo $row['button_text']; ?></td> <!-- Hiển thị chữ trên nút -->
                                    <td><?php echo $row['button_url']; ?></td> <!-- Hiển thị URL của nút -->
                                    <td><?php echo $row['position']; ?></td> <!-- Hiển thị vị trí slider -->
                                    <td>
                                        <a href="slider-edit.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-primary btn-xs edit-btn">Sửa</a> <!-- Nút sửa -->
                                        <a href="#" class="btn btn-danger btn-xs"
                                            data-href="slider-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal"
                                            data-target="#confirm-delete">Xóa</a> <!-- Nút xóa -->
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

<!-- Hộp thoại xác nhận xóa -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa mục này không?</p> <!-- Câu hỏi xác nhận xóa -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button> <!-- Nút hủy -->
                <a class="btn btn-danger btn-ok" id="confirm-delete-btn">Xóa</a> <!-- Nút xác nhận xóa -->
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
</script>
<?php require_once('footer.php'); ?>
<!-- Nhúng tệp footer.php vào trang -->