<?php
$add_page = "add_" . $selected_filter;
?>

<div id="filters">
    <div class="left-block">
        <form action="" method="GET">
            <button class="<? echo $filters['docs'] ?>" name="filter" value="docs">���������</button>
            <button class="<? echo $filters['operations'] ?>" name="filter" value="operations">��������</button>
        </form>
    </div>

    <div class="right-block">
        <form action="" method="GET">
            <button name="page" value="<? echo $add_page ?>">��������</button>
        </form>
    </div>
</div>
