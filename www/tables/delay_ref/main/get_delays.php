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

// SQL-запрос для извлечения информации по аэропортам
$sql = "SELECT code_delay, decoding FROM delay_ref";
$result = $conn->query($sql);

// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["code_delay"] . "</td>";
        echo "<td data-field='decoding' data-value='" . $row["decoding"] . "'>" . $row["decoding"] . "</td>";
        echo "<td class='action-buttons'>";
        echo "<div class='button-group'>";
        echo "<button class='action-button edit-button' onclick='editDelay(\"" . $row["code_delay"] . "\")'>Изменить</button>";
        echo "<form action='delete_delay.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
        echo "<input type='hidden' name='code_delay' value='" . $row["code_delay"] . "'>";
        echo "<input type='submit' class='action-button delete-button' value='Удалить'>";
        echo "</form>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>0 результатов</td></tr>";
}




// Закрытие подключения
$conn->close();
?>
