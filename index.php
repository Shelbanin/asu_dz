<?php
session_start();
if (isset($_SESSION['authorized'])) {
    header("Location: order.php");
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>