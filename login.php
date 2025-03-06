<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">


                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <?php
                                if ($errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                if ($successMsg != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                                }
                                ?>
                                <div class="form-group">
                                    <label for=""><?php echo 'Email Address' ?> *</label>
                                    <input type="email" class="form-control" name="cust_email">
                                </div>
                                <div class="form-group">
                                    <label for=""><?php echo 'Password' ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                </div>
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-success" value="<?php echo 'Submit' ?>"
                                        name="form1">
                                </div>
                                <a href="forget-password.php"
                                    style="color:#e4144d;"><?php echo 'Forget Password' ?>?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>