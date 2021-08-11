<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/authClass.php');

//echo 'index';
$database = new connect();
$db = $database->getConnect();
$auth = new Auth($db);
echo($_SESSION['is_auth']);
print_r($auth->auth('ivan', 'asd'));

if ($_SESSION['is_auth'] && $_SESSION['login']=='admin') {
    require 'admin.php';
}else{
    require 'login.php';
}

?>