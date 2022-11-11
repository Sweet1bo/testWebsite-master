<?php

$page = $_GET['post'];
$comment = '';
$status = 0;
$comments = [];
$errMsg = [];

// Код для формы создания комментария
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){


    $comment = trim($_POST['comment']);


    if($comment === ''){
        array_push($errMsg, "Комментарий то напиши");
    }elseif (mb_strlen($comment, 'UTF8') < 10){
        array_push($errMsg, "Комментарий должен быть длинее 10 символов");
    }else {
        if (empty($_SESSION['id']) == 1) {
            array_push($errMsg, "Комментарий может оставить только авторизованный пользователь");
        } else {
            $status = 1;
            $comment = [
                'status' => $status,
                'page' => $page,
                'comment' => $comment,
                'id_user' => $_SESSION['id']
            ];
            $comment = insert('comments', $comment);
            $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
    }

    }
}else{
    $comment = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1] );

}
