<?php
include "../utils/errors.php";

function connect_to_db() {
    $db = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=alex-pc)(PORT=1521)))(CONNECT_DATA=(SID=ASUSH)))";
    $db_user = 'asu_user';
    $db_pass = 'handover';

    return OCILogon($db_user, $db_pass, $db);
}

function show_err_msg() {
    $err = OCIError();
    $msg = $err['message'];
    console_log($err, $msg);
    die();
}

function connection_close($connect) {
    OCICommit($connect);
    OCILogoff($connect);
}
?>
