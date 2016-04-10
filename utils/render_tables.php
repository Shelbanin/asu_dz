<?php
function render_table($header, $simple_header, $fields, $data, $permissions, $filter) {
    if ($simple_header) {
        render_header($header, $permissions);
    } else {
        render_order_header();
    }

    $counter = 1;
    while(OCIFetch($data)) {
        render_row($fields, $data, $counter, $permissions, $filter);
        $counter++;
    }
}

function render_header($header, $permissions) {
    echo "<tr>";
    foreach ($header as $key => $value) {
        if ($key === 'actions') {
            if (!($permissions['edit'] and $permissions['delete'])) {
                echo "1 ";
                continue;
            }
        }
        echo "<th>" . $value . "</th>";
    }
    echo "</tr>";
}

function render_order_drilldown_table($header, $fields, $data)
{
    render_header($header);
    $counter = 10;

    foreach ($fields as $key => $value) {
        $counter = render_colspan_row($key, $value, $data, $counter);
    }

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

function render_colspan_row($colspan_field, $fields, $data, $counter) {
    echo "<tr class=\"odd\">";
    echo "<td></td>";
    echo "<td class=\"even\" colspan=\"2\"><b>" . OCIResult($data, $colspan_field) . "</b></td>";
    echo "</tr>";
    foreach ($fields as $key => $value) {
        render_row(array($key, $value), $data, $counter+1);
        $counter += 10;
    }
    return $counter;
}

function cell_from_db($cell_key, $cell_value) {
    $open_a = '';
    $close_a = '';
    if ($cell_key === 'url') {
        $open_a = "<a href=\"" . $cell_value . "\" target=\"_blank\">";
        $close_a = "</a>";
    } elseif ($cell_key === 'drilldown') {
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

    $cell = $edit . $delimiter . $delete;

    if (!$cell) {
        return '';
    }

    return "<td>" . $cell . "</td>";
}
?>
