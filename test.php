<?php
include('app/database/db.php');
$params = ['user_id' => '4'];
$result = selectall('user');
$i = 100;
    global $pdo;
    $sql = "SELECT * FROM user WHERE $i = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    var_dump($query);
    exit();
    if($sql != ""){
        echo 'Старый, проходи';
    }else{
        echo 'Почта должна быть уникальной';
    }


