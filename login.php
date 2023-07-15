<?php
require '_functions.php';
// Стартуем сессию:
session_start();

// Форма авторизации
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

$users = getUsersList();

if (null !== $username || null !== $password) {
	// Проверка на недопустимый логин
	if (strpos($username, ":") !== false) { ?>
		<p style="color: red;">Недопустимый логин</p>
	<?php
	displayLoginForm();
	return;
}

	// Если пароль из базы совпадает с паролем из формы
	if (checkPassword($username, $password)) {
		// Пишем в сессию информацию о том, что мы авторизовались:
		$_SESSION['auth'] = true;

		// Пишем в сессию логин и id пользователя
		$_SESSION['login'] = $username;
	} else { ?>
		<p style="color: red;">Неправильный логин или пароль</p>
	<?php }
}

function displayLoginForm() {
	echo '<form action="login.php" method="post">';
	echo '<input name="login" type="text" placeholder="Логин" autofocus>';
	echo '<input name="password" type="password" placeholder="Пароль">';
	echo '<input name="submit" type="submit" value="Войти">';
	echo '</form>';
}

// displayLoginForm();

$auth = $_SESSION['auth'] ?? null;

if ($auth) {
	// Redirect to main page
	header('Location: index.php');
} else {
	// Show login form
	displayLoginForm();
}
