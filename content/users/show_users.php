<?php
$permissions = get_permissions($_SESSION['user']['role'], 'users');
?>
<div id="content">
    <div class="tab">
        <? if ($permissions['view']): ?>
            <table>
                <?php
                $connect = connect_to_db();
                if (!$connect) {
                    show_err_msg();
                } else {
                    $query = users_query();

                    $query = OCIParse($connect, $query);
                    OCIExecute($query, OCI_DEFAULT);

                    $header = array(
                        '�',
                        '�����',
                        '����',
                        '�������',
                        '���',
                        '��������',
                        '�������',
                        '��������'
                    );
                    $fields = array(
                        'ACC_LOGIN',
                        'ROLE_NAME',
                        'USER_SURNAME',
                        'USER_NAME',
                        'USER_SECNAME',
                        'USER_PHONE',
                        'actions' => 'USER_ID'
                    );

                    $permissions = get_permissions($_SESSION['user']['role'], 'users');
                    render_table($header, true, $fields, $query, $permissions, 'user');
                }
                connection_close($connect);
                ?>
            </table>
        <? else: ?>
            <h4 align="center">������������ ���� ��� ������� � ������ ��������!</h4>
        <? endif; ?>
    </div>
</div>
