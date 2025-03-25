<h3><?php echo 'Các danh mục' ?></h3>
<div id="left" class="span3">
    <ul id="menu-group-1" class="nav menu">
        <?php
        $i = 0;
        
        // Lấy type và id từ URL
        $current_type = isset($_GET['type']) ? $_GET['type'] : '';
        $current_id = isset($_GET['id']) ? $_GET['id'] : 0;
        
        // Xác định top-category hiện tại
        $current_top_category = 0;
        
        if($current_type == 'top-category') {
            $current_top_category = $current_id;
        } 
        elseif($current_type == 'mid-category' && $current_id > 0) {
            // Lấy top-category id từ mid-category hiện tại
            $query_parent = $pdo->prepare("SELECT tcat_id FROM table_mid_category WHERE mcat_id = ?");
            $query_parent->execute(array($current_id));
            $parent_result = $query_parent->fetch(PDO::FETCH_ASSOC);
            
            if($parent_result) {
                $current_top_category = $parent_result['tcat_id'];
            }
        }
        elseif($current_type == 'end-category' && $current_id > 0) {
            // Lấy mid-category id từ end-category hiện tại
            $query_mid = $pdo->prepare("SELECT mcat_id FROM table_end_category WHERE ecat_id = ?");
            $query_mid->execute(array($current_id));
            $mid_result = $query_mid->fetch(PDO::FETCH_ASSOC);
            
            if($mid_result) {
                // Lấy top-category id từ mid-category
                $query_top = $pdo->prepare("SELECT tcat_id FROM table_mid_category WHERE mcat_id = ?");
                $query_top->execute(array($mid_result['mcat_id']));
                $top_result = $query_top->fetch(PDO::FETCH_ASSOC);
                
                if($top_result) {
                    $current_top_category = $top_result['tcat_id'];
                }
            }
        }
        
        // Nếu đã xác định được top-category (đang ở trang top-category hoặc mid-category/end-category thuộc top-category nào đó)
        if($current_top_category > 0) {
            // Lấy tên của top-category hiện tại
            $query_tcat = $pdo->prepare("SELECT tcat_name FROM table_top_category WHERE tcat_id = ?");
            $query_tcat->execute(array($current_top_category));
            $tcat_name = $query_tcat->fetch(PDO::FETCH_ASSOC);
            
            if($tcat_name) {
                echo '<li class="cat-level-1 deeper parent active">';
                echo '<a class="active" href="product-category.php?id='.$current_top_category.'&type=top-category">';
                echo '<span class="lbl">'.$tcat_name['tcat_name'].'</span>';
                echo '</a>';
                echo '<ul class="children nav-child unstyled small collapse in" id="cat-lvl1-current" style="display:block;">';
                
                // Lấy các mid-category thuộc top-category này
                $query_mcat = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id = ?");
                $query_mcat->execute(array($current_top_category));
                $mcats = $query_mcat->fetchAll(PDO::FETCH_ASSOC);
                
                $j = 0;
                foreach($mcats as $mcat) {
                    $j++;
                    // Kiểm tra nếu là mid-category hiện tại
                    $active_class_mid = ($current_type == 'mid-category' && $current_id == $mcat['mcat_id']) ? 'active' : '';
                    $collapsed_mid = ($current_type == 'mid-category' && $current_id == $mcat['mcat_id']) ? 'in' : '';
                    $display_style_mid = ($current_type == 'mid-category' && $current_id == $mcat['mcat_id']) ? 'display:block;' : '';
                    
                    echo '<li class="deeper parent ' . $active_class_mid . '">';
                    echo '<a class="' . $active_class_mid . '" href="product-category.php?id='.$mcat['mcat_id'].'&type=mid-category">';
                    echo '<span data-toggle="collapse" data-parent="#menu-group-1" href="#cat-lvl2-id-special-'.$j.'" class="sign"><i class="fa fa-plus"></i></span>';
                    echo '<span class="lbl lbl1">'.$mcat['mcat_name'].'</span>';
                    echo '</a>';
                    
                    // Lấy các end-category thuộc mid-category này
                    echo '<ul class="children nav-child unstyled small collapse ' . $collapsed_mid . '" id="cat-lvl2-id-special-'.$j.'" style="' . $display_style_mid . '">';
                    
                    $query_ecat = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id = ?");
                    $query_ecat->execute(array($mcat['mcat_id']));
                    $ecats = $query_ecat->fetchAll(PDO::FETCH_ASSOC);
                    
                    $k = 0;
                    foreach($ecats as $ecat) {
                        $k++;
                        // Kiểm tra nếu là end-category hiện tại
                        $active_class_end = ($current_type == 'end-category' && $current_id == $ecat['ecat_id']) ? 'active' : '';
                        
                        echo '<li class="item-special-'.$j.$k.' ' . $active_class_end . '">';
                        echo '<a class="' . $active_class_end . '" href="product-category.php?id='.$ecat['ecat_id'].'&type=end-category">';
                        echo '<span class="sign"></span>';
                        echo '<span class="lbl lbl1">'.$ecat['ecat_name'].'</span>';
                        echo '</a>';
                        echo '</li>';
                    }
                    
                    echo '</ul>';
                    echo '</li>';
                }
                
                echo '</ul>';
                echo '</li>';
            }
            
        } else {
            // Hiển thị menu đầy đủ nếu không xác định được top-category cụ thể
            
            // Truy vấn danh mục cấp 1 từ bảng table_top_category (danh mục chính)
            $query = $pdo->prepare("SELECT * FROM table_top_category WHERE show_on_menu=1");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            // Lặp qua từng danh mục cấp 1
            foreach ($result as $row) {
                $i++;
                // Kiểm tra nếu là top-category hiện tại
                $active_class = ($current_type == 'top-category' && $current_id == $row['tcat_id']) ? 'active' : '';
                $collapsed = ($current_type == 'top-category' && $current_id == $row['tcat_id']) ? 'in' : '';
                $display_style = ($current_type == 'top-category' && $current_id == $row['tcat_id']) ? 'display:block;' : '';
            ?>
        <li class="cat-level-1 deeper parent <?php echo $active_class; ?>">
            <a class="<?php echo $active_class; ?>"
                href="product-category.php?id=<?php echo $row['tcat_id']; ?>&type=top-category">
                <span data-toggle="collapse" data-parent="#menu-group-1" href="#cat-lvl1-id-<?php echo $i; ?>"
                    class="sign"><i class="fa fa-plus"></i></span>
                <span class="lbl"><?php echo $row['tcat_name']; ?></span>
            </a>
            <ul class="children nav-child unstyled small collapse <?php echo $collapsed; ?>"
                id="cat-lvl1-id-<?php echo $i; ?>" style="<?php echo $display_style; ?>">
                <?php
                        $j = 0;
                        // Truy vấn danh mục cấp 2 từ bảng table_mid_category (danh mục trung gian)
                        $query1 = $pdo->prepare("SELECT * FROM table_mid_category WHERE tcat_id=?");
                        $query1->execute(array($row['tcat_id']));
                        $result1 = $query1->fetchAll(PDO::FETCH_ASSOC);

                        // Lặp qua từng danh mục cấp 2
                        foreach ($result1 as $row1) {
                            $j++;
                            // Kiểm tra nếu là mid-category hiện tại
                            $active_class_mid = ($current_type == 'mid-category' && $current_id == $row1['mcat_id']) ? 'active' : '';
                            $collapsed_mid = ($current_type == 'mid-category' && $current_id == $row1['mcat_id']) ? 'in' : '';
                            $display_style_mid = ($current_type == 'mid-category' && $current_id == $row1['mcat_id']) ? 'display:block;' : '';
                        ?>
                <li class="deeper parent <?php echo $active_class_mid; ?>">
                    <a class="<?php echo $active_class_mid; ?>"
                        href="product-category.php?id=<?php echo $row1['mcat_id']; ?>&type=mid-category">
                        <span data-toggle="collapse" data-parent="#menu-group-1"
                            href="#cat-lvl2-id-<?php echo $i . $j; ?>" class="sign"><i class="fa fa-plus"></i></span>
                        <span class="lbl lbl1"><?php echo $row1['mcat_name']; ?></span>
                    </a>
                    <ul class="children nav-child unstyled small collapse <?php echo $collapsed_mid; ?>"
                        id="cat-lvl2-id-<?php echo $i . $j; ?>" style="<?php echo $display_style_mid; ?>">
                        <?php
                                    $k = 0;
                                    // Truy vấn danh mục cấp 3 từ bảng table_end_category (danh mục con)
                                    $query2 = $pdo->prepare("SELECT * FROM table_end_category WHERE mcat_id=?");
                                    $query2->execute(array($row1['mcat_id']));
                                    $result2 = $query2->fetchAll(PDO::FETCH_ASSOC);

                                    // Lặp qua từng danh mục cấp 3
                                    foreach ($result2 as $row2) {
                                        $k++;
                                        // Kiểm tra nếu là end-category hiện tại
                                        $active_class_end = ($current_type == 'end-category' && $current_id == $row2['ecat_id']) ? 'active' : '';
                                    ?>
                        <li class="item-<?php echo $i . $j . $k; ?> <?php echo $active_class_end; ?>">
                            <a class="<?php echo $active_class_end; ?>"
                                href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category">
                                <span class="sign"></span>
                                <span class="lbl lbl1"><?php echo $row2['ecat_name']; ?></span>
                            </a>
                        </li>
                        <?php
                                    }
                                    ?>
                    </ul>
                </li>
                <?php
                        }
                        ?>
            </ul>
        </li>
        <?php
            }
        } // Kết thúc điều kiện hiển thị
        ?>
    </ul>
</div>
<style>
    
    #left {
        border: 1px solid #ddd; /* Viền ngoài */
        border-radius: 8px; /* Bo góc */
        background-color: #fff; /* Màu nền */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Đổ bóng */
        max-width: 280px;
    }
    .cat-level-1 {
        list-style: none;
    }
    .children li {
        padding: 8px 0;
        border-bottom: 1px solid #eee; /* Viền dưới */
    }
</style>