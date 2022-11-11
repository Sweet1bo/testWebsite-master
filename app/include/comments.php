<?php
include __DIR__ . "/../../app/controllers/comments.php";

$comments = selectAll('comments', ['page' => $_GET['post']]);
?>

<div class="cpl-md-12 col-12 comments">
    <div class="mb-3 col-12 col-md-4 err">
        <p><?php include __DIR__ . "/../../app/helps/errInfo.php"; ?></p>
    </div>
    <?php if($_SESSION['id']): ?>
    <h3>Оставить комментарий</h3>
    <form action="<?=BASE_URL . "single.php?post=$page"; ?>" method="post">
        <input type="hidden" name="page" value="<?=$page; ?>">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Напиши свой комментарий</label>
            <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
    <?php else: ?>
    <h4>Оставлять комментарии могут только авторизовавшиеся пользователи</h4>
    <?php endif; ?>
    <?php if(count($comments) >= 1): ?>
        <div class="row all-comments">
            <h3 class="col-12">Комментарии к записи</h3>
            <?php foreach($comments as $comment): ?>
                <div class="one-comment col-12">
                    <span><i class="far fa-envelope"></i><?=$comment['id_user']; ?></span>
                    <span><i class="far fa-calendar-check"></i><?=$comment['create_date']; ?></span>
                    <div class="col-12 text">
                    <?php echo $comment['comment']; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
            <h3>Комментариев нэма</h3>
    <?php endif; ?>
</div>