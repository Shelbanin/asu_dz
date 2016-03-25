<?php
session_start();
$page = isset($_SESSION['authorized']) ? 'order.php' : 'login.php';
header("Location: $page");
exit();
?>