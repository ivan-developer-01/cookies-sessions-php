<?php
require '_functions.php';
// Login form
$username = $_POST['login'] ?? null;
$password = $_POST['password'] ?? null;

// зададим книгу паролей
$users = getUsersList();

if (null !== $username || null !== $password) {

	// Если пароль из базы совпадает с паролем из формы
	if (checkPassword($username, $password)) {
		// Стартуем сессию:
		session_start();

		// Пишем в сессию информацию о том, что мы авторизовались:
		$_SESSION['auth'] = true;

		// Пишем в сессию логин и id пользователя
		$_SESSION['login'] = $username;
	} else { ?>
		<p style="color: red;">Неправильный логин или пароль</p>
	<?php }
}

$auth = $_SESSION['auth'] ?? null;

if ($auth) {
	// Redirect to main page
	header('Location: index.php');
} else {
	// Show login form
?>
	<form action="login.php" method="post">
		<input name="login" type="text" placeholder="Логин">
		<input name="password" type="password" placeholder="Пароль">
		<input name="submit" type="submit" value="Войти">
	</form>
<?php }
