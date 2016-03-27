<?php
require "conf/config.php";
require "sql_queries/authorization.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $login = $_POST['login'];
        $pass = md5($_POST['password']);

        $query = OCIParse($connect, check_login($login, $pass));
        OCIExecute($query, OCI_DEFAULT);

        if(OCIFetch($query)) {
            $user = array(
                'id' => OCIResult($query, 'ACC_ID'),
                'login' => OCIResult($query, 'ACC_LOGIN'),
                'role' => OCIResult($query, 'ROLE_ABRIV'),
                'role_name' => OCIResult($query, 'ROLE_NAME'),
                'info' => OCIResult($query, 'ACC_INFO')
            );

            $_SESSION['authorized'] = true;
            $_SESSION['user'] = $user;

        }

        connection_close($connect);
    }
}

header("Location: index.php");
?>