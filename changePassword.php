<?php

session_start();

include "connect.php";

include_once 'validation.php';

$id = $_SESSION['id']; // id юзера из сессии
$query = "SELECT * FROM users WHERE id='$id'";

$res = mysqli_query($link, $query);
$user = mysqli_fetch_assoc($res);

$hash = $user['password']; // соленый пароль из БД
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];

if (!empty($_POST['old_password']) and !empty($_POST['new_password'])) {

	if ($_POST['new_password'] == $_POST['new_password_repeat']) {

		// Проверяем соответствие хеша из базы введенному старому паролю
		if (password_verify($oldPassword, $hash)) {
			$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

			$query = "UPDATE users SET password='$newPasswordHash' WHERE id='$id'";
			mysqli_query($link, $query);
			header('Location: index.php');
		} else {
			$errors[] = 'Неверный пароль';
		}
	} else {
		$errors[] = "Пароли не совпадают.";
	}
}

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
	<input type="password" name="old_password" placeholder="Введите старый пароль">
	<?php echo $err['old_password'] ?>
	<input type="password" name="new_password" placeholder="Введите новый пароль">
	<?php echo $err['new_password'] ?>
	<input type="password" name="new_password_repeat" placeholder="Повторите новый пароль">
	<?php echo $err['new_password'] ?>
	<?php
	if (!empty($errors)) {
		echo '<small class="text-danger">' . array_shift($errors) . '</small>';
	}
	?>
	<button type="submit" name="submit">Изменить</button>
	<a href='index.php'>Вернуться на главную</a>
</form>