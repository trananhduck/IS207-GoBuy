<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">



                    <form action="" method="post">
                        <?php $csrf->echoInputField(); ?>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">

                                <?php
                                if ($errorMsg != '') {
                                    echo "<div class='error' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $errorMsg . "</div>";
                                }
                                if ($successMsg != '') {
                                    echo "<div class='success' style='padding: 10px;background:#f1f1f1;margin-bottom:20px;'>" . $successMsg . "</div>";
                                }
                                ?>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Tên đầy đủ' ?> *</label>
                                    <input type="text" class="form-control" name="cust_name" value="<?php if (isset($_POST['cust_name'])) {
                                                                                                        echo $_POST['cust_name'];
                                                                                                    } ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Địa chỉ email' ?> *</label>
                                    <input type="email" class="form-control" name="cust_email" value="<?php if (isset($_POST['cust_email'])) {
                                                                                                            echo $_POST['cust_email'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Số điện thoại' ?> *</label>
                                    <input type="text" class="form-control" name="cust_phone" value="<?php if (isset($_POST['cust_phone'])) {
                                                                                                            echo $_POST['cust_phone'];
                                                                                                        } ?>">
                                </div>
                                <div class=" col-md-6 form-group">
                                    <label for=""><?php echo 'Tỉnh/thành phố' ?> *</label>
                                    <select name="cust_province" class="form-control select2">
                                        <option value="">Chọn tỉnh/thành phố</option>
                                        <?php
                                        $querry = $pdo->prepare("SELECT * FROM table_province ORDER BY province_name ASC");
                                        $querry->execute();
                                        $result = $querry->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                        ?>
                                        <option value="<?php echo $row['province_id']; ?>">
                                            <?php echo $row['province_name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Quận/huyện' ?> *</label>
                                    <input type="text" class="form-control" name="cust_district" value="<?php if (isset($_POST['cust_district'])) {
                                                                                                            echo $_POST['cust_district'];
                                                                                                        } ?>">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Xã/thị trấn' ?> *</label>
                                    <input type="text" class="form-control" name="cust_address" value="<?php if (isset($_POST['cust_address'])) {
                                                                                                            echo $_POST['cust_address'];
                                                                                                        } ?>">
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="cust_password">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""><?php echo 'Nhập lại mật khẩu' ?> *</label>
                                    <input type="password" class="form-control" name="cust_re_password">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for=""></label>
                                    <input type="submit" class="btn btn-danger" value="<?php echo 'Đăng ký' ?>"
                                        name="form1">
                                </div>
                            </div>


                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>