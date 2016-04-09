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
        SELECT (
            ord_id, ord_amount, ord_progress,
            st_name, st_abriv,
            date_start_spec, date_start_fact,
            date_end_spec, date_end_fact
          )
          FROM orders
            JOIN statuses ON ord_status=st_id
            JOIN dates ON ord_dates=date_id
    ";

    return $query . $condition;
}
?>
