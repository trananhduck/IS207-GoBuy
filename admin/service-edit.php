<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;

    if (empty($_POST['title'])) {
        $valid = 0;
        $errorMsg .= 'Title can not be empty<br>';
    }

    if (empty($_POST['content'])) {
        $valid = 0;
        $errorMsg .= 'Content can not be empty<br>';
    }


    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $file_name = basename($path, '.' . $ext);
        if ($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg' && $ext != 'gif') {
            $valid = 0;
            $errorMsg .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if ($valid == 1) {

        if ($path == '') {
            $querry = $pdo->prepare("UPDATE table_service SET title=?, content=? WHERE id=?");
            $querry->execute(array($_POST['title'], $_POST['content'], $_REQUEST['id']));
        } else {

            unlink('../assets/uploads/' . $_POST['current_photo']);

            $final_name = 'service-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);

            $querry = $pdo->prepare("UPDATE table_service SET title=?, content=?, photo=? WHERE id=?");
            $querry->execute(array($_POST['title'], $_POST['content'], $final_name, $_REQUEST['id']));
        }

        $successMsg = 'Service is updated successfully!';
    }
}
?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    $result = $querry->fetchAll(PDO::FETCH_ASSOC);
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Service</h1>
    </div>
    <div class="content-header-right">
        <a href="service.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<?php
$querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $title = $row['title'];
    $content = $row['content'];
    $photo = $row['photo'];
}
?>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php if ($errorMsg): ?>
                <div class="callout callout-danger">
                    <p>
                        <?php echo $errorMsg; ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if ($successMsg): ?>
                <div class="callout callout-success">
                    <p><?php echo $successMsg; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="title"
                                    value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="content"
                                    style="height:140px;"><?php echo $content; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Photo</label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <img src="../assets/uploads/<?php echo $photo; ?>" alt="Service Photo"
                                    style="width:180px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo </label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" name="photo">(Only jpg, jpeg, gif and png are allowed)
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</section>