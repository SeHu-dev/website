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

	// Получение выбранного месяца из GET-запроса
	$month = $_GET['month'];

	// SQL-запрос для получения сводки по задержкам за выбранный месяц
	$sql = "SELECT dr.code_delay, dr.decoding, COUNT(*) AS delay_count,
			(COUNT(*) / (SELECT COUNT(*) FROM flight_control WHERE MONTH(date_dpt) = '$month' AND delta_t > 0)) * 100 AS delay_percentage,
			(COUNT(*) / (SELECT COUNT(*) FROM flight_control WHERE MONTH(date_dpt) = '$month') * 100) AS flight_delay_percentage
		FROM delay_ref dr
		JOIN delays d ON dr.code_delay=d.code_delay
		JOIN flight_control f ON d.id_flights=f.id
		WHERE MONTH(f.date_dpt) = '$month'
		GROUP BY code_delay;";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// Вывод данных в таблицу
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["code_delay"] . "</td>";
			echo "<td>" . $row["decoding"] . "</td>";
			echo "<td>" . $row["delay_count"] . "</td>";
			echo "<td>" . round($row["delay_percentage"], 2) . "%</td>";
			echo "<td>" . round($row["flight_delay_percentage"], 2) . "%</td>";
			echo "</tr>";
		}
	} else {
		echo "<tr><td colspan='5'>0 results</td></tr>";
	}

	$conn->close();
}
?>
