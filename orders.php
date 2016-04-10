<?php
require "sessions.php";
require "conf/config.php";
require "sql_queries/orders.php";
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

$page_to_include = page_to_show('orders', $_GET);
if ($page_to_include['type'] == 'show') {
    $selected_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    $filters[$selected_filter] = 'selected';
    include("navigation/filters/orders/filters.php");
} else if (in_array($page_to_include['type'], array('edit', 'delete'))) {
    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        $id = $_GET['order'];

        if ($id) {
            $query = edit_top_info_query($id);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $info_to_restore = array();
            if(OCIFetch($query)) {
                $info_to_restore['id'] = $id;
                $info_to_restore['ord_info'] = OCIResult($query, 'ORD_INFO');
                $info_to_restore['amount'] = OCIResult($query, 'ORD_AMOUNT');
                $info_to_restore['status'] = OCIResult($query, 'ORD_STATUS');
                $info_to_restore['dates_id'] = OCIResult($query, 'ORD_DATES');
            }

            $query = tp_info_query($info_to_restore['ord_info']);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $tp_to_restore = array();
            if(OCIFetch($query)) {
                $tp_to_restore[OCIResult($query, 'PREP_OTYPE')] = array(
                    OCIResult($query, 'PREP_UNBOXING') => OCIResult($query, 'PREP_UNBOX_AMOUNT'),
                    OCIResult($query, 'PREP_CONTROL') => OCIResult($query, 'PREP_CTRL_AMOUNT')
                );
                $tp_to_restore[OCIResult($query, 'ASMBL_OTYPE')] = array(
                    OCIResult($query, 'ASMBL_PLACING') => OCIResult($query, 'ASMBL_PLACED_AMOUNT'),
                    OCIResult($query, 'ASMBL_SOLDERING') => OCIResult($query, 'ASMBL_SLDR_AMOUNT'),
                    OCIResult($query, 'ASMBL_WASHING') => OCIResult($query, 'ASMBL_WSHD_AMOUNT'),
                    OCIResult($query, 'ASMBL_PACKAGING') => OCIResult($query, 'ASMBL_PKG_AMOUNT')
                );
                $tp_to_restore[OCIResult($query, 'CTRL_OTYPE')] = array(
                    OCIResult($query, 'CTRL_TYPE') => OCIResult($query, 'CTRL_AMOUNT')
                );
                $info_to_restore['pred_id'] = OCIResult($query, 'OINF_PREPARATION');
                $info_to_restore['asmbl_id'] = OCIResult($query, 'OINF_ASSEMBLY');
                $info_to_restore['ctrl_id'] = OCIResult($query, 'OINF_CONTROL');
            }
        } else {
            connection_close($connect);
            header("Location: orders.php");
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
