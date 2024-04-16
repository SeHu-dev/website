<?php
// Проверяем, был ли передан год
if(isset($_GET['year'])) {
    // Получаем год из GET-параметра
    $year = $_GET['year'];

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

    // Установка кодировки UTF-8
    mysqli_set_charset($conn, "utf8");

    // SQL-запрос для извлечения информации о распределении задержек по аэропортам за выбранный год
    $sql = "SELECT a.decoding AS airport, COUNT(*) AS cnt_delays
            FROM schedule s
            JOIN airport_ref a ON s.dest_air_code = a.air_code
            LEFT JOIN (
                SELECT *
                FROM flight_control
                WHERE delta_t > 0
            ) t1 ON s.id = t1.id
            WHERE YEAR(date_dpt) = '$year'
            GROUP BY a.decoding";

    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        // Выводим таблицу с информацией о распределении задержек по аэропортам
        echo "<table>";
        echo "<tr><th>Аэропорт</th><th>Количество задержек</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["airport"]."</td><td>".$row["cnt_delays"]."</td></tr>";
        }
        echo "</table>";
    } else {
        // Если результатов нет, выводим сообщение об отсутствии данных
        echo "<p>Нет данных о распределении задержек по аэропортам за выбранный год.</p>";
    }

    // Закрытие подключения
    $conn->close();
}
?>
