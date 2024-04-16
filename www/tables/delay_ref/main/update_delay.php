<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Ваше имя пользователя
$password = ""; // Ваш пароль
$dbname = "airport"; // Имя вашей базы данных

// Получение данных из JSON-запроса
$data = json_decode(file_get_contents("php://input"), true);

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");

// Получение данных из JSON-запроса
$code_delay = $data['code_delay'];
$decoding = $data['decoding'];

// SQL-запрос для обновления данных
$sql = "UPDATE `delay_ref` SET decoding='$decoding' WHERE code_delay='$code_delay'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
