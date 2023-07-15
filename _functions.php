<?php
$USERS_DB = '_users.db.txt';
$USER_DELIMITER = ':';

function getUsersList() {
	global $USERS_DB;
	global $USER_DELIMITER;

	$usersDbFile = fopen($USERS_DB, 'r');
	$usersList = array();

	while (!feof($usersDbFile)) {
		$line = trim(fgets($usersDbFile));
		$explodedLine = explode($USER_DELIMITER, $line);
		$login = $explodedLine[0];
		$passwordHash = $explodedLine[1];

		$user = array(
			'login' => $login,
			'password' => $passwordHash
		);

		$usersList[] = $user;
	}

	fclose($usersDbFile);
	return $usersList;
}

function existsUser($login) {
	$users = getUsersList();

	foreach ($users as $user) {
		if ($user['login'] == $login) {
			return true;
		}
	}

	return false;
}

function checkPassword($login, $password) {
	$users = getUsersList();

	foreach ($users as $user) {
		if ($user['login'] === $login && $user['password'] === sha1($password)) {
			return true;
		}
	}

	return false;
}

function getCurrentUser() {
	session_start();
	return $_SESSION['login'] ?? null;
}
?>