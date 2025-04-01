<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Tất cả danh mục con</h1>
    </div>
    <div class="content-header-right">
        <a href="end-category-add.php" class="btn btn-primary btn-sm">Thêm Mới</a>
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
                                <th>STT</th>
                                <th>Tên danh mục con</th>
                                <th>Tên danh mục trung gian</th>
                                <th>Tên danh mục lớn</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $statement = $pdo->prepare("SELECT * 
                                    FROM table_end_category t1
                                    JOIN table_mid_category t2
                                    ON t1.mcat_id = t2.mcat_id
                                    JOIN table_top_category t3
                                    ON t2.tcat_id = t3.tcat_id
                                    ORDER BY t1.ecat_id DESC
                                    ");
                            $statement->execute();
                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['ecat_name']; ?></td>
                                <td><?php echo $row['mcat_name']; ?></td>
                                <td><?php echo $row['tcat_name']; ?></td>
                                <td>
                                    <a href="end-category-edit.php?id=<?php echo $row['ecat_id']; ?>"
                                        class="btn btn-primary btn-xs edit-btn">Sửa</a>
                                    <a href="#" class="btn btn-danger btn-xs"
                                        data-href="end-category-delete.php?id=<?php echo $row['ecat_id']; ?>"
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
                <p>Bạn có chắc chắn muốn xóa mục này?</p>
                <p style="color:red;">Hãy cẩn thận! Tất cả sản phẩm thuộc danh mục cấp cuối này sẽ bị xóa khỏi tất cả
                    các bảng như bảng đơn hàng, bảng thanh toán, bảng kích thước, bảng màu sắc, bảng đánh giá, v.v.</p>
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
</script>
<?php require_once('footer.php'); ?>