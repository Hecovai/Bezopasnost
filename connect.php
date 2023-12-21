<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$name = 'site';

$link = mysqli_connect($host, $user, $pass, $name);

if ($link == false) {
    echo "Ошибка подключения";
}

?>