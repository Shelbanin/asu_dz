<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filter = empty($_POST['docs']) ? 'operations' : 'docs';
    $data_from_form = empty($_POST['docs']) ? $_POST['operations'] : $_POST['docs'];
    $dtr = $data_to_restore;

    $updated_fields = array();
    $attributes_dict = array();
    $attributes_dict['docs'] = array(
        'name' => 'DOC_NAME',
        'url' => 'DOC_URL',
        'desc' => 'DOC_DESCRIPTION'
    );
    $attributes_dict['operations'] = array(
        'name' => 'OPER_NAME',
        'type' => 'OPER_TYPE',
        'desc' => 'OPER_DESCRIPTION'
    );

    foreach ($data_from_form as $key => $value) {
        $attribute_in_table = $attributes_dict[$filter][$key];

        if ($value != $dtr[$key]) {
            $updated_fields[$attribute_in_table] = $value;
        }
    }

    if (empty($updated_fields)) {
        header("Location: information.php?filter=" . $filter);
        exit();
        // TODO нЕчего обновлять
    }

    if ($filter == 'docs') {
        $query = update_doc($updated_fields, $dtr['id']);
    } else {
        $query = update_operation($updated_fields, $dtr['id']);
    }

    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
    }
    connection_close($connect);

    header("Location: information.php?filter=" . $filter);
    exit();
    // TODO Статус изменения
} else {
    $data = $data_to_restore;
    $filter = $type;
    $string = '';

    if ($filter == 'docs') {
        $string = 'документа';
    } else {
        $string = 'операции';

        $connect = connect_to_db();

        if (!$connect) {
            show_err_msg();
        } else {
            $query = operations_types_query();
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            while (OCIFetch($query)) {
                $combobox_data[OCIResult($query, 'OTYP_ID')] = OCIResult($query, 'OTYP_NAME');
            }
        }
        connection_close($connect);
    }
}
?>

<div id="content">
    <h4 align="center">Изменение записи (<? echo $string ?>) в справочнике</h4>
    <div class = "left-block">
        <p>Название <? echo $string ?>:</p>
        <p>
            <? if ($filter == 'docs'): ?>
                URL-адрес документа:
            <? else: ?>
                Тип операции:
            <? endif; ?>
        </p>
        <p class="desc">Описание <? echo $string ?>:</p>
        <form action="" method="GET">
            <button name="filter" value="<? echo $filter ?>">
                Отмена
            </button>
        </form>
    </div>
    <div class="right-block">
        <form action="" method="POST">
            <input type="text" name="<? echo $filter?>[name]" value="<? echo $data['name'] ?>" maxlength="25" required>
            <? if ($filter == 'docs'): ?>
                <input type="text" name="<? echo $filter?>[url]" value="<? echo $data['url'] ?>" maxlength="100" required>
            <? else: ?>
                <select name="<? echo $filter?>[type]" "required>
                <? foreach ($combobox_data as $key => $value): ?>
                    <option value="<? echo $key ?>" <? if ($key==$data['type']): echo 'selected'; endif;?>>
                        <? echo $value ?>
                    </option>
                <? endforeach; ?>
                </select>
            <? endif; ?>
            <textarea name="<? echo $filter?>[desc]" maxlength="4000" required><? echo $data['desc'] ?></textarea>
            <input type="submit" value="Принять">
        </form>
    </div>
</div>