
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="header">
    <button class="btn" id="login_view">Войти</button>
    <div id="login_form" class="hidden">
        
        <?php require 'login.php';?>
    </div>
    <div class="tree" id="tree">
        <?php $Data->outTreeLight(0,0);?>
    </div>
</body>
</html>