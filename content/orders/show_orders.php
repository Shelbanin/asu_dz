<?php
$permissions = get_permissions($_SESSION['user']['role'], 'users');
$filter = $selected_filter;
?>
<div id="content">
    <div class="tab">
        <? if ($permissions['view']): ?>
            <table>
                <?php
                $connect = connect_to_db();
                if (!$connect) {
                    show_err_msg();
                } else {
                    $query = show_orders_query($filter);
                    $query = OCIParse($connect, $query);
                    OCIExecute($query, OCI_DEFAULT);

                    $fields = array(
                        'drilldown' => 'ORD_ID',
                        'ORD_AMOUNT',
                        'ST_NAME',
                        'ORD_PROGRESS',
                        'DATE_START_SPEC',
                        'DATE_START_FACT',
                        'DATE_END_SPEC',
                        'DATE_END_FACT'
                    );

                    $permissions = get_permissions($_SESSION['user']['role'], 'orders');
                    render_table($header, false, $fields, $query, $permissions, 'order');
                }
                connection_close($connect);
                ?>
            </table>
        <? else: ?>
            <h4 align="center">Ќедостаточно прав дл€ доступа к данной странице!</h4>
        <? endif; ?>
    </div>
</div>
