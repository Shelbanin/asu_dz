<?php

?>

<div id="content">
    <h4 align="center">Вы уверены, что хотите удалить эту запись?</h4>
    <table>
        <?php
        $selected_filter = empty($_POST['docs']) ? 'operations' : 'docs';
        $row = $data_to_restore;

        if ($selected_filter == 'docs') {
            $header = array(
                'ID',
                'Название',
                'Ссылка',
                'Описание'
            );
        } else {
            $header = array(
                'ID',
                'Название',
                'Тип операции',
                'Описание'
            );
        }

        render_header($header);
        render_row($row, false, true);
        ?>
    </table>
</div>

