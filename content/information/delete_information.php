<?php

?>

<div id="content">
    <h4 align="center">�� �������, ��� ������ ������� ��� ������?</h4>
    <table>
        <?php
        $selected_filter = empty($_POST['docs']) ? 'operations' : 'docs';
        $row = $data_to_restore;

        if ($selected_filter == 'docs') {
            $header = array(
                'ID',
                '��������',
                '������',
                '��������'
            );
        } else {
            $header = array(
                'ID',
                '��������',
                '��� ��������',
                '��������'
            );
        }

        render_header($header);
        render_row($row, false, true);
        ?>
    </table>
</div>

