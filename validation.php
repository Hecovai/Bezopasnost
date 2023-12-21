<?php
function clear_data($val)
{
    $val = trim($val);
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlspecialchars($val);
    return $val;
}

$name = clear_data($_POST['name']);
$surname = clear_data($_POST['surname']);
$patronymic = clear_data($_POST['patronymic']);
$login = clear_data($_POST['login']);
$email = clear_data($_POST['email']);
$password = clear_data($_POST['password']);
$oldPassword = clear_data($_POST['old_password']);
$newPassword = clear_data($_POST['new_password']);

$pattern_password = "/[A-Z0-9\W]/";

$err = [];
$flag = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($login)) {
        $err['login'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($name)) {
        $err['name'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($surname)) {
        $err['surname'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($patronymic)) {
        $err['patronymic'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($email)) {
        $err['email'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($password)) {
        $err['password'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (!(mb_strlen($password) >= 8)) {
        $err['password'] = '<small class="text-danger">Пароль должен быть от 8 символов</small>';
        $flag = 1;
    }
    if (!preg_match($pattern_password, $password)) {
        $err['password'] = '<small class="text-danger">Пароль должен содержать хотя бы одну заглавную букву</small>';
        $flag = 1;
    }
    if (empty($oldPassword)) {
        $err['old_password'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }
    if (empty($newPassword)) {
        $err['new_password'] = '<small class="text-danger">Поле не может быть пустым</small>';
        $flag = 1;
    }

}

?>