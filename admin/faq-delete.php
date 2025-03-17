<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    //Kiểm tra ID có hợp lệ không
    $querry = $pdo->prepare("SELECT * FROM table_faq WHERE faq_id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php
// xóa khỏi table_faq
$querry = $pdo->prepare("DELETE FROM table_faq WHERE faq_id=?");
$querry->execute(array($_REQUEST['id']));
header('location: faq.php');
?>