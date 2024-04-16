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

// Получение данных из формы
$code_delay = $_POST['code_delay'];
$decoding = $_POST['decoding'];

// SQL-запрос для добавления записи в базу данных
$sql = "INSERT INTO `delay_ref` (code_delay, decoding)
VALUES ('$code_delay', '$decoding')";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: ../main/delay_ref.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
