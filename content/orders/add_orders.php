<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order = $_POST['order'];
    $dates = $_POST['dates'];

    foreach ($dates as $key => $value) {
        $splitted_date = explode('-', $value);
        $dates[$key] = implode('.', array_reverse($splitted_date));
    }

    $order['owner'] = $_SESSION['user']['id'];

    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = insert_into_dates($dates);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
        $query = insert_into_orders($order);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
    }
    connection_close($connect);

    header("Location: orders.php");
    exit();
    // TODO Статус добавления
} else {
    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = tehs_query();
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);

        while (OCIFetch($query)) {
            $combobox_data[OCIResult($query, 'ACC_ID')] = (
                OCIResult($query, 'USER_SURNAME') . " " .
                OCIResult($query, 'USER_NAME') . " " .
                OCIResult($query, 'USER_SECNAME')
            );
        }
    }
    connection_close($connect);
}
?>

<div id="content">
    <h4 align="center">Добавление нового заказа на RR-701-R-T</h4>
    <div class = "left-block">
        <p>Количество:</p>
        <p>Дата начала выполнения (ТЗ): </p>
        <p>Дата завершения выполнения (ТЗ): </p>
        <p>Ответственный за выполнение:</p>
        <p class="desc">Описание заказа: </p>
        <form action="" method="GET">
            <button name="filter" value="<? echo $filter ?>">
                Отмена
            </button>
        </form>
    </div>
    <div class="right-block">
        <form action="" method="POST">
            <input type="text" name="order[amount]" pattern="[0-9]{1,10}" required">
            <input type="date" name="dates[date_start]" max="2099-12-31" required>
            <input type="date" name="dates[date_end]" max="2099-12-31" required>
            <select name="order[performer]" "required>
            <option></option>
            <? foreach ($combobox_data as $key => $value): ?>
                <option value="<? echo $key ?>">
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
            </select>
            <textarea name="order[desc]" maxlength="4000" required></textarea>
            <input type="submit" value="Принять">
        </form>
    </div>
</div>