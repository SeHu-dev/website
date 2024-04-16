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

// SQL-запрос для извлечения информации по авиакомпаниям
$sql = "SELECT id, id_schedule, real_time_dpt, date_dpt, employee_ground, employee_service, delta_t FROM flight_control";
$result = $conn->query($sql);


// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr id='" . $row["id"] . "'>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td data-field='id_schedule' data-value='" . $row["id_schedule"] . "'>" . $row["id_schedule"] . "</td>";
        echo "<td data-field='real_time_dpt' data-value='" . $row["real_time_dpt"] . "'>" . $row["real_time_dpt"] . "</td>";
        echo "<td data-field='date_dpt' data-value='" . $row["date_dpt"] . "'>" . $row["date_dpt"] . "</td>";
        echo "<td data-field='employee_ground' data-value='" . $row["employee_ground"] . "'>" . $row["employee_ground"] . "</td>";
        echo "<td data-field='employee_service' data-value='" . $row["employee_service"] . "'>" . $row["employee_service"] . "</td>";
        echo "<td data-field='delta_t' data-value='" . $row["delta_t"] . "'>" . $row["delta_t"] . "</td>";
        echo "<td>";
        echo "<button class='action-button edit-button' onclick='editControl(" . $row["id"] . ")'>Изменить</button>";
        echo "<form action='delete_control.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
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
