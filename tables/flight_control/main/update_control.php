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
$id_schedule = $_POST['id_schedule'];
$real_time_dpt = $_POST['real_time_dpt'];
$date_dpt = $_POST['date_dpt'];
$employee_ground = $_POST['employee_ground'];
$employee_service = $_POST['employee_service'];
$delta_t = $_POST['delta_t'];

// SQL-запрос для обновления данных
$sql = "UPDATE flight_control SET id_schedule='$id_schedule', real_time_dpt='$real_time_dpt', date_dpt='$date_dpt',
	employee_ground='$employee_ground', employee_service='$employee_service', delta_t='$delta_t' WHERE id='$id'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
