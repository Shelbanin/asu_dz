<?php
$permissions = get_permissions($_SESSION['user']['role'], 'users');
?>

<div id="filters">
    <div class="left-block">

    </div>

    <div class="right-block">
        <? if ($permissions['create']): ?>
            <form action="" method="GET">
                <button name="page" value="add">Добавить</button>
            </form>
        <? endif; ?>
    </div>
</div>
