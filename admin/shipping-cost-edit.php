<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;
    if(empty($_POST['province_id'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải chọn một tỉnh<br>');
            });
            </script>";
    } else {
		// Kiểm tra tỉnh trùng lặp
    	// tỉnh hiện tại trong cơ sở dữ liệu
    	$query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE shipping_cost_id=?");
		$query->execute(array($_REQUEST['id']));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$cur_province = $row['province_id'];
		}
		$query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE province_id=? and province_id!=?");
    	$query->execute(array($_POST['province_id'],$cur_province));
    	$total = $query->rowCount();							
    	if($total) {
    		$valid = 0;
            echo "<script>
            $(document).ready(function() {
                toastr.error('Tỉnh này đã tồn tại<br>');
            });
            </script>";
    	}
    }
    if($valid == 1) {    	
		// Cập nhật vào cơ sở dữ liệu
		$query = $pdo->prepare("UPDATE table_shipping_cost SET province_id=?,amount=? WHERE shipping_cost_id=?");
		$query->execute(array($_POST['province_id'],$_POST['amount'],$_REQUEST['id']));
        echo "<script>
            $(document).ready(function() {
                toastr.success('Cập nhật chi phí vận chuyển thành công.');
            });
        </script>";
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Kiểm tra ID có hợp lệ hay không
	$query = $pdo->prepare("SELECT * FROM table_shipping_cost WHERE shipping_cost_id=?");
	$query->execute(array($_REQUEST['id']));
	$total = $query->rowCount();
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Sửa chi phí vận chuyển</h1>
    </div>
    <div class="content-header-right">
        <a href="shipping-cost.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>

<?php
foreach ($result as $row) {
	$province_id = $row['province_id'];
    $amount = $row['amount'];
}
?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if($errorMsg): ?>
            <div class="callout callout-danger">
                <p>
                    <?php echo $errorMsg; ?>
                </p>
            </div>
            <?php endif; ?>
            <?php if($successMsg): ?>
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
                                    ?>
                                    <option value="<?php echo $row['province_id']; ?>"
                                        <?php if($row['province_id'] == $province_id) {echo 'selected';} ?>>
                                        <?php echo $row['province_name']; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Chi phí <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Cập nhật</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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