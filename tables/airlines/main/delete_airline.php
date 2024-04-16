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

// Получение идентификатора удаляемой записи
$id = $_POST['id'];

// SQL-запрос для удаления записи из базы данных
$sql = "DELETE FROM airlines WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: airlines.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
