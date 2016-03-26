<?php
require "conf/config.php";
require "conf/console_log.php";
require "sql_queries/authorization.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect = OCILogon($db_user, $db_pass, $db);

    if (!$connect) {
        $error = OCIError();
        $msg = $error['message'];
        console_log($error, $msg);
        die();
    } else {
        $login = $_POST['login'];
        $pass = md5($_POST['password']);

        $query = OCIParse($connect, check_login($login, $pass));
        OCIExecute($query, OCI_DEFAULT);

        if(OCIFetch($query)) {
            $user = array(
                'id' => OCIResult($query, 'ACC_ID'),
                'login' => OCIResult($query, 'ACC_LOGIN'),
                'role' => OCIResult($query, 'ACC_ROLE'),
                'info' => OCIResult($query, 'ACC_INFO')
            );

            $_SESSION['authorized'] = true;
            $_SESSION['user'] = $user;
        }

        OCICommit($connect);
        OCILogoff($connect);
    }
}

header("Location: index.php");
?>