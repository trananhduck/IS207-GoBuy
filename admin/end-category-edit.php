<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải chọn danh mục lớn<br>');
            });
            </script>";
    }

    if(empty($_POST['mcat_id'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Bạn phải chọn danh mục trung gian<br>');
            });
            </script>";
    }

    if(empty($_POST['ecat_name'])) {
        $valid = 0;
        echo "<script>
            $(document).ready(function() {
                toastr.error('Tên danh mục con không được để trống<br>');
            });
            </script>";
    }

    if($valid == 1) {    	
		// cập nhật vào cơ sở dữ liệu
		$query = $pdo->prepare("UPDATE table_end_category SET ecat_name=?,mcat_id=? WHERE ecat_id=?");
		$query->execute(array($_POST['ecat_name'],$_POST['mcat_id'],$_REQUEST['id']));

        echo "<script>
            $(document).ready(function() {
                toastr.success('Danh mục con đã được cập nhật thành công.');
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
	// Kiểm tra ID có hợp lệ không
	$query = $pdo->prepare("SELECT * 
                            FROM table_end_category t1
                            JOIN table_mid_category t2
                            ON t1.mcat_id = t2.mcat_id
                            JOIN table_top_category t3
                            ON t2.tcat_id = t3.tcat_id
                            WHERE t1.ecat_id=?");
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
        <h1>Chỉnh sửa danh mục con</h1>
    </div>
    <div class="content-header-right">
        <a href="end-category.php" class="btn btn-primary btn-sm">Thoát</a>
    </div>
</section>


<?php							
foreach ($result as $row) {
	$ecat_name = $row['ecat_name'];
    $mcat_id = $row['mcat_id'];
    $tcat_id = $row['tcat_id'];
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
                            <label for="" class="col-sm-3 control-label">Tên danh mục lớn
                                <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="tcat_id" class="form-control select2 top-cat">
                                    <option value="">Chọn danh mục lớn</option>
                                    <?php
                            $query = $pdo->prepare("SELECT * FROM table_top_category ORDER BY tcat_name ASC");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);   
                            foreach ($result as $row) {
                                ?>
                                    <option value="<?php echo $row['tcat_id']; ?>"
                                        <?php if($row['tcat_id'] == $tcat_id){echo 'selected';} ?>>
                                        <?php echo $row['tcat_name']; ?></option>
                                    <?php
                            }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục trung gian <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="mcat_id" class="form-control select2 mid-cat">
                                    <option value="">Chọn danh mục trung gian</option>
                                    <?php
                            $query = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id = ? ORDER BY mcat_name ASC");
                            $query->execute(array($tcat_id));
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);   
                            foreach ($result as $row) {
                                ?>
                                    <option value="<?php echo $row['mcat_id']; ?>"
                                        <?php if($row['mcat_id'] == $mcat_id){echo 'selected';} ?>>
                                        <?php echo $row['mcat_name']; ?></option>
                                    <?php
                            }
                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên danh mục con <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="ecat_name"
                                    value="<?php echo $ecat_name; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label"></label>
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