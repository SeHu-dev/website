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

    // SQL-запрос для извлечения кода задержки, встречающегося чаще всего за выбранный период
    $sql = "SELECT code_delay
			FROM delays d, flight_control f
			WHERE d.id_flights=f.id AND
			date_dpt BETWEEN '$start_date' AND '$end_date'
			GROUP BY code_delay
			ORDER BY COUNT(*) DESC LIMIT 1";

    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $code_delay = $row['code_delay'];
        // Выводим код задержки
        echo "Код задержки, встречающийся чаще всего за выбранный период:";
        echo " $code_delay</p>";
    } else {
        // Если результатов нет, выводим сообщение об отсутствии данных
        echo "<p>Нет данных о задержках за выбранный период.</p>";
    }

    // Закрытие подключения
    $conn->close();
}
