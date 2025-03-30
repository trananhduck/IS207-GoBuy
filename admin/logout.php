<?php
ob_start();
session_start();
include 'inc/config.php';
unset($_SESSION['admin']);
header("location: ../login-admin.php");