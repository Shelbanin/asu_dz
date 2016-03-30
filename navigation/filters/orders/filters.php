<div id="filters">
    <div class="left-block">
        <form action="">
            <button class="<? echo $filters['all'] ?>">Все</button>
            <button class="<? echo $filters['new'] ?>">Новые</button>
            <button class="<? echo $filters['in_progress'] ?>">Выполняемые</button>
            <button class="<? echo $filters['done'] ?>">Завершенные</button>
        </form>
    </div>

    <div class="right-block">
        <div class="add-button">
            <a href="add_order.php">
                <div class="add-text">
                    Добавить
                </div>
            </a>
        </div>
    </div>
</div>
