<?php

$link=mysqli_connect('localhost','root','','studentsdb');

if(mysqli_connect_errno())
{
    echo 'Ошибка в подключеннии к БД';
    exit();
}


