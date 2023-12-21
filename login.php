<?php
session_start();

include "connect.php";

include_once 'validation.php';

if (!empty($_POST['password']) and !empty($_POST['login'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT *, statuses.name as status FROM users
    LEFT JOIN statuses
    ON users.status_id=statuses.status_id WHERE login='$login'";  //получаем юзера по логину и джойним статус
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);

    if (!empty($user)) {

        $hash = $user['password']; //солёный пароль из бд
        
        //проверяем соответствие хеша из базы введённому паролю
        if (password_verify($_POST['password'], $hash)) {

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION["login"] = $login;
            $_SESSION['status'] = $user['status'];
            header('Location: index.php');
        } else {
            $errors[] = 'Произошла ошибка, пожалуйста повторите попытку';
        }
    } else {
        $errors[] = 'Неверный логин или пароль';
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
            <input type="text" name="login" placeholder="Логин">
            <?php echo $err['login'] ?>
            <input type="password" name="password" placeholder="Пароль">
            <?php echo $err['password'] ?>
            <?php
            if (!empty($errors)) {
                echo '<small class="text-danger">' . array_shift($errors) . '</small>';
            }
            ?>
            <button type="submit" name="doLogin">Войти</button>
            <a href="signup.php">Создать аккаунт</a>
        </div>
    </form>

</body>

</html>