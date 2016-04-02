<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_to_insert = empty($_POST['docs']) ? $_POST['operations'] : $_POST['docs'];
    $query = '';

    if (array_key_exists('url', $data_to_insert)) {
        $filter = 'docs';
        $query = insert_into_docs(
            $data_to_insert['name'],
            $data_to_insert['url'],
            $data_to_insert['desc']
        );
    } else {
        $filter = 'operations';
        $query = insert_into_opers(
            $data_to_insert['name'],
            $data_to_insert['type'],
            $data_to_insert['desc']
        );
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
    // TODO Статус добавления
} else {
    $filter = str_replace('add_', '', $_GET['page']);
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
    <h4 align="center">Добавление новой записи (<? echo $string ?>) в справочник</h4>
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
            <input type="text" name="<? echo $filter?>[name]" maxlength="25" required>
            <? if ($filter == 'docs'): ?>
                <input type="text" name="<? echo $filter?>[url]" maxlength="100" required>
            <? else: ?>
                <select name="<? echo $filter?>[type]" "required>
                <option></option>
                <? foreach ($combobox_data as $key => $value): ?>
                    <option value="<? echo $key ?>">
                        <? echo $value ?>
                    </option>
                <? endforeach; ?>
                </select>
            <? endif; ?>
            <textarea name="<? echo $filter?>[desc]" maxlength="4000" required></textarea>
            <input type="submit" value="Принять">
        </form>
    </div>
</div>
