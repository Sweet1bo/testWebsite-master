<?php
?>
<div class="sidebar col-md-3 col-12">

    <div class="section search">
        <h3>Поиск</h3>
        <form action="Search.php" method="post">
            <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
        </form>
    </div>
    <div class="section topics">
        <h3>Категории</h3>
        <ul>
            <?php foreach($topics as $key => $topic): ?>
                <li>
                    <a href="<?= BASE_URL . "topic.php?topic_id=" . $topic['topic_id']; ?>"><?=$topic['topic_name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>