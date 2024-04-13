<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Получение номера рейса из формы
    $flight_number = $_POST['flight_number'];

    // SQL-запрос для получения информации о задержке выбранного рейса
    $sql = "SELECT date_dpt, real_time_dpt, delta_t
            FROM flight_control 
            WHERE id_schedule IN (SELECT id FROM schedule WHERE num_flights = '$flight_number')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        echo "<table>";
        echo "<thead><tr><th>Дата вылета</th><th>Запланированное время вылета</th><th>Задержка (в сек)</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["date_dpt"] . "</td>";
            echo "<td>" . $row["real_time_dpt"] . "</td>";
            echo "<td>" . $row["delta_t"] . "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "0 результатов";
    }

    $conn->close();
}
?>
