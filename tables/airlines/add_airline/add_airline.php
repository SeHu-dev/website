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
$name = $_POST['name'];
$owner = $_POST['owner'];
$airport = $_POST['airport'];
$actual_address = $_POST['actual_address'];
$legal_address = $_POST['legal_address'];
$FIO_gendirector = $_POST['FIO_gendirector'];
$contact_person = $_POST['contact_person'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// SQL-запрос для добавления записи в базу данных
$sql = "INSERT INTO airlines (name_company, owner, airport, actual_address, legal_address, FIO_gendirector, contact_person, phone, email)
VALUES ('$name', '$owner', '$airport', '$actual_address', '$legal_address', '$FIO_gendirector', '$contact_person', '$phone', '$email')";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: ../main/airlines.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
