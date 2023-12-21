<?php
session_start();

include "connect.php";

//$result = mysqli_query($link, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php if (!empty($_SESSION['auth'])) { ?>
        <a href='logout.php'>Выход</a>
        <a href='changePassword.php'>Изменить пароль</a>
    <?php } else { ?>
        <a href='login.php'>Вход</a>
        <a href='signup.php'>Регистрация</a>
    <?php } ?>

</body>

</html>