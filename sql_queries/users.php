<?php
function insert_into_users($data) {
    $query_to_insert = "
      INSERT INTO users (
          user_name,
          user_surname,
          user_secname,
          user_phone
	    )
	    VALUES (
		  '" . $data['name'] . "',
		  '" . $data['surname'] . "',
		  '" . $data['secname'] . "',
		  '" . $data['phone'] . "'
	    )
	";
    return $query_to_insert;
}

function insert_into_accounts($data) {
    $query_to_insert = "
      INSERT INTO accounts (
		  acc_login,
		  acc_password,
		  acc_role,
		  acc_info
	    )
	    VALUES (
		  '" . $data['login'] . "',
		  '" . md5($data['password']) . "',
		  '" . $data['role'] . "',
          s_user_id.currval
	    )
    ";
    return $query_to_insert;
}

function users_roles_query() {
    return "
        SELECT role_id, role_name
          FROM roles
    ";
}

function users_query() {
    return "
        SELECT acc_login, role_name, user_name, user_id, user_surname, user_secname, user_phone
          FROM accounts
            JOIN users ON acc_info=user_id
            JOIN roles ON acc_role=role_id
    ";
}

function single_user_query($id) {
    $user = users_query();
    return $user."WHERE user_id='" . $id . "'";
}


function delete_user_query($id) {
    return "
        DELETE FROM users
          WHERE user_id='" . $id . "'
    ";
}

function update_user($data, $_id) {
    $update = "
        UPDATE users SET
    ";

    $_to_update = "";
    foreach ($data as $key => $value) {
        $_to_update .= ($key . "='" . $value . "',");
    }
    $_to_update = substr($_to_update, 0, -1);

    $condition = "
          WHERE user_id='" . $_id . "'
    ";

    return $update . $_to_update . $condition;
}
?>