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
$pers_num = $_POST['pers_num'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$father_name = $_POST['father_name'];
$dob = $_POST['dob'];
$sex = $_POST['sex'];
$education = $_POST['education'];
$phone = $_POST['phone'];
$corps = $_POST['corps'];
$job = $_POST['job'];
$passport = $_POST['passport'];
$passport_date = $_POST['passport_date'];
$passport_inst = $_POST['passport_inst'];



// SQL-запрос для обновления данных
$sql = "UPDATE employees SET last_name='$last_name', first_name='$first_name', father_name='$father_name', dob='$dob',
	sex='$sex', education='$education', phone='$phone', corps='$corps', job='$job', passport='$passport', passport_date='$passport_date', passport_inst='$passport_inst' WHERE pers_num='$pers_num'";

// Выполнение запроса
if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие подключения
$conn->close();
?>
