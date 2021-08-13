<?php 
session_start();
include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/authClass.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/crud.php');
 if (isset($_POST)) {
    // $post = json_decode(file_get_contents('php://input'), true);
   
     $post = $_POST;
    $auth = new Auth($db);
   
    
    switch ($post['type']) {
        case 'login':
            $res = login($post, $db);
            echo json_encode($res);
            break;
        case 'crud':
            //crud($post);
        case 'logout':
            
            logout($db);
        case 'delete':
            deleteData($post['id'], $db);
            break;
        case 'create':
            createData($post, $db);
            break;
        case 'update':
            updateData($post['name'], $post['id'], $db);
            break;
        default:
            $res = [
                'status'=>'error',
                'message'=>'Некорректный запрос'
            ];

            echo json_encode($res);
            break;
    }
 }

function login($post, $db){
    if($post['login'] == '' || $post['pass'] == ''){
        $res = [
            'status'=>'error',
            'message'=>'Логин или пароль пустые'
        ];

        return $res;
    }

    if($post['login'] != '' && $post['pass'] != ''){
        $login = strip_tags($post['login']);
        $pass = strip_tags($post['pass']);

        $auth = new Auth($db);

        if ($auth->auth($login, $pass)) {
            $_SESSION["login"] = $login;
            $res = [
                'status'=>'ok',
                'message'=>"Здравствуйте, {$login}"
            ];

            return $res;
        }

        $res = [
            'status'=>'error',
            'message'=>'Логин или пароль неверный'
        ];
        return $res;
    }


    
}


function logout($db){
    $auth = new Auth($db);
    $auth->out();
    $res = [
        'status'=>'ok',
        'message'=>'вы вышли из системы'
    ];
    echo json_encode($res);
}


function createData($post,$db){
    $data = new Crud($db);
    $data->createData($post);
    $res = [
        'status'=>'ok',
        'message'=>'Запись добавлена'
    ];
    echo json_encode($res);
}

function deleteData($id,$db){
    $data = new Crud($db);
    $data->deleteDataById($id);
    $res = [
        'status'=>'ok',
        'message'=>'Запись удалена'
    ];
    echo json_encode($res);
}

function updateData($name,$id,$db){
    $data = new Crud($db);
    $data->updateDataById($name,$id);
    $res = [
        'status'=>'ok',
        'message'=>'Запись удалена'
    ];
    echo json_encode($res);
}