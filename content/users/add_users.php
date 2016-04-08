<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_to_insert = $_POST['data'];

    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = insert_into_users($data_to_insert);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
        $query = insert_into_accounts($data_to_insert);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
    }
    connection_close($connect);

    header("Location: users.php");
    exit();
    // TODO Статус добавления
} else {
    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = users_roles_query();
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);

        while (OCIFetch($query)) {
            $combobox_data[OCIResult($query, 'ROLE_ID')] = OCIResult($query, 'ROLE_NAME');
        }
    }
    connection_close($connect);
}
?>

<div id="content">
    <h4 align="center">Добавление нового сотрудника</h4>
    <div class = "left-block">
        <p>Имя аккаунта:</p>
        <p>Пароль: </p>
        <p>Роль в системе:</p>
        <p>Имя сотрудника:</p>
        <p>Фамилия сотрудника: </p>
        <p>Отчество сотрудника:</p>
        <p>Телефон сотрудника:</p>
        <form action="" method="GET">
            <button name="filter" value="<? echo $filter ?>">
                Отмена
            </button>
        </form>
    </div>
    <div class="right-block">
        <form action="" method="POST">
            <input type="text" name="data[login]" maxlength="20" required pattern="^[A-Za-z][A-Za-z0-9\.\_\-]{4,18}[A-Za-z0-9]$">
            <input type="text" name="data[password]" maxlength="50" pattern="^[A-Za-z0-9\_\-\!]{6,16}$" required>
            <select name="data[role]" "required>
                <option></option>
                <? foreach ($combobox_data as $key => $value): ?>
                    <option value="<? echo $key ?>">
                        <? echo $value ?>
                    </option>
                <? endforeach; ?>
            </select>
            <input type="text" name="data[surname]" maxlength="20" required>
            <input type="text" name="data[name]" maxlength="20" required>
            <input type="text" name="data[secname]" maxlength="20" required>
            <input type="text" name="data[phone]" maxlength="15"
                   placeholder="8-916-452-78-90" required pattern="^8-\d{3}-\d{3}-\d{2}-\d{2}$">
            <input type="submit" value="Принять">
        </form>
    </div>
</div>