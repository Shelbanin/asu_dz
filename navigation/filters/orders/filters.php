<?php
$permission = get_permissions($_SESSION['user']['role'], 'orders');
?>


<div id="filters">
    <div class="left-block">
        <form action="" method="GET">
            <button class="<? echo $filters['all'] ?>" name="filter" value="all">���</button>
            <button class="<? echo $filters['new'] ?>" name="filter" value="new">�����</button>
            <button class="<? echo $filters['in_progress'] ?>" name="filter" value="in_progress">�����������</button>
            <button class="<? echo $filters['done'] ?>" name="filter" value="done">�����������</button>
        </form>
    </div>

    <div class="right-block">
        <? if ($permission['create']): ?>
            <form action="" method="GET">
                <button name="page" value="add">��������</button>
            </form>
        <? endif; ?>
    </div>
</div>
