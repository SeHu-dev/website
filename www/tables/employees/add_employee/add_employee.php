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

// SQL-запрос для добавления записи в базу данных
$sql = "INSERT INTO employees (pers_num, last_name, first_name, father_name, dob, sex, education, phone, corps, job, passport, passport_date, passport_inst)
VALUES ('$pers_num', '$last_name', '$first_name', '$father_name', '$dob', '$sex', '$education', '$phone', '$corps', '$job', '$passport', '$passport_date', '$passport_inst')";

if ($conn->query($sql) === TRUE) {
    // Закрытие подключения
    $conn->close();

    // Перенаправление на страницу с записями
    header("Location: ../main/employees.php");
    exit();
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}
?>
