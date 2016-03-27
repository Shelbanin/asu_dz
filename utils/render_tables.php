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
    $style = (bool)$counter % 2 ? 'even' : 'odd';

    echo "<tr class=" . $style . ">";
    echo "<td>" . $counter . "</td>";

    foreach ($fields as $key => $value) {
        echo "<td>" . OCIResult($row, $value) . "</td>";
    }

    echo "</tr>";
}
?>