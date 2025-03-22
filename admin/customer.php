<?php require_once('header.php'); ?>

<!-- Phần tiêu đề nội dung -->
<section class="content-header">
    <div class="content-header-left">
        <h1>Xem Khách Hàng</h1> <!-- Tiêu đề trang -->
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
                                <th width="10">#</th>
                                <th width="180">Tên</th>
                                <th width="150">Địa chỉ Email</th>
                                <th width="180">Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th width="100">Đổi Trạng thái</th>
                                <th width="100">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            // Truy vấn lấy danh sách khách hàng và thông tin quốc gia của họ
                            $query = $pdo->prepare("SELECT * 
                                                        FROM table_customer t1
                                                        JOIN table_province t2
                                                        ON t1.cust_province = t2.province_id
                                                    ");
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
                                <td><?php echo $row['cust_name']; ?></td>
                                <td><?php echo $row['cust_email']; ?></td>
                                <td>
                                    <?php echo $row['province_name']; ?><br>
                                    <?php echo $row['cust_district']; ?><br>
                                    <?php echo $row['cust_address']; ?><br>
                                </td>
                                <td><?php if ($row['cust_status'] == 1) {
                                            echo 'Hoạt động';
                                        } else {
                                            echo 'Không hoạt động';
                                        } ?>
                                </td>
                                <td>
                                    <a href="customer-change-status.php?id=<?php echo $row['cust_id']; ?>"
                                        class="btn btn-success btn-xs">Đổi trạng thái</a>
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
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>