<?php 
if(!isset($_COOKIE["PHPSESSID"]))
{
  session_start();
}

if (!isset($_SESSION['login']) || $_SESSION['login'] != 'admin') {
    echo "FORBIDDEN";
    die();
}
//echo 'admin';
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
    <title>Admin Page</title>
</head>
<body>
    <div class="header">
        <form id="form_logout">
            <button class="btn" type="submit">logout</button>
        </form>
    </div>
    <div id="message"></div>
    <div>
        <h1> Admin Page</h1>
    </div>
    <div class='btn-create'  id='btn_create' onclick='createData(0)'>Добавить</div>
    <div class="tree" id="tree">
        <?php $Data->outTree(0,0);?>
    </div>
    <div class="modal-wrapper hidden" id="modal_delete">
        <div class="modal-content">
            <div>
                <h3>Удалить элемент</h3>
                <p id='modal_delete_message'></p>
            </div>
            <div class="modal-control">
                <button class="btn btn-yes" id='btn_delete_yes'>Да</button>
                <button class="btn btn-no" onclick='closeModal("modal_delete")'>Нет</button>
            </div>
        </div>
    </div>

    <div class="modal-wrapper hidden" id="modal_create">
        <div class="modal-content">
            <div>
                <h3>Добавить элемент</h3>
                <p id='modal_create_message'></p>
            </div>
            <div class="modal-control">
                <div>
                    <input class="input" type="text" id="create_name" placeholder="Название">
                </div>
                <div>
                    <input class="input" type="textarea" id="create_description" placeholder="Описание">
                </div>
                <button class="btn btn-yes" id='btn_create_yes'>Да</button>
                <button class="btn btn-no" onclick='closeModal("modal_create")'>Нет</button>
            </div>
        </div>
    </div>
    <div class="modal-wrapper hidden" id="modal_update">
        <div class="modal-content">
            <div>
                <h3>Обновить элемент</h3>
                <p id='modal_update_message'></p>
            </div>
            <div class="modal-control">
                <div>
                    <input class="input" type="text" id="update_name" placeholder="Название">
                </div>
                <div>
                    <input class="input" type="textarea" id="update_description" placeholder="Описание">
                </div>
                <button class="btn btn-yes" id='btn_update_yes'>Да</button>
                <button class="btn btn-no" onclick='closeModal("modal_update")'>Нет</button>
            </div>
        </div>
    </div>
</body>
</html>