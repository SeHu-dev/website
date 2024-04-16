<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Управление справочником задержек</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../../nav/nav.php'" id="homeButton">Навигация</button>
        <h1>Управление справочником задержек</h1>
        <nav>
            <ul>
                <li><button onclick="location.href='airports.php'">Аэропорты</button></li>
                <li><button onclick="location.href='employees.php'">Сотрудники</button></li>
                <li><button onclick="location.href='flight_control.php'">Контроль полетов</button></li>
                <li><button onclick="location.href='schedule.php'">Расписание</button></li>
                <li><button onclick="location.href='../../airlines/main/airlines.php'">Авиакомпании</button></li>
            </ul>
        </nav>
    </header>

	<div style="height: 40px;"> <!-- Пример высоты 40px -->
    <?php
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
        echo "<button onclick='location.href=\"../add_delay_ref/add_delay_ref.html\"'>Добавить новую задержку</button>";
    }
    ?>
    </div>
	
    <h2>Список задержек</h2>
    <table>
        <tbody>
            <?php include 'get_delays.php'; ?>
        </tbody>
    </table>

    <script>
        function editDelay(codeDelay) {
            var newDecoding = prompt("Введите новое значение декодирования:", "");
            if (newDecoding === null || newDecoding === "") {
                return; // Если пользователь отменил ввод или ввел пустую строку, выходим из функции
            }

            // Отправляем данные на сервер для обновления
            fetch('update_delay.php', {
                method: 'POST',
                body: JSON.stringify({ code_delay: codeDelay, decoding: newDecoding }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Показываем пользователю результат операции
                location.reload(); // Перезагружаем страницу для отображения обновленных данных
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
