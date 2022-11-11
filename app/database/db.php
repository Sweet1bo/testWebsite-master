<?php

session_start();

require('connect.php');


function test($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}

//Проверка выполнения запроса к ДБ
function dbCheckErr($query){
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE){
        echo $errInfo[2];
        exit();
    }
}

//Запрос на получение данных одной таблицы с возможностью выбора параметров
function selectAll($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";
    if (!empty($params)){
        $i = 0;
        foreach($params as $key => $value){
            if(!is_numeric($value)){
                $value = "'" . $value . "'";
            }
            if($i === 0){
                $sql = $sql . " WHERE $key = $value";
            }else{
                $sql = $sql . " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbcheckerr($query);
    return $query->fetchAll();
}

// Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $params = []){
    global $pdo;
    $sql = "SELECT * FROM $table";

    if(!empty($params)){
        $i = 0;
        foreach ($params as $key => $value){
            if (!is_numeric($value)){
                $value = "'".$value."'";
            }
            if ($i === 0){
                $sql = $sql . " WHERE $key=$value";
            }else{
                $sql = $sql . " AND $key=$value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetch();

}

//Параметры для вывода строки ассоциативный массив. в
//$params = [
//    'admin' => '1',
//    'username' => 'Tolya'
//];

//Добавляет данные в таблицу
function insert($table, $params){
    global $pdo;
//Переменная для проверки идёт параметр первым или вторым и т.д.
    $i = 0;
    $coll = '';
    $mask = '';
//Добавляет '' и , при запросе в БД
    foreach($params as $key => $value){
        if($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        }else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckErr($query);
    return $pdo->lastInsertId();

}

//Обновление строчки в таблице БД
function update($table, $idName, $id, $params)
{
    global $pdo;
//Переменная для проверки идёт параметр первым или вторым и т.д.
    $i = 0;
    $str = '';
//Добавляет '' и , при запросе в БД
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . $value . "'";
        } else {
            $str = $str . ", " . $key . " = '" . $value ."'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE $idName = $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    dbCheckErr($query);
}

function delete($table, $idName, $id)
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE $idName = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
}

//Выводит все публичные посты с именем создателя
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username
            FROM $table1 AS p 
            JOIN $table2 AS u 
            ON p.id_user = u.id 
            WHERE p.status=1
            LIMIT $limit
            OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetchAll();
}

//Выводит все публичные посты с именем создателя в Категорию
function selectAllFromPostsTopicWithUsersOnIndex($table1, $table2, $topicId, $limit, $offset){
    global $pdo;
    $sql = "SELECT p.*, u.username
            FROM $table1 AS p 
            JOIN $table2 AS u 
            ON p.id_user = u.id 
            WHERE p.status = 1
            AND p.topic_id = $topicId
            LIMIT $limit
            OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetchAll();
}

//Вывод статей на главную
function selectOneFromPostWithUserOnIndex($table1, $table2, $id){
    global $pdo;
    $sql = "SELECT p.*, u.username
            FROM $table1 AS p 
            JOIN $table2 AS u 
            ON p.id_user = u.id 
            WHERE p.id = $id";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetch();
}

//Вывод поиска
function SearchInTitileAndContent($text, $table1, $table2){
    global $pdo;
    $text = trim(strip_tags(stripslashes(htmlspecialchars($text))));
    $sql = "SELECT p.*, u.username
            FROM $table1 AS p 
            JOIN $table2 AS u 
            ON p.id_user = u.id 
            WHERE p.status = 1
            AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetchAll();
}

//Пагинация
function CountRow($table){
    global $pdo;
    $sql = "SELECT COUNT(*)
            FROM $table
            WHERE status = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckErr($query);
    return $query->fetchColumn();
}
