<?php
$add_page = "add_" . $selected_filter;
$permission = get_permissions($_SESSION['user']['role'], 'info');
?>

<div id="filters">
    <div class="left-block">
        <form action="" method="GET">
            <button class="<? echo $filters['docs'] ?>" name="filter" value="docs">Документы</button>
            <button class="<? echo $filters['operations'] ?>" name="filter" value="operations">Операции</button>
        </form>
    </div>

    <div class="right-block">
        <? if ($permission['create']): ?>
            <form action="" method="GET">
                <button name="page" value="<? echo $add_page ?>">Добавить</button>
            </form>
        <? endif; ?>
    </div>
</div>
