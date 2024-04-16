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

// SQL-запрос для извлечения информации по авиакомпаниям
$sql = "SELECT id, name_company, owner, airport, actual_address, legal_address, FIO_gendirector, contact_person, phone, email FROM airlines";
$result = $conn->query($sql);

// Проверка наличия результатов и вывод информации
if ($result->num_rows > 0) {
    // Вывод данных каждой строки
    while($row = $result->fetch_assoc()) {
        echo "<tr id='" . $row["id"] . "'>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td data-field='name_company' data-value='" . $row["name_company"] . "'>" . $row["name_company"] . "</td>";
        echo "<td data-field='owner' data-value='" . $row["owner"] . "'>" . $row["owner"] . "</td>";
        echo "<td data-field='airport' data-value='" . $row["airport"] . "'>" . $row["airport"] . "</td>";
        echo "<td data-field='actual_address' data-value='" . $row["actual_address"] . "'>" . $row["actual_address"] . "</td>";
        echo "<td data-field='legal_address' data-value='" . $row["legal_address"] . "'>" . $row["legal_address"] . "</td>";
        echo "<td data-field='FIO_gendirector' data-value='" . $row["FIO_gendirector"] . "'>" . $row["FIO_gendirector"] . "</td>";
        echo "<td data-field='contact_person' data-value='" . $row["contact_person"] . "'>" . $row["contact_person"] . "</td>";
        echo "<td data-field='phone' data-value='" . $row["phone"] . "'>" . $row["phone"] . "</td>";
        echo "<td data-field='email' data-value='" . $row["email"] . "'>" . $row["email"] . "</td>";
        echo "<td>";
        session_start();
        if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
            echo "<button class='action-button edit-button' onclick='editAirline(" . $row["id"] . ")'>Изменить</button>";
            echo "<form action='delete_airline.php' method='POST' onsubmit='return confirm(\"Вы уверены, что хотите удалить эту запись?\");'>";
            echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
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
