<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filter = isset($_POST['docs']) ? 'docs' : 'operations';
    $_id = $_POST[$filter];

    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        $query = delete_row($filter, $_id);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
        // TODO DELETE SUCCESS
    }
    connection_close($connect);
    header("Location: information.php?filter=" . $filter);
    exit();
} else {
    $filter = isset($_GET['docs']) ? 'docs' : 'operations';
    $_id = $_GET[$filter];
}
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
    <div id="delete-buttons">
        <form action="" method="GET">
            <button name="filter" value="<? echo $filter ?>">
                Отмена
            </button>
        </form>
        <form action="" method="POST">
            <button name="<? echo $filter ?>" value="<? echo $_id ?>">
                Удалить
            </button>
        </form>
    </div>
</div>

