<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/authClass.php');

if (isset($_POST)) {
    $post = $_POST;
    $auth = new Auth($db);
    
    switch ($post['type']) {
        case 'login':
            login($post);
            break;
        case 'crud':
            crud($post);
        default:
            $res = [
                'status'=>'error',
                'message'=>'Некорректный запрос'
            ];
            break;
    }
}