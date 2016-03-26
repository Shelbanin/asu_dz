<?php
function check_login($login, $password) {
    return "
      SELECT acc_id, acc_login, acc_role, acc_info
        FROM accounts
        WHERE acc_login = '" . $login . "' and
              acc_password = '" . $password . "'
    ";
}
?>