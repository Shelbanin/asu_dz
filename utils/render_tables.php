<?php
function render_table($header, $simple_header, $fields, $data, $permissions, $filter) {
    if ($simple_header) {
        render_header($header);
    } else {
        render_order_header();
    }

    $counter = 1;
    while(OCIFetch($data)) {
        render_row($fields, $data, $counter, $permissions, $filter);
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

function render_row($fields, $row, $counter, $permissions=false, $filter='') {
    $style = (bool)($counter % 2) ? 'even' : 'odd';

    echo "<tr class=\"" . $style . "\">";
    if ($counter !== true) {
        echo "<td>" . $counter . "</td>";
    }
    foreach ($fields as $key => $value) {
        $field_value = $row === false ? $value : OCIResult($row, $value);
        echo $key === 'actions' ? cell_with_actions($field_value, $permissions, $filter) :
                                  cell_from_db($key, $field_value);
    }

    echo "</tr>";
}

function cell_from_db($cell_key, $cell_value) {
    $open_a = '';
    $close_a = '';
    if ($cell_key === 'url') {
        $open_a = "<a href=\"" . $cell_value . "\" target=\"_blank\">";
        $close_a = "</a>";
    }elseif ($cell_key === 'drilldown') {
        $url = $_SERVER['PATH_INFO'];
        $open_a = "<a href=\"" . $url . "?page=show&id=" . $cell_value . "\">";
        $close_a = "</a>";
    }

    $cell_tags = "<td>" . $open_a . $cell_value . $close_a . "</td>";

    return $cell_tags;
}

function cell_with_actions($id, $permissions, $filter) {
    $url = $_SERVER['PATH_INFO'];

    $edit = '';
    $delimiter = '';
    $delete = '';

    if ($permissions['edit']) {
        $edit = "<a href=\"" . $url . "?page=edit&" . $filter . "=" . $id . "\">Изменить</a>";
    }
    if ($permissions['delete']) {
        $delete = "<a href=\"" . $url . "?page=delete&" . $filter . "=" . $id . "\">Удалить</a>";
    }
    if ($permissions['edit'] and $permissions['delete']) {
        $delimiter = " / ";
    }

    return "<td>" . $edit . $delimiter . $delete . "</td>";
}
?>
