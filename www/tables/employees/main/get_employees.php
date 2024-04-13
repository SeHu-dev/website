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

// SQL-запрос для извлечения информации по задержкам
$sql = "SELECT pers_num, last_name, first_name, father_name, dob, sex, education, phone, corps, job, passport, passport_date, passport_inst FROM employees";
$result = $conn->query($sql);

// SQL-запрос для извлечения информации о сотрудниках
$sql = "SELECT pers_num, last_name, first_name, father_name, dob, sex, education, phone, corps, job, passport, passport_date, passport_inst FROM employees";
$result = $conn->query($sql);

// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr id='" . $row["pers_num"] . "'>";
        echo "<td>" . $row["pers_num"] . "</td>";
        echo "<td data-field='last_name' data-value='" . $row["last_name"] . "'>" . $row["last_name"] . "</td>";
        echo "<td data-field='first_name' data-value='" . $row["first_name"] . "'>" . $row["first_name"] . "</td>";
        echo "<td data-field='father_name' data-value='" . $row["father_name"] . "'>" . $row["father_name"] . "</td>";
        echo "<td data-field='dob' data-value='" . $row["dob"] . "'>" . $row["dob"] . "</td>";
        echo "<td data-field='sex' data-value='" . $row["sex"] . "'>" . $row["sex"] . "</td>";
        echo "<td data-field='education' data-value='" . $row["education"] . "'>" . $row["education"] . "</td>";
        echo "<td data-field='phone' data-value='" . $row["phone"] . "'>" . $row["phone"] . "</td>";
        echo "<td data-field='corps' data-value='" . $row["corps"] . "'>" . $row["corps"] . "</td>";
        echo "<td data-field='job' data-value='" . $row["job"] . "'>" . $row["job"] . "</td>";
        echo "<td data-field='passport' data-value='" . $row["passport"] . "'>" . $row["passport"] . "</td>";
        echo "<td data-field='passport_date' data-value='" . $row["passport_date"] . "'>" . $row["passport_date"] . "</td>";
        echo "<td data-field='passport_inst' data-value='" . $row["passport_inst"] . "'>" . $row["passport_inst"] . "</td>";
        echo "<td>";
        echo "<button class='action-button edit-button' onclick='editEmployee(" . $row["pers_num"] . ")'>Изменить</button>";
        echo "<form action='delete_employee.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
        echo "<input type='hidden' name='pers_num' value='" . $row["pers_num"] . "'>";
        echo "<input type='submit' class='action-button delete-button' value='Удалить'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "0 результатов";
}



// Закрытие подключения
$conn->close();
?>
