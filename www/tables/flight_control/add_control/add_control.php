<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "airport";

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");


// Получение данных из формы
$id = $_POST['id'];
$id_schedule = $_POST['id_schedule'];
$real_time_dpt = $_POST['real_time_dpt'];
$date_dpt = $_POST['date_dpt'];
$employee_ground = $_POST['employee_ground'];
$employee_service = $_POST['employee_service'];
$delta_t = $_POST['delta_t'];

// SQL-запрос для добавления записи в базу данных
$sql = "INSERT INTO flight_control (id, id_schedule, real_time_dpt, date_dpt, employee_ground, employee_service, delta_t)
VALUES ('$id', '$id_schedule', '$real_time_dpt', '$date_dpt', '$employee_ground', '$employee_service', '$delta_t')";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: ../main/controls.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
