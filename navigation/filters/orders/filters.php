<?php
$permission = get_permissions($_SESSION['user']['role'], 'orders');
?>


<div id="filters">
    <div class="left-block">
        <form action="" method="GET">
            <button class="<? echo $filters['all'] ?>">Все</button>
            <button class="<? echo $filters['new'] ?>">Новые</button>
            <button class="<? echo $filters['in_progress'] ?>">Выполняемые</button>
            <button class="<? echo $filters['done'] ?>">Завершенные</button>
        </form>
    </div>

    <div class="right-block">
        <? if ($permission['create']): ?>
            <form action="" method="GET">
                <button name="page" value="add">Добавить</button>
            </form>
        <? endif; ?>
    </div>
</div>
