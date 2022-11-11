<?php

include __DIR__ . '/../database/db.php';

$topic_name = '';
$topic_description = '';

$topics = SelectAll('topics');

$errMsg = [];

//Создание категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){

    $topicData = [
        'topic_name' => trim($_POST['topic-name']),
        'description' => trim($_POST['description'])
    ];
    if ($topicData['topic_name'] === '' or $topicData['description'] === ''){
        array_push($errMsg, "Заполните все поля");
    }elseif(mb_strlen($topicData['topic_name'], 'UTF-8') < 2){
        array_push($errMsg, "Заголовок должен быть больше 1 символа, хотя бы 2 поставь, ок да");
    }else{
        $existence = selectOne('topics', $params = ['topic_name' => $topicData['topic_name']]);
        if($existence['topic_name'] === $topicData['topic_name']){
            array_push($errMsg, "Статья с таким заголовком уже есть");
        }else {
                $topic_id = insert('topics', $topicData);
                $topic = selectOne('topics', $params = ['topic_id' => $topic_id]);
                var_dump($topic);
                header('location: ' . BASE_URL . 'admin/topics/index.php');
            }
        }

}else{
    $topicData = [
        'topic_name' => '',
        'description' => ''
    ];
}

//Редактирование категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $topic_id = $_GET['id'];
    $topic = selectOne('topics', ['topic_id' => $topic_id]);
    $topic_id = $topic['topic_id'];
    $topic_name = $topic['topic_name'];
    $description = $topic['description'];
}

//Редактирование категории
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){
    $topicData = [
        'topic_name' => trim($_POST['topic_name']),
        'description' => trim($_POST['description'])
    ];
    if ($topicData['topic_name'] === '' or $topicData['description'] === ''){
        array_push($errMsg, "Заполните все поля");
    }elseif(mb_strlen($topicData['topic_name'], 'UTF-8') < 2){
        array_push($errMsg, "Заголовок должен быть больше 1 символа, хотя бы 2 поставь, ок да");
    }else {
            $topic_id = $_POST['topic_id'];
            $topic = update('topics', 'topic_id', $topic_id, $topicData);
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
}

//Удаление категории
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $topic_id = $_GET['del_id'];
    $topic = selectOne('topics', ['topic_id' => $topic_id]);
    $topic_name = $topic['topic_name'];
    $topic = delete('topics', 'topic_id', $topic_id);
    $errMsg = "Ты уничтожил данную категорию: " . $topic_name . ", тебе стало легче, монстр?";
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}