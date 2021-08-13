<?php 
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// $_SESSION['login'] = '';
// print_r($_COOKIE);


include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/authClass.php');

//echo 'index';
$database = new connect();
$db = $database->getConnect();
$auth = new Auth($db);

include_once($_SERVER['DOCUMENT_ROOT'].'/controllers/crud.php');
$Data = new Crud($db);
$all_data = $Data->getAll();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="/assets/js/script.js"></script>
    <title>Document</title>
</head>
<body>
   
   
</body>
</html>



<?php 
if (isset($_SESSION['login']) && $_SESSION['login']=='admin') {
    require 'admin.php';
}else{
    require 'data-list.php';
}

?>