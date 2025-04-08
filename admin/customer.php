<?php require_once('header.php'); ?>
<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_excel'])) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Thiết lập tiêu đề cột
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Tên Khách Hàng');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'Số Điện Thoại');
    $sheet->setCellValue('E1', 'Tỉnh/Thành Phố');
    $sheet->setCellValue('F1', 'Quận/Huyện');
    $sheet->setCellValue('G1', 'Phường/Xã');
    $sheet->setCellValue('H1', 'Địa Chỉ');
    $sheet->setCellValue('I1', 'Trạng Thái');

    // Lấy dữ liệu từ database, bao gồm cả khách hàng không hoạt động
    $stmt = $pdo->prepare("SELECT t1.* FROM table_customer t1");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Đổ dữ liệu vào bảng
    $rowIndex = 2;
    foreach ($rows as $row) {
        $status = ($row['cust_status'] == 1) ? 'Hoạt động' : 'Không hoạt động';

        $sheet->setCellValue("A$rowIndex", $row['cust_id']);
        $sheet->setCellValue("B$rowIndex", $row['cust_s_name']);
        $sheet->setCellValue("C$rowIndex", $row['cust_email']);
        $sheet->setCellValue("D$rowIndex", $row['cust_s_phone']);
        $sheet->setCellValue("E$rowIndex", $row['cust_s_province']);
        $sheet->setCellValue("F$rowIndex", $row['cust_s_district']);
        $sheet->setCellValue("G$rowIndex", $row['cust_s_ward']);
        $sheet->setCellValue("H$rowIndex", $row['cust_s_address']);
        $sheet->setCellValue("I$rowIndex", $status);

        $rowIndex++;
    }

    // Xuất file Excel
    ob_end_clean();
    ob_start();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="customer_list.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
?>
<!-- Phần tiêu đề nội dung -->
<section class="content-header">
    <div class="content-header-left">
        <h1>Xem Khách Hàng</h1> <!-- Tiêu đề trang -->
    </div>
    <div class="content-header-right">
        <form method="post" enctype="multipart/form-data" action="">
            <button type="submit" name="export_excel" class="btn btn-success">Xuất Excel</button>
        </form>
    </div>
</section>

<!-- Phần nội dung chính -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <!-- Bảng hiển thị danh sách khách hàng -->
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="10">STT</th>
                                <th width="180">Tên</th>
                                <th width="150">Địa chỉ Email</th>
                                <th width="180">Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th width="100">Thay đổi Trạng thái</th>
                                <th width="100">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            // Truy vấn lấy danh sách khách hàng và thông tin quốc gia của họ
                            $query = $pdo->prepare("SELECT * FROM table_customer");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr class="<?php if ($row['cust_status'] == 1) {
                                                echo 'bg-g';
                                            } else {
                                                echo 'bg-r';
                                            } ?>">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['cust_s_name']; ?></td>
                                    <td><?php echo $row['cust_email']; ?></td>
                                    <td>
                                        <?php echo $row['cust_s_address']; ?>,
                                        <?php echo $row['cust_s_ward']; ?>,
                                        <?php echo $row['cust_s_district']; ?>,
                                        <?php echo $row['cust_s_province']; ?>
                                    </td>
                                    <td><?php if ($row['cust_status'] == 1) {
                                            echo 'Hoạt động';
                                        } else {
                                            echo 'Không hoạt động';
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="customer-change-status.php?id=<?php echo $row['cust_id']; ?>"
                                            class="btn btn-success btn-xs confirm-btn">Thay đổi Trạng thái</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs"
                                            data-href="customer-delete.php?id=<?php echo $row['cust_id']; ?>"
                                            data-toggle="modal" data-target="#confirm-delete">Xóa</a>
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
                <h4 class="modal-title" id="myModalLabel">Xác nhận Xóa</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa mục này không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok confirm-btn">Xóa</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.confirm-btn').click(function(e) {
            e.preventDefault();
            toastr.success("Xóa thành công!");
            setTimeout(function() {
                window.location.href = $('.btn-ok').attr('href');
            }, 2000); // Chuyển hướng sau 2 giây
        });
    });
    $(document).ready(function() {
        $('.confirm-btn').click(function(e) {
            e.preventDefault();
            toastr.success("Cập nhập thành công!");
            setTimeout(function() {
                window.location.href = $('.btn-xs').attr('href');
            }, 2000); // Chuyển hướng sau 2 giây
        });
    });
</script>
<?php require_once('footer.php'); ?>