<?php
function check_login($login, $password) {
    return "
      SELECT acc_id, acc_login, role_abriv, role_name, acc_info
        FROM accounts
          JOIN roles ON acc_role = role_id
        WHERE acc_login = '" . $login . "' and
              acc_password = '" . $password . "'
    ";
}
?>