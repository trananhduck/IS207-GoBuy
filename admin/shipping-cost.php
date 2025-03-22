<?php require_once('header.php'); ?>

<?php

if (isset($_POST['form1'])) {
    $valid = 1;
    if (empty($_POST['province_id'])) {
        $valid = 0;
        $errorMsg .= 'Bạn phải chọn một tỉnh.<br>';
    }

    if ($_POST['amount'] == '') {
        $valid = 0;
        $errorMsg .= 'Số tiền không được để trống.<br>';
    } else {
        if (!is_numeric($_POST['amount'])) {
            $valid = 0;
            $errorMsg .= 'Bạn phải nhập một số hợp lệ.<br>';
        }
    }

    if ($valid == 1) {
        $query = $pdo->prepare("INSERT INTO table_shipping_cost (province_id,amount) VALUES (?,?)");
        $query->execute(array($_POST['province_id'], $_POST['amount']));

        $successMsg = 'Chi phí vận chuyển đã được thêm thành công.';
    }
}

if (isset($_POST['form2'])) {
    $valid = 1;

    if ($_POST['amount'] == '') {
        $valid = 0;
        $errorMsg .= 'Số tiền không được để trống.<br>';
    } else {
        if (!is_numeric($_POST['amount'])) {
            $valid = 0;
            $errorMsg .= 'Bạn phải nhập một số hợp lệ.<br>';
        }
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Thêm chi phí vận chuyển</h1>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($errorMsg): ?>
                <div class="callout callout-danger">
                    <p><?php echo $errorMsg; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($successMsg): ?>
                <div class="callout callout-success">
                    <p><?php echo $successMsg; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Chọn tỉnh <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="province_id" class="form-control select2">
                                    <option value="">Chọn một tỉnh</option>
                                    <?php
                                    $query = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        $query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE province_id=?");
                                        $query->execute(array($row['province_id']));
                                        $total = $query->rowCount();
                                        if ($total) {
                                            continue;
                                        }
                                    ?>
                                        <option value="<?php echo $row['province_id']; ?>">
                                            <?php echo $row['province_name']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Số tiền <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Thêm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="content-header">
    <div class="content-header-left">
        <h1>Xem chi phí vận chuyển</h1>
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
                                <th>#</th>
                                <th>Tên tỉnh</th>
                                <th>Chi phí vận chuyển</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $query = $pdo->prepare("SELECT * FROM table_shipping_cost t1 JOIN table_province t2 ON t1.province_id = t2.province_id ORDER BY t2.province_name ASC");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $row) {
                                $i++;
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['province_name']; ?></td>
                                    <td><?php echo $row['amount']; ?></td>
                                    <td>
                                        <a href="shipping-cost-edit.php?id=<?php echo $row['shipping_cost_id']; ?>"
                                            class="btn btn-primary btn-xs">Sửa</a>
                                        <a href="#" class="btn btn-danger btn-xs"
                                            data-href="shipping-cost-delete.php?id=<?php echo $row['shipping_cost_id']; ?>"
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Xác nhận xóa</h4>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa mục này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <a class="btn btn-danger btn-ok">Xóa</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>