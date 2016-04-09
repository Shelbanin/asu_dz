<?php
function insert_into_dates($data) {
    $query_to_insert = "
      INSERT INTO dates (
          date_start_spec,
          date_end_spec
	    )
	    VALUES (
		  '" . $data['date_start'] . "',
		  '" . $data['date_end'] . "'
	    )
	";
    return $query_to_insert;
}

function insert_into_orders($data) {
    $query_to_insert = "
      INSERT INTO orders (
		  ord_amount,
		  ord_dates,
		  ord_owner,
		  ord_performer,
		  ord_description
	    )
	    VALUES (
		  '" . $data['amount'] . "',
		  s_date_id.currval,
		  '" . $data['owner'] . "',
		  '" . $data['performer'] . "',
		  '" . $data['desc'] . "'
	    )
    ";
    return $query_to_insert;
}

function tehs_query() {
    return "
        SELECT acc_id, role_name, user_name, user_surname, user_secname
          FROM accounts
            JOIN users ON acc_info=user_id
            JOIN roles ON acc_role=role_id
          WHERE role_abriv='teh'
    ";
}

function show_orders_query($filter) {
    $condition = '';

    if ($filter != 'all') {
        $condition = "
          WHERE st_abriv='" . $filter . "'
        ";
    }

    $query = "
        SELECT
            ord_id, ord_amount, ord_progress,
            st_name, st_abriv,
            date_start_spec, date_start_fact,
            date_end_spec, date_end_fact
          FROM orders
            JOIN status ON ord_status=st_id
            JOIN dates ON ord_dates=date_id
    ";

    return $query . $condition;
}

function top_drilldown_order_query($id) {
    $query = "
        SELECT
            ord_id, ord_amount, ord_progress,
            ord_description, ord_info, st_name,
            ownr.user_surname OWNER_SURNAME,
            ownr.user_name OWNER_NAME,
            ownr.user_secname OWNER_SECNAME,
            perf.user_surname PERF_SURNAME,
            perf.user_name PERF_NAME,
            perf.user_secname PERF_SECNAME
          FROM orders
            JOIN status ON ord_status=st_id
            JOIN dates ON ord_dates=date_id
            JOIN users ownr ON ord_owner=ownr.user_id
            JOIN users perf ON ord_performer=perf.user_id
          WHERE ord_id='" . $id . "'
    ";

    return $query;
}

function tp_drilldown_table_query($id) {
    $query = "
           SELECT
                otprep.otyp_name PREP,
                otasmb.otyp_name ASSEMBLY,
                otctrl.otyp_name CONTROL,
                punbx.oper_name PREP_UNBOXING,
                heap.prep_unbox_amount,
                pctrl.oper_name PREP_CONTROL,
                heap.prep_ctrl_amount,
                aplcn.oper_name ASMBL_PLACING,
                heap.asmbl_placed_amount,
                asldr.oper_name ASMBL_SOLDERING,
                heap.asmbl_sldr_amount,
                awshn.oper_name ASMBL_WASHING,
                heap.asmbl_wshd_amount,
                apckn.oper_name ASMBL_PACKING,
                heap.asmbl_pkg_amount,
                ctype.oper_name CTRL_TYPE,
                heap.ctrl_amount
             FROM (
               SELECT
                   prep_otype,
                   prep_unboxing, prep_unbox_amount,
                   prep_control, prep_ctrl_amount,
                   asmbl_otype,
                   asmbl_placing, asmbl_placed_amount,
                   asmbl_soldering, asmbl_sldr_amount,
                   asmbl_washing, asmbl_wshd_amount,
                   asmbl_packaging, asmbl_pkg_amount,
                   ctrl_otype,
                   ctrl_type, ctrl_amount
                 FROM
                   order_info
                   JOIN preparation ON oinf_preparation=prep_id
                   JOIN assembly ON oinf_assembly=asmbl_id
                   JOIN control ON oinf_control=ctrl_id
                 WHERE
                  oinf_id='" . $id . "'
             ) heap
               JOIN operation_types otprep ON heap.prep_otype=otprep.otyp_id
               JOIN operation_types otasmb ON heap.asmbl_otype=otasmb.otyp_id
               JOIN operation_types otctrl ON heap.ctrl_otype=otctrl.otyp_id
               JOIN operations_info punbx ON heap.prep_unboxing=punbx.oper_id
               JOIN operations_info pctrl ON heap.prep_control=pctrl.oper_id
               JOIN operations_info aplcn ON heap.asmbl_placing=aplcn.oper_id
               JOIN operations_info asldr ON heap.asmbl_soldering=asldr.oper_id
               JOIN operations_info awshn ON heap.asmbl_washing=awshn.oper_id
               JOIN operations_info apckn ON heap.asmbl_packaging=apckn.oper_id
               JOIN operations_info ctype ON heap.ctrl_type=ctype.oper_id
    ";
    return $query;
}
?>
