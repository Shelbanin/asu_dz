<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_id = $_POST['user'];

    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        $query = delete_user_query($_id);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
        // TODO DELETE SUCCESS
    }
    connection_close($connect);
    header("Location: users.php");
    exit();
} else {
    $_id = $_GET['user'];
}
?>

<div id="content">
    <h4 align="center">�� �������, ��� ������ ������� ����� ���������� �� �������?</h4>
    <table>
        <?php
        $row = $data_to_restore;

        $header = array(
            '�',
            '�����',
            '����',
            '�������',
            '���',
            '��������',
            '�������'
        );

        render_header($header);
        render_row($row, false, true);
        ?>
    </table>
    <div id="delete-buttons">
        <form action="" method="GET">
            <button>
                ������
            </button>
        </form>
        <form action="" method="POST">
            <button name="user" value="<? echo $_id ?>">
                �������
            </button>
        </form>
    </div>
</div>

