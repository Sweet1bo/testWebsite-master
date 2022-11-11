<?php

include __DIR__ . '/../database/db.php';

if ($_SESSION['admin'] != 1){
    header('location: ' . BASE_URL);
}

$title = '';
$content = '';
$status = $_POST['status'];

$posts = SelectAll('posts');
$errMsg = [];
//Создание поста
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = __DIR__ . "/../../assets/images/posts/" . $imgName;

        $result = move_uploaded_file($fileTmpName, $destination);
        $_POST['img'] = $imgName;
    }else{
        array_push($errMsg, "Блять, мб картинку добавишь?");
    }

    if($_POST['status'] == ''){
        $status = 0;
    }else{
        $status = 1;
    }

    $postData = [
        'title' => trim($_POST['title']),
        'content' => trim($_POST['content']),
        'topic_id' => $_POST['topic'],
        'id_user' => $_SESSION['id'],
        'img' => $_POST['img'],
        'status' => $status
    ];

    if($_POST['topic'] == ''){
        array_push($errMsg, "Старый выбери категорию");
    }
    if($_POST['img'] == ''){
        array_push($errMsg, "Картинку поставь");
    }elseif(mb_strlen($postData['title'], 'UTF-8') < 2){
        array_push($errMsg, "Заголовок должен быть больше 1 символа, хотя бы 2 поставь, ок да");
    }else{
        $existence = selectOne('posts', ['title' => $postData['title']]);
        if($existence['title'] === $postData['title']){
            array_push($errMsg, "Статья с таким заголовком уже есть");
        }else {
            $post_id = insert('posts', $postData);
            $post = selectOne('posts', $params = ['id' => $post_id]);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }

}else{
    $postData = [
        'title' => '',
        'content' => ''
    ];
}

// АПДЕЙТ СТАТЬИ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $title = $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = __DIR__ . "/../../assets/images/posts/" . $imgName;


        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Подгружаемый файл не является изображением!");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['img'] = $imgName;
            }else{
                array_push($errMsg, "Ошибка загрузки изображения на сервер");
            }
        }
    }else{
        array_push($errMsg, "Ошибка получения картинки");
    }


    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не все поля заполнены!");
    }elseif (mb_strlen($title, 'UTF8') < 7){
        array_push($errMsg, "Название статьи должно быть более 7-ми символов");
    }else{
        $post = [
            'id' => $_POST['id'],
            'id_user' => $_SESSION['id'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'topic_id' => $topic
        ];
        $post = update('posts', 'id', $_POST['id'], $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $title = $_POST['title'];
    $content = $_POST['content'];
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = $_POST['id_topic'];
}

//Опубликовать/cнять с публики пост
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $post_id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $post_id = update('posts', 'id', $post_id, ['status' => $publish] );

    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

//Удаление поста
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $post_id = $_GET['del_id'];
    $post = selectOne('posts', ['id' => $post_id]);
    $title = $post['title'];
    $post = delete('posts', 'id', $post_id);
    array_push($errMsg, "Ты уничтожил данный пост: " . $title . ", зачем, монстр?");
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
