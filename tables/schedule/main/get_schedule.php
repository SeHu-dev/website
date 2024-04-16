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
$sql = "SELECT id, num_flights, dest_air_code, airline, time_dep, time_arr, days_surgery FROM schedule";
$result = $conn->query($sql);


// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr id='" . $row["id"] . "'>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td data-field='num_flights' data-value='" . $row["num_flights"] . "'>" . $row["num_flights"] . "</td>";
        echo "<td data-field='dest_air_code' data-value='" . $row["dest_air_code"] . "'>" . $row["dest_air_code"] . "</td>";
        echo "<td data-field='airline' data-value='" . $row["airline"] . "'>" . $row["airline"] . "</td>";
        echo "<td data-field='time_dep' data-value='" . $row["time_dep"] . "'>" . $row["time_dep"] . "</td>";
        echo "<td data-field='time_arr' data-value='" . $row["time_arr"] . "'>" . $row["time_arr"] . "</td>";
        echo "<td data-field='days_surgery' data-value='" . $row["days_surgery"] . "'>" . $row["days_surgery"] . "</td>";
        echo "<td>";
        echo "<button class='action-button edit-button' onclick='editSchedule(" . $row["id"] . ")'>Изменить</button>";
        echo "<form action='delete_schedule.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
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
