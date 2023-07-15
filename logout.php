<?php
require '_functions.php';
// Стартуем сессию:
session_start();

// Выходим из системы
$_SESSION['login'] = null;
$_SESSION['password'] = null;
$_SESSION['auth'] = null;

header('Location: index.php');