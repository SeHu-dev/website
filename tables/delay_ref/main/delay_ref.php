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
				<button onclick="location.href='../../delays/main/delays.php'">Задержки</button>
				<button onclick="location.href='../../employees/main/employees.php'">Справочник задержек</button>
				<button onclick="location.href='../../employees/main/employees.php'">Сотрудники</button>
				<button onclick="location.href='../../flight_control/main/flight_control.php'">Контроль полетов</button>
				<button onclick="location.href='../../schedule/main/schedule.php'">Расписание</button>
				<button onclick="location.href='../../airport_ref/main/airport_ref.php'">Справочник аэропортов</button>
				<button onclick="location.href='../../airlines/main/airlines.php'">Авиакомпании</button>
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
