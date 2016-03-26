<?php
$info = 'info';
$error = 'error';

function console_log($type, $message) {
    $type = $type == 'info' ? 'log' : 'error';
    $title = $type == 'error' ? '' : 'Information: ';
    $message = str_replace(array("\r", "\n"), "", $message);

    $log = "<script>console." . $type . "('". $message ."');</script>";
    echo $log;
}
?>