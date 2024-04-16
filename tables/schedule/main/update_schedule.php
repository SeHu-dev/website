<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера базы данных
$username = "root"; // Ваше имя пользователя
$password = ""; // Ваш пароль
$dbname = "airport"; // Имя вашей базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");

// Получение данных из POST-запроса
$id = $_POST['id'];
$num_flights = $_POST['num_flights'];
$dest_air_code = $_POST['dest_air_code'];
$airline = $_POST['airline'];
$time_dep = $_POST['time_dep'];
$time_arr = $_POST['time_arr'];
$days_surgery = $_POST['days_surgery'];

// SQL-запрос для обновления данных
$sql = "UPDATE schedule SET num_flights='$num_flights', dest_air_code='$dest_air_code', airline='$airline',
	time_dep='$time_dep', time_arr='$time_arr', days_surgery='$days_surgery' WHERE id='$id'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
