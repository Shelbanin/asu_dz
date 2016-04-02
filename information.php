<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/information.php";
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
    <script src="static/js/main-script.js"></script>
</head>
<body>
<?php
include("navigation/menu.php");

$page_to_include = page_to_show('information', $_GET);
if ($page_to_include['type'] == 'show') {
    $selected_filter = isset($_GET['filter']) ? $_GET['filter'] : 'docs';
    $filters[$selected_filter] = 'selected';
    include("navigation/filters/info/filters.php");
} else if (in_array($page_to_include['type'], array('edit', 'delete'))) {
    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        $type = isset($_GET['docs']) ? 'docs' : 'operations';
        $id = $_GET[$type];

        if ($id) {
            $query = $type == 'docs' ? single_doc_query($id) : single_operation_query($id);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $data_to_restore = array();
            if(OCIFetch($query)) {
                if ($type == 'docs') {
                    $data_to_restore['id'] = OCIResult($query, 'DOC_ID');
                    $data_to_restore['name'] = OCIResult($query, 'DOC_NAME');
                    $data_to_restore['url'] = OCIResult($query, 'DOC_URL');
                    $data_to_restore['desc'] = OCIResult($query, 'DOC_DESCRIPTION');
                } else {
                    $data_to_restore['id'] = OCIResult($query, 'OPER_ID');
                    $data_to_restore['name'] = OCIResult($query, 'OPER_NAME');
                    $data_to_restore['type'] = OCIResult($query, 'OPER_TYPE');
                    $data_to_restore['desc'] = OCIResult($query, 'OPER_DESCRIPTION');
                }
            }

            if (empty($data_to_restore)) {
                connection_close($connect);
                header("Location: information.php?filter=" . $type);
                exit();
                // TODO Сообщение об ошибке - не найдено такой записи
            }
        } else {
            connection_close($connect);
            header("Location: information.php?filter=" . $type);
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
