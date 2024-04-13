<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
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

    // Получение выбранных данных из GET-запроса
    $airline = $_GET['airline'];
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // SQL-запрос для получения информации по выбранной авиакомпании и периоду
    $sql = "SELECT s.num_flights, f.real_time_dpt, f.date_dpt, f.employee_ground, f.employee_service, f.delta_t
            FROM schedule s
            LEFT JOIN flight_control f ON s.id = f.id_schedule
            LEFT JOIN airlines a ON s.airline=a.id
            WHERE name_company = '$airline' AND date_dpt BETWEEN '$start_date' AND '$end_date'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["num_flights"] . "</td>";
            echo "<td>" . $row["real_time_dpt"] . "</td>";
            echo "<td>" . $row["date_dpt"] . "</td>";
            echo "<td>" . $row["employee_ground"] . "</td>";
            echo "<td>" . $row["employee_service"] . "</td>";
            echo "<td>" . $row["delta_t"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>0 результатов</td></tr>";
    }

    $conn->close();
}
?>
