<?php
session_start();

// Подключаемся к базе данных (замените параметры подключения на ваши)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airport";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Подготавливаем запрос на получение информации о пользователе
        $stmt = $conn->prepare("SELECT role FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->bind_result($role); // Связываем переменные с результатами запроса
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Пользователь найден
            $_SESSION["username"] = $username;
            $stmt->fetch(); // Получаем данные пользователя
            $_SESSION["role"] = $role;

            // Перенаправляем на скрипт обработки логина
            header("Location: ../nav/nav.php");
            exit;
        } else {
            // Если пользователь не найден, сохраняем ошибку в сессии
            $_SESSION['login_error'] = true;
        }
        $stmt->close();
    }
}

// Перенаправляем на форму входа в случае ошибки или если нет данных в $_POST
header("Location: login.php");
exit;
?>

