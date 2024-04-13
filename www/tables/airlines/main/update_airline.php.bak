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
$name_company = $_POST['name_company'];
$owner = $_POST['owner'];
$airport = $_POST['airport'];
$actual_address = $_POST['actual_address'];
$legal_address = $_POST['legal_address'];
$FIO_gendirector = $_POST['FIO_gendirector'];
$contact_person = $_POST['contact_person'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// SQL-запрос для обновления данных
$sql = "UPDATE airlines SET name_company='$name_company', owner='$owner', airport='$airport', actual_address='$actual_address', legal_address='$legal_address', FIO_gendirector='$FIO_gendirector', contact_person='$contact_person', phone='$phone', email='$email' WHERE id='$id'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
