<?php 
//session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
</head>
<body>
    <main>
        <div class="login">
            <div class="login__title">
                <h2>Авторизация</h2>
            </div>
            <div class="login__form">
                <form id="form_login" action="">
                    <input type="text" name="login" placeholder="Login">
                    <input type="text" name="pass" placeholder="Password">
                    <button class="btn btn-submit" type="submit">LogIn</button>
                </form>
            </div>
            <div id="message"></div>
        </div>
        
    </main>
</body>
</html>