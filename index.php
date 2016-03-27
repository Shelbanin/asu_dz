<?php
require "sessions.php";

if (check_session()) {
    $page = is_admin() ? 'information.php' : 'orders.php';
} else {
    $page = 'login.php';
}
header("Location: $page");
exit();
?>