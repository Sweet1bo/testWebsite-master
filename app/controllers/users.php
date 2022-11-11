<?php
include __DIR__ . '/../database/db.php';
include __DIR__ . '/../include/path.php';
$isSubmit = false;
$errMsg = [];

//Функция после регистрации/авторизации которой создаёться сессия, пользователь переходит на главную/адпин панель
function userAuth($Data = [])   {
    $_SESSION['id'] = $Data['id'];
    $_SESSION['admin'] = $Data['admin'];
    $_SESSION['username'] = $Data['username'];
if($_SESSION['admin']){
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }else{
    header('location: ' . BASE_URL);
    }
}    

//Функция для регистрации пользователя, применяеться для регистрации и регистрации с админки




//Код для регистрации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){

//Проверка Админ/Не админ
if($_POST['admin']){
    $_POST['admin'] = 1;
}else{
    $_POST['admin'] = 0;
}

    $regData = [
        'username' => trim($_POST['login']),
        'email' => trim($_POST['mail']),
        'password' => trim($_POST['pass-second']),
        'admin' => $_POST['admin']
    ];
    if ($regData['username'] === '' or $regData['email'] === '' or $regData['password'] === ''){
        array_push($errMsg, "Заполните все поля");
    }elseif(mb_strlen($regData['username'], 'UTF-8') < 2){
        array_push($errMsg, "Логин должен быть больше двух символов");
    }elseif($regData['password'] !== $_POST['pass-first']){
        array_push($errMsg, "Пароли в обеих полях должны соответствовать");
    }else{
        $existence = selectOne('user', $params = ['email' => $regData['email']]);
        if($existence['email'] === $regData['email']){
            array_push($errMsg, "Пользователь с таким email-ом уже есть");
        }else {
            $existence = selectOne('user', $params = ['username' => $regData['username']]);
            if ($existence['username'] === $regData['username']) {
                array_push($errMsg, "Пользователь с таким именем уже есть");
            } else {
                $regData['password'] = password_hash($_POST['pass-second'], PASSWORD_DEFAULT);
                $id = insert('user', $regData);
                $regData = selectOne('user', ['id' => $id]);
                userAuth($regData);
            }
        }
    }
}else{
    $regData = [
        'username' => '',
        'email' => ''
    ];
}

//Кот для авторизации
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){

    $logData = [
        'username' => trim($_POST['login']),
        'email' => trim($_POST['mail']),
        'password' => trim($_POST['password'])
    ];

    if ($logData['email'] === '' or $logData['password'] === ''){
        $errMsg = "Заполните все поля";
    }else {
        $existence = selectOne('user', $params = ['email' => $logData['email']]);
        if($existence && password_verify($logData['password'], $existence['password'])){
         //
            userAuth($existence);
         //
        }else{
            $_SESSION['authTry']++;
            if ($_SESSION['authTry'] >= 3) {

                // Если такая переменная есть, то проверим прошло 25 секунд
                // Иначе создадим/обновим переменную
                if ($_SESSION['banTimer']) {
                    if (time() - $_SESSION['banTimer'] > 15) {
                        $_SESSION['authTry'] = 0;
                        // Удаляем переменную
                        unset($_SESSION['banTimer']);
                    }
                }
                else {
                    $_SESSION['banTimer'] = time();
                    $errMsg = 'Тебе бан, сука. На 30сек.';
                }
            }
            else {
                $i = 3 - $_SESSION['authTry'];
                $errMsg = "Не правильный логин или пароль. Осталось попыток: " . $i;
            }
        }
    }
}else{
    $logData = [
        'username' => '',
        'email' => ''
    ];
}

//Редактирование Пользователя
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post_id = $_GET['id'];
    $post = selectOne('posts', ['id' => $post_id]);
}

//Редактирование Пользователя
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){
        if(is_null($_POST['pass-second'])) {
            $user = selectOne('user', ['id' => $_GET['id']]);
            $userData = [
                'password' => $user['password']
            ];
        }elseif(mb_strlen($_POST['login'], "UTF-8") < 2){
            array_push($errMsg, "Пажылой, логин больше 2-х символов");
        }elseif($_POST['pass-first'] != $_POST['pass-second']){
            array_push($errMsg, "Родной, пароли должны совпадать");
        } else{
            $userData = [
                'username' => $_POST['login'],
                'email' => $_POST['mail'],
                'password' => password_hash($_POST['pass-second'], PASSWORD_DEFAULT)
            ];
            $user = update('user', 'id', $_POST['id'], $userData);
            header("location: " . BASE_URL . "admin/users/index.php");
        }
    }else{
        $userData = [
          'username' => '',
          'email' => ''
        ];
    }

//Редактировать права Админ/Не админ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $admin = $_GET['admin'];

    $post_id = update('user', 'id', $user_id, ['admin' => $admin] );

    header('location: ' . BASE_URL . 'admin/users/index.php');
    exit();
}

//Удаление пользователя
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    if($_SESSION['id'] == $_GET['del_id']){
        array_push($errMsg, "Ты дэбил? Этш твой акк!");
    }else {
        $user = delete('user', 'id', $_GET['del_id']);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}