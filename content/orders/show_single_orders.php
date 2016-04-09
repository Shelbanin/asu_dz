<?php
$id = $_GET['id'];
$connect = connect_to_db();
if (!$connect) {
    show_err_msg();
} else {
    $query = top_drilldown_order_query($id);
    $query = OCIParse($connect, $query);
    OCIExecute($query, OCI_DEFAULT);
    $data = array();
    if (OCIFetch($query)) {
        $data['ord_id'] = OCIResult($query, 'ORD_ID');
        $data['ord_amount'] = OCIResult($query, 'ORD_AMOUNT');
        $data['ord_info'] = OCIResult($query, 'ORD_INFO');
        $data['ord_progress'] = OCIResult($query, 'ORD_PROGRESS');
        $data['ord_description'] = OCIResult($query, 'ORD_DESCRIPTION');
        $data['st_name'] = OCIResult($query, 'ST_NAME');
        $data['owner'] = (
            OCIResult($query, 'OWNER_SURNAME') . " " .
            OCIResult($query, 'OWNER_NAME') . " " .
            OCIResult($query, 'OWNER_SECNAME') . " "
        );
        $data['performer'] = (
            OCIResult($query, 'PERF_SURNAME') . " " .
            OCIResult($query, 'PERF_NAME') . " " .
            OCIResult($query, 'PERF_SECNAME') . " "
        );
    }
}
connection_close($connect);
?>

<div id="content">
    <h4 align="center">Заказ № <? echo $id ?></h4>
    <div class = "drilldown-left">
        <p><b>Статус: </b><? echo $data['ord_amount'] ?></p>
        <p><b>Прогресс: </b><? echo $data['ord_progress'] ?></p>
        <p><b>Количество: </b><? echo $data['ord_amount'] ?></p>
    </div>
    <div class = "drilldown-right">
        <p><b>Создатель: </b><? echo $data['owner']?></p>
        <p><b>Ответственный: </b><? echo  $data['performer'] ?></p>
    </div>
    <div class="central-block">
        <p><b>Описание: </b><br></p>
        <p><? echo $data['ord_description'] ?></p>
        <h5 align="center">Технологический процесс:</h5>
    </div>
    <table>
        <?php
        $connect = connect_to_db();
        if (!$connect) {
            show_err_msg();
        } else {
            $query = tp_drilldown_table_query($data['ord_info']);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);
            $data = array();

            $header = array(
                '№',
                'Тип операции',
                'Прогресс, шт'
            );

            $fields = array(
                'PREP' => array(
                    'PREP_UNBOXING' => 'PREP_UNBOX_AMOUNT',
                    'PREP_CONTROL' => 'PREP_CTRL_AMOUNT'
                ),
                'ASSEMBLY' => array(
                    'ASMBL_PLACING' => 'ASMBL_PLACED_AMOUNT',
                    'ASMBL_SOLDERING' => 'ASMBL_SLDR_AMOUNT',
                    'ASMBL_WASHING' => 'ASMBL_WSHD_AMOUNT',
                    'ASMBL_PACKING' => 'ASMBL_PKG_AMOUNT'
                ),
                'CONTROL' => array(
                    'CTRL_TYPE' => 'CTRL_AMOUNT'
                )
            );

            if (OCIFetch($query)) {
                render_order_drilldown_table($header, $fields, $query);
            }
        }
        connection_close($connect);
        ?>
        </table>
    </table>
</div>
