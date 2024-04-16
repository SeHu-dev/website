<?php
// Функция для склонения слов
function plural_form($number, $after) {
    $cases = array (2, 0, 1, 1, 1, 2);
    return $after[ ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)] ];
}

// Проверяем, что был выполнен GET-запрос
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

    // Получение выбранного месяца и года из GET-запроса
    $month = $_GET['month'];
    $year = $_GET['year'];

    // SQL-запрос для получения сводки по задержкам за выбранный месяц и год
    $sql = "SELECT dr.code_delay, dr.decoding, COUNT(*) AS delay_count,
            (COUNT(*) / (SELECT COUNT(*) FROM flight_control WHERE MONTH(date_dpt) = '$month' AND YEAR(date_dpt) = '$year' AND delta_t > 0)) * 100 AS delay_percentage
        FROM delay_ref dr
        JOIN delays d ON dr.code_delay=d.code_delay
        JOIN flight_control f ON d.id_flights=f.id
        WHERE MONTH(f.date_dpt) = '$month' AND YEAR(f.date_dpt) = '$year'
        GROUP BY code_delay;";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        echo "<table>";
        echo "<thead><tr><th>Код задержки</th><th>Расшифровка</th><th>Кол-во задержек</th><th>Процент от общего числа задержек</th></tr></thead>";
        echo "<tbody>";
        $total_delay_count = 0; // Переменная для подсчета общего количества задержек
        $max_delay_percentage = 0;
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["code_delay"] . "</td>";
            echo "<td>" . $row["decoding"] . "</td>";
            echo "<td>" . $row["delay_count"] . " " . plural_form($row["delay_count"], array("задержка", "задержки", "задержек")) . "</td>";
            echo "<td>" . round($row["delay_percentage"], 2) . "%</td>";
            echo "</tr>";
            // Подсчитываем общее количество задержек
            $total_delay_count += $row["delay_count"];
            // Находим максимальный процент задержек
            if ($row["delay_percentage"] > $max_delay_percentage) {
                $max_delay_percentage = $row["delay_percentage"];
                $max_delay_code = $row["code_delay"];
                $max_delay_reason = $row["decoding"];
                $max_delay_count = $row["delay_count"];
            }
        }
        echo "</tbody></table>";

		// Инициализация переменной для хранения сгенерированного текста
		$generated_text = "";

		// Добавляем текст ниже таблицы
		$generated_text .= "<div class='table-info'>";
		// Проверяем, есть ли более одного уникального кода задержки
		$generated_text .= "<p>За " . $month . " " . $year . " " . plural_form($total_delay_count, array("был", "было", "было")) . " " . plural_form($total_delay_count, array("задержан", "задержано", "задержано")) . " " . $total_delay_count . " " . plural_form($total_delay_count, array("рейс", "рейса", "рейсов"));
		if ($result->num_rows > 1) {
			$generated_text .= " " . " по " . $result->num_rows . " " . plural_form($result->num_rows, array("различной", "различным", "различным")) . " причинам.</p>";
			$generated_text .= "<p>Наибольшее количество задержек было совершено по причине \"" . $max_delay_reason . "\" - " . round($max_delay_percentage, 2) . "%.</p>";
		}
		else {
			$generated_text .= "по причине " . $max_delay_reason . ".</p>";
		}
		$generated_text .= "</div>";
		
		$_SESSION['pdf_text'] = $generated_text;


    } else {
        echo "<p>0 результатов</p>";
    }

    $conn->close();
}
?>
