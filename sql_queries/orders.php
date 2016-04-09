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
?>
