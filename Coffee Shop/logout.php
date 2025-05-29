<?php
session_start();
$_SESSION['id'] = "";
unset($_SESSION['id']);
header('location: index.php');
?>