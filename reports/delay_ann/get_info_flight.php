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
    $sql = "SELECT f.id AS 'Номер рейса', ar.decoding AS 'Аэропорт', a.name_company AS 'Авиакомпания',
                    f.date_dpt AS 'Дата вылета', s.time_dep AS 'Запланированное время вылета', f.delta_t AS 'Время задержки',
                    f.real_time_dpt AS 'Реальное время вылета', dr.decoding AS 'Причина задержки'
            FROM flight_control f
            JOIN schedule s ON f.id_schedule = s.id
            JOIN airport_ref ar ON s.dest_air_code = ar.air_code
            JOIN airlines a ON s.airline = a.id
            LEFT JOIN delays d ON f.id = d.id_flights
            LEFT JOIN delay_ref dr ON d.code_delay = dr.code_delay
            WHERE f.id = '$flight_number'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        echo "<table>";
        echo "<thead><tr><th>Номер рейса</th><th>Аэропорт</th><th>Авиакомпания</th>
                    <th>Дата вылета</th><th>Запланированное время вылета</th><th>Реальное время вылета</th>
                    <th>Время задержки</th><th>Причина задержки</th></tr></thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Номер рейса"] . "</td>";
            echo "<td>" . $row["Аэропорт"] . "</td>";
            echo "<td>" . $row["Авиакомпания"] . "</td>";
            echo "<td>" . $row["Дата вылета"] . "</td>";
            echo "<td>" . $row["Запланированное время вылета"] . "</td>";
            echo "<td>" . $row["Реальное время вылета"] . "</td>";
            echo "<td>" . $row["Время задержки"] . "</td>";
            echo "<td>" . $row["Причина задержки"] . "</td>";
            echo "</tr>";
            // Сохраняем последнюю строку для использования в тексте ниже таблицы
            $last_row = $row;
        }
        echo "</tbody></table>";

        // Генерация текста после таблицы
        $generated_text = "";
        if ($last_row["Время задержки"] == 0) {
            $generated_text = "Рейс " . $last_row["Номер рейса"] . ", направляющийся в " . $last_row["Аэропорт"] . " авиакомпанией " . $last_row["Авиакомпания"] . " " . $last_row["Дата вылета"] . " вылетел без задержки в " . $last_row["Запланированное время вылета"] . ".";
        } else {
            $delay_hours = floor($last_row["Время задержки"] / 3600);
            $delay_minutes = floor(($last_row["Время задержки"] % 3600) / 60);
            $delay_seconds = $last_row["Время задержки"] % 60;
            $generated_text = "Рейс " . $last_row["Номер рейса"] . ", направляющийся в " . $last_row["Аэропорт"] . " авиакомпанией " . $last_row["Авиакомпания"] . " " . $last_row["Дата вылета"] . " должен был вылететь в " . $last_row["Запланированное время вылета"] . ", но был задержан на " . $delay_hours . ":" . $delay_minutes . ":" . $delay_seconds . " по причине " . $last_row["Причина задержки"] . ".";
        }
		
		echo "<p class='generated-text'>$generated_text</p>";

        // Сохранение текста в сессии
        $_SESSION['pdf_text'] = $generated_text;
    } else {
        echo "0 результатов";
    }

    $conn->close();
}
?>
