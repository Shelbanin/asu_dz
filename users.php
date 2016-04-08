<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/users.php";
require "utils/render_tables.php";
require "utils/page_type.php";

check_authorized();
?>

<html>
<head>
    <title>АСУ</title>
    <link rel="stylesheet" href="static/style/style.css">
    <link rel="stylesheet" href="static/style/content.css">
    <link rel="stylesheet" href="static/style/filters.css">
</head>
<body>
<?php
include("navigation/menu.php");

$page_to_include = page_to_show('users', $_GET);
if ($page_to_include['type'] == 'show') {
    include("navigation/filters/users/filters.php");
} else if (in_array($page_to_include['type'], array('edit', 'delete'))) {
    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        $id = $_GET['user'];

        if ($id) {
            $query = single_user_query($id);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $data_to_restore = array();
            if(OCIFetch($query)) {
                $data_to_restore['id'] = OCIResult($query, 'USER_ID');
                $data_to_restore['login'] = OCIResult($query, 'ACC_LOGIN');
                $data_to_restore['role'] = OCIResult($query, 'ROLE_NAME');
                $data_to_restore['surname'] = OCIResult($query, 'USER_SURNAME');
                $data_to_restore['name'] = OCIResult($query, 'USER_NAME');
                $data_to_restore['secname'] = OCIResult($query, 'USER_SECNAME');
                $data_to_restore['phone'] = OCIResult($query, 'USER_PHONE');
            }

            if (empty($data_to_restore)) {
                connection_close($connect);
                header("Location: users.php");
                exit();
                // TODO Сообщение об ошибке - не найдено такой записи
            }
        } else {
            connection_close($connect);
            header("Location: users.php");
            exit();
            // TODO Сообщение об ошибке - не указана запись
        }
    }
    connection_close($connect);
}

include($page_to_include['path']);;

include("navigation/footer.php");
?>
</body>
</html>
