<?php
function get_ext($fname)
{
    return strtolower(strrchr($_FILES[$fname]["name"], '.')); // Lấy phần mở rộng và chuyển thành chữ thường
}

function ext_check($allowed_ext, $my_ext)
{
    $allowed_ext_arr = array_map(fn($ext) => '.' . strtolower($ext), explode("|", $allowed_ext)); // Chuyển danh sách thành mảng có dấu '.'
    return in_array($my_ext, $allowed_ext_arr); // Kiểm tra phần mở rộng
}

function get_ai_id($pdo, $tbl_name)
{
    $statement = $pdo->prepare("SHOW TABLE STATUS LIKE ? LIMIT 1");
    $statement->execute([$tbl_name]);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    return $row ? $row['Auto_increment'] : null;
}