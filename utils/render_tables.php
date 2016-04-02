<?php
function render_table($header, $simple_header, $fields, $data) {
    if ($simple_header) {
        render_header($header);
    } else {
        render_order_header();
    }

    $counter = 1;
    while(OCIFetch($data)) {
        render_row($fields, $data, $counter);
        $counter++;
    }
}

function render_header($header) {
    echo "<tr>";
    foreach ($header as $key => $value) {
        echo "<th>" . $value . "</th>";
    }
    echo "</tr>";
}

function render_order_header() {
    echo '
        <tr>
            <th rowspan="2">№</th>
            <th rowspan="2">ID заказа</th>
            <th rowspan="2">Количество, шт</th>
            <th rowspan="2">Статус</th>
            <th rowspan="2">Прогресс, %</th>
            <th colspan="2">Дата начала</th>
            <th colspan="2">Дата завершения</th>
        </tr>
        <tr>
            <th>ТЗ</th>
            <th>Фактическая</th>
            <th>ТЗ</th>
            <th>Фактическая</th>
        </tr>
    ';
}

function render_row($fields, $row, $counter) {
    $style = (bool)($counter % 2) ? 'even' : 'odd';

    echo "<tr class=\"" . $style . "\">";
    echo "<td>" . $counter . "</td>";

    foreach ($fields as $key => $value) {
        $field_value = OCIResult($row, $value);
        echo $key === 'actions' ? cell_with_actions($field_value) : cell_from_db($key, $field_value);
    }

    echo "</tr>";
}

function cell_from_db($cell_key, $cell_value) {
    $open_a = '';
    $close_a = '';
    if ($cell_key === 'url') {
        $open_a = "<a href=\"" . $cell_value . "\" target=\"_blank\">";
        $close_a = "</a>";
    }

    $cell_tags = "<td>" . $open_a . $cell_value . $close_a . "</td>";

    return $cell_tags;
}

function cell_with_actions($_id) {
    $url = $_SERVER['PATH_INFO'];
    $selected_filter = isset($_GET['filter']) ? $_GET['filter'] : 'docs';

    $edit = "<a href=\"" . $url . "?page=edit&" . $selected_filter . "=" . $_id . "\">Изменить</a>";
    $delimiter = " / ";
    $delete = "<a href=\"" . $url . "?page=delete&" . $selected_filter . "=" . $_id . "\">Удалить</a>";

    return "<td>" . $edit . $delimiter . $delete . "</td>";
}
?>