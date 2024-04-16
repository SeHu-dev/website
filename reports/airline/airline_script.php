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
    $sql = "SELECT COUNT(*) as cnt_flights,
                    SUM(CASE WHEN f.delta_t > 0 THEN 1 ELSE 0 END) AS cnt_delays
            FROM 
                flight_control f
                INNER JOIN schedule s ON f.id_schedule = s.id
                INNER JOIN airlines a ON s.airline = a.id
            WHERE 
                a.name_company = '$airline'
                AND f.date_dpt BETWEEN '$start_date' AND '$end_date'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных в текстовом формате
        $row = $result->fetch_assoc();
        $cnt_flights = $row['cnt_flights'];
		if ($row['cnt_delays']) {
			$cnt_delays = $row['cnt_delays'];
		}
		else {
			$cnt_delays = 0;
		}

		$_SESSION['pdf_text'] = "С $start_date по $end_date авиакомпания $airline совершила $cnt_flights рейсов. Из них было задержено $cnt_delays";
        echo $_SESSION['pdf_text'];
		// Сохранение полученных данных в сессии
    } else {
        echo "0 результатов";
    }

    $conn->close();
}
?>
