<?php
$host = 'localhost';
$user = 'root';
$pass = 'root';
$name = 'lab3';

$link = mysqli_connect($host, $user, $pass, $name);

if ($link == false) {
    die("Ошибка подключения");
}
?>