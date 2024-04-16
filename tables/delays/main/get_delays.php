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

// SQL-запрос для извлечения информации по задержкам
$sql = "SELECT id_flights, code_delay, describe_delay, airport FROM delays";
$result = $conn->query($sql);

// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr id='" . $row["id_flights"] . "'>";
        echo "<td>" . $row["id_flights"] . "</td>";
        echo "<td data-field='code_delay' data-value='" . $row["code_delay"] . "'>" . $row["code_delay"] . "</td>";
        echo "<td data-field='describe_delay' data-value='" . $row["describe_delay"] . "'>" . $row["describe_delay"] . "</td>";
        echo "<td data-field='airport' data-value='" . $row["airport"] . "'>" . $row["airport"] . "</td>";
        echo "<td>";

		session_start();
        if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
			echo "<button class='action-button edit-button' onclick='editDelay(" . $row["id_flights"] . ")'>Изменить</button>";
			echo "<form action='delete_delay.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
			echo "<input type='hidden' name='id_flights' value='" . $row["id_flights"] . "'>";
			echo "<input type='submit' class='action-button delete-button' value='Удалить'>";
			echo "</form>";
		}
		echo "</td>";
		echo "</tr>";
    }
} else {
    echo "0 результатов";
}


// Закрытие подключения
$conn->close();
?>
