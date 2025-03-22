<?php require_once('header.php'); ?>
<section class="content-header">
    <div class="content-header-left">
        <h1>Danh Sách Sản Phẩm</h1>
    </div>
    <div class="content-header-right">
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
                                <td><img src="../assets/uploads/<?= $row['p_featured_photo']; ?>"
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
                                        class="btn btn-primary btn-xs">Sửa</a>
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

<?php require_once('footer.php'); ?>