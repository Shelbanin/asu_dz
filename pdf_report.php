<?php
require "fpdf/fpdf.php";
require "utils/export.php";
require "conf/config.php";
require "sql_queries/orders.php";

$connect = connect_to_db();
if (!$connect) {
    show_err_msg();
} else {
    $id = $_GET['order'];

    if ($id) {
        $query = top_drilldown_order_query($id);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);

        $order_info = array();
        if(OCIFetch($query)) {
            foreach (array('owner', 'perf') as $value) {
                $surname = OCIResult($query, strtoupper($value)."_SURNAME");
                $name = OCIResult($query, strtoupper($value)."_NAME");
                $secname = OCIResult($query, strtoupper($value)."_SECNAME");

                $order_info[$value] = (
                    $surname . " " .
                    $name[0] . "." .
                    $secname[0] . "."
                );
            }
            $order_info['ord_info'] = OCIResult($query, 'ORD_INFO');
        }

        $query = tp_drilldown_table_query($order_info['ord_info']);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);

        $fields = get_tp_fields();
        $tp_data = array();
        if (OCIFetch($query)) {
            foreach ($fields as $oper_type => $opers) {
                $oper_type_value = OCIResult($query, $oper_type);
                $tp_data[$oper_type_value] = array();
                $operartions = array_keys($opers);

                foreach ($operartions as $value) {
                    array_push($tp_data[$oper_type_value], OCIResult($query, $value));
                }
            }
        }
    } else {
        connection_close($connect);
        header("Location: orders.php");
        exit();
    }

    generate_report($tp_data, $order_info);
}
connection_close($connect);
?>