<?php
session_start();

function check_session() {
    return isset($_SESSION['authorized']);
}

function is_admin() {
    return $_SESSION['user']['role'] == 'adm';
}

function check_authorized() {
    if (!check_session()) {
        $page = 'login.php';
        header("Location: $page");
        exit();
    }
}

?>