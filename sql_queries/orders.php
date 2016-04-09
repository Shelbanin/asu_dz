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
		  '" . $data['description'] . "'
	    )
    ";
    return $query_to_insert;
}
?>
