<?php
$permission = get_permissions($_SESSION['user']['role'], 'orders');
?>


<div id="filters">
    <div class="left-block">
        <form action="" method="GET">
            <button class="<? echo $filters['all'] ?>">���</button>
            <button class="<? echo $filters['new'] ?>">�����</button>
            <button class="<? echo $filters['in_progress'] ?>">�����������</button>
            <button class="<? echo $filters['done'] ?>">�����������</button>
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
