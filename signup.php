<?php

session_start();

include "connect.php";

include_once 'validation.php';

include 'generator.php';

if (!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['patronymic']) and !empty($_POST['login']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['password_repeat'])) {

    $login = $_POST['login'];
    $query = "SELECT * FROM users WHERE login='$login'";
    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

    $_SESSION['auth'] = true;

    if ($_POST['password'] == $_POST['password_repeat']) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $patronymic = $_POST['patronymic'];
        $email = $_POST['email'];

        if (empty($user)) {
            $query = "INSERT INTO users SET name='$name', surname='$surname', patronymic='$patronymic', login='$login', email='$email', password='$password', status_id='1'";
            mysqli_query($link, $query);

            $query = "SELECT * FROM users WHERE login='$login'";
            $result = mysqli_query($link, $query);
            $user = mysqli_fetch_assoc($result);

            if (!empty($user)) {
                $_SESSION['login'] = $login;
                $_SESSION['auth'] = true;
                header("Location: index.php");
            } else {
                $errors[] = "Произошла ошибка, пожалуйста повторите попытку.";
            }
        } else {
            $errors[] = "Логин занят. Введите другой логин.";
        }
    } else {
        $errors[] = "Пароли не совпадают.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form">
            <input type="text" name="name" placeholder="Имя">
            <?php echo $err['name'] ?>
            <input type="text" name="surname" placeholder="Фамилия">
            <?php echo $err['surname'] ?>
            <input type="text" name="patronymic" placeholder="Отчество">
            <?php echo $err['patronymic'] ?>
            <input type="text" name="login" placeholder="Логин">
            <?php echo $err['login'] ?>
            <input type="email" name="email" placeholder="E-mail">
            <?php echo $err['email'] ?>
            <?php $res = get_pass(); ?>
            <input type="password" id="password" name="password" placeholder="Пароль" value="<?=$res;?>">
            <input type="checkbox" id="togglePassword">
            <?php echo $err['password'] ?>
            <input type="password" name="password_repeat" placeholder="Повторите пароль">
            <?php echo $err['password_repeat'] ?>
            <?php
            if (!empty($errors)) {
                echo '<small class="text-danger">' . array_shift($errors) . '</small>';
            }
            ?>
            <button type="submit" name="doSignUp" >Зарегистрироваться</button>
            <a href="login.php">Уже есть аккаунт</a>
        </div>
    </form>

    <script src="showPassword.js"></script>

</body>

</html>