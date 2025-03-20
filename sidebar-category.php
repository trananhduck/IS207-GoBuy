<h3><?php echo 'Các danh mục' ?></h3>
<div id="left" class="span3">

    <ul id="menu-group-1" class="nav menu">
        <?php
        $i = 0;
        // Truy vấn danh mục cấp 1 từ bảng table_top_category (danh mục chính)
        $query = $pdo->prepare("SELECT * FROM table_top_category WHERE show_on_menu=1");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        // Lặp qua từng danh mục cấp 1
        foreach ($result as $row) {
            $i++;
        ?>
        <li class="cat-level-1 deeper parent">
            <a class="" href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category">
                <span data-toggle="collapse" data-parent="#menu-group-1" href="#cat-lvl1-id-<?php echo $i; ?>"
                    class="sign"><i class="fa fa-plus"></i></span>
                <span class="lbl"><?php echo $row['tcat_name']; ?></span>
            </a>
            <ul class="children nav-child unstyled small collapse" id="cat-lvl1-id-<?php echo $i; ?>">
                <?php
                    $j = 0;
                    // Truy vấn danh mục cấp 2 từ bảng table_mid_category (danh mục trung gian)
                    $query1 = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id=?");
                    $query1->execute(array($row['tcat_id']));
                    $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);

                    // Lặp qua từng danh mục cấp 2
                    foreach ($result1 as $row1) {
                        $j++;
                    ?>
                <li class="deeper parent">
                    <a class="" href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category">
                        <span data-toggle="collapse" data-parent="#menu-group-1"
                            href="#cat-lvl2-id-<?php echo $i . $j; ?>" class="sign"><i class="fa fa-plus"></i></span>
                        <span class="lbl lbl1"><?php echo $row1['mcat_name']; ?></span>
                    </a>
                    <ul class="children nav-child unstyled small collapse" id="cat-lvl2-id-<?php echo $i . $j; ?>">
                        <?php
                                $k = 0; // Biến đếm cho danh mục cấp 3
                                // Truy vấn danh mục cấp 3 từ bảng table_end_category (danh mục con)
                                $query2 = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id=?");
                                $query2->execute(array($row1['mcat_id']));
                                $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                                // Lặp qua từng danh mục cấp 3
                                foreach ($result2 as $row2) {
                                    $k++;
                                ?>
                        <li class="item-<?php echo $i . $j . $k; ?>">
                            <a class=""
                                href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category">
                                <span class="sign"></span>
                                <span class="lbl lbl1"><?php echo $row2['ecat_name']; ?></span>
                            </a>
                        </li>
                        <?php
                                } // Kết thúc vòng lặp danh mục cấp 3
                                ?>
                    </ul>
                </li>
                <?php
                    } // Kết thúc vòng lặp danh mục cấp 2
                    ?>
            </ul>
        </li>
        <?php
        } // Kết thúc vòng lặp danh mục cấp 1
        ?>
    </ul>

</div>