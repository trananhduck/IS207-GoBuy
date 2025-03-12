<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
    $querry->execute(array($_REQUEST['id']));
    $total = $querry->rowCount();
    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<?php

// Getting photo ID to unlink from folder
$querry = $pdo->prepare("SELECT * FROM table_service WHERE id=?");
$querry->execute(array($_REQUEST['id']));
$result = $querry->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $photo = $row['photo'];
}

// Unlink the photo
if ($photo != '') {
    unlink('../assets/uploads/' . $photo);
}

// Delete from table_service
$querry = $pdo->prepare("DELETE FROM table_service WHERE id=?");
$querry->execute(array($_REQUEST['id']));

header('location: service.php');
?>