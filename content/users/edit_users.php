<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_to_update = $_POST['data'];
    $dtr = $data_to_restore;

    $attributes_dict = array(
        'name' => 'USER_NAME',
        'surname' => 'USER_SURNAME',
        'secname' => 'USER_SECNAME',
        'phone' => 'USER_PHONE'
    );

    foreach ($data_to_update as $key => $value) {
        $attribute_in_table = $attributes_dict[$key];

        if ($value != $dtr[$key]) {
            $updated_fields[$attribute_in_table] = $value;
        }
    }

    if (empty($updated_fields)) {
        header("Location: users.php" . $filter);
        exit();
        // TODO нЕчего обновлять
    }

    $query = update_user($updated_fields, $dtr['id']);

    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
    }
    connection_close($connect);

    header("Location: users.php");
    exit();
    // TODO Статус изменения
} else {
    $data = $data_to_restore;
}
?>

<div id="content">
    <h4 align="center">Изменение данных о сотруднике</h4>
    <div class = "left-block">
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
            <input type="text" name="data[surname]" value="<? echo $data['surname'] ?>" maxlength="20" required>
            <input type="text" name="data[name]" value="<? echo $data['name'] ?>" maxlength="20" required>
            <input type="text" name="data[secname]" value="<? echo $data['secname'] ?>" maxlength="20" required>
            <input type="text" name="data[phone]" value="<? echo $data['phone'] ?>" maxlength="15"
                   placeholder="8-916-452-78-90" required pattern="^8-\d{3}-\d{3}-\d{2}-\d{2}$">
            <input type="submit" value="Принять">
        </form>
    </div>
</div>
