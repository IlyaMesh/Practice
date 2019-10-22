<?php
session_start();
?>
<html lang='ru'>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewpoint" content="width=device-width, initial-scale=1">
        <title>Анкета студента</title>
        
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
       
    </head>
    <body>
        <div class="navbar-inverse navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Главная</a>
                    <a class="navbar-brand" href="analyze.php">Анализ</a>
                </div>
                
                <form class="navbar-form navbar-left" role="search" method="post" action="finder.php">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search">
    </div>
    <button type="submit" class="btn btn-default">
        <span class="glyphicon glyphicon-search"></span>
    </button>
                </form>
                <?php
                        if(isset($_SESSION["session_username"])):?>
                    <p class="navbar-text">Вы вошли как:<?=$_SESSION["session_username"]?></p>
                    <a class="navbar-text" href="logout.php">Выйти</a>
                    <?php else:?>   
                    <a class="navbar-text" href="login.php">Войти</a>
                    <?php endif;?>
            </div>
        </div>
        
    </body>
