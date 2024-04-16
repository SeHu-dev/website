<?php
// Проверяем, были ли переданы даты начала и конца периода
if(isset($_GET['start_date']) && isset($_GET['end_date'])) {
    // Получаем начальную и конечную даты периода из GET-параметров
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

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

    // SQL-запрос для извлечения декодирования, при котором в среднем возникала наибольшая задержка по времени за выбранный период
    $sql = "SELECT decoding
            FROM delays d, delay_ref dr, flight_control f
            WHERE d.code_delay = dr.code_delay AND
                f.id = d.id_flights AND
                f.date_dpt BETWEEN '$start_date' AND '$end_date'
            GROUP BY decoding
            ORDER BY AVG(delta_t) DESC
            LIMIT 1";

    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $decoding = $row['decoding'];
        // Выводим декодирование
        echo "<p>По какой причине возникала наибольшая (в среднем) задержка по времени за выбранный период: $decoding</p>";
    } else {
        // Если результатов нет, выводим сообщение об отсутствии данных
        echo "<p>Нет данных о задержках за выбранный период.</p>";
    }

    // Закрытие подключения
    $conn->close();
}
?>
