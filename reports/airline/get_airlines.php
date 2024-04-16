<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; // Пустой пароль
$dbname = "airport";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Установка кодировки символов
$conn->set_charset("utf8");

// SQL-запрос для получения списка авиакомпаний
$sql = "SELECT name_company FROM airlines";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["name_company"] . "'>" . $row["name_company"] . "</option>";
    }
} else {
    echo "<option value=''>Нет доступных авиакомпаний</option>";
}

$conn->close();
?>
