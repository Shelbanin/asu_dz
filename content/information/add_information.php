<?php
$filter = str_replace('add_', '', $_GET['page']);
$string ='';

if ($filter == 'docs') {
    $string = '���������';
} else {
    $string = '��������';

    $connect = connect_to_db();

    if (!$connect) {
        show_err_msg();
    } else {
        $query = operations_types_query();
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);

        while(OCIFetch($query)) {
            $combobox_data[OCIResult($query, 'OTYP_ID')] = OCIResult($query, 'OTYP_NAME');
        }

        connection_close($connect);
    }
}
?>

<div id="content">
    <div class = "left-block">
        <p>�������� <? echo $string ?>:</p>
        <p>
            <? if ($filter == 'docs'): ?>
                URL-����� ���������:
            <? else: ?>
                ��� ��������:
            <? endif; ?>
        </p>
        <p class="desc">�������� <? echo $string ?>:</p>
        <form action="" method="GET">
            <button name="filter" value="<? echo $filter ?>">
                ������
            </button>
        </form>
    </div>
    <div class="right-block">
        <form action="" method="POST">
            <input type="text" name="<? echo $filter?>[name]" maxlength="25" required>
            <? if ($filter == 'docs'): ?>
                <input type="text" name="<? echo $filter?>[url]" maxlength="100" required>
            <? else: ?>
                <select required>
                    <option></option>
                    <? foreach ($combobox_data as $key => $value): ?>
                        <option value="<? echo $key ?>">
                            <? echo $value ?>
                        </option>
                    <? endforeach; ?>
                </select>
            <? endif; ?>
            <textarea name="<? echo $filter?>[desc]" maxlength="4000" required></textarea>
            <input type="submit" value="�������">
        </form>
    </div>
</div>