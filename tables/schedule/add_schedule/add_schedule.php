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
$num_flights = $_POST['num_flights'];
$dest_air_code = $_POST['dest_air_code'];
$airline = $_POST['airline'];
$time_dep = $_POST['time_dep'];
$time_arr = $_POST['time_arr'];
$days_surgery = $_POST['days_surgery'];

// SQL-запрос для добавления записи в базу данных
$sql = "INSERT INTO schedule (id, num_flights, dest_air_code, airline, time_dep, time_arr, days_surgery)
VALUES ('$id', '$num_flights', '$dest_air_code', '$airline', '$time_dep', '$time_arr', '$days_surgery')";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: ../main/schedule.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
