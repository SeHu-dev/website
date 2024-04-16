<?php
// Начало сессии
session_start();

// Уничтожение всех переменных сессии
$_SESSION = array();

// Уничтожение сессии
session_destroy();

// Перенаправление на страницу входа
header("Location: ../login/login.php");
exit;
?>
