<?php
require "conf/config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect = OCILogon($db_user, $db_pass, $db);
    if ($connect) {

    }
}
?>