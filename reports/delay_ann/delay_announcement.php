<?php
session_start(); // Начало сессии
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylEs.css">
    <title>Информация о задержке рейса</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../nav/nav.php'" id="homeButton">Домой</button> <!-- Кнопка "Домой" в левом верхнем углу -->
        <h1>Информация о задержке рейса</h1>
        <nav>
            <ul>
                <li><a href="../airline/airline_summary.php">Сводка по авиакомпании</a></li> <!-- Ссылка на сводку по авиакомпании -->
                <li><a href="../summary/delays_summary.php">Сводка по задержкам рейсов</a></li> <!-- Ссылка на сводку по задержкам рейсов -->
            </ul>
        </nav>
        <nav>
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Таблицы</a> <!-- Кнопка "Таблицы" в шапке -->
                    <div class="dropdown-content">
                        <a href="airports.php">Аэропорты</a>
                        <a href="delays_reference.php">Справочник задержек</a>
                        <a href="employees.php">Сотрудники</a>
                        <a href="flight_control.php">Контроль полетов</a>
                        <a href="schedule.php">Расписание</a>
                        <a href="airports_dictionary.php">Справочник аэропортов</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <main>
		<section>
			<h2>Информация о задержке выбранного рейса:</h2>

			<form id="flightForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<label for="flight_number">Введите номер рейса:</label>
				<input type="text" id="flight_number" name="flight_number" value="<?php echo isset($_POST['flight_number']) ? htmlspecialchars($_POST['flight_number']) : ''; ?>" required>
				<input type="submit" value="Показать информацию">
			</form>

			<?php
			// Подключаем скрипт для вывода информации о задержке рейса
			include 'get_info_flight.php';
			?>

			<div id="flight_info">
				<!-- Здесь будет отображаться информация о задержке рейса -->
			</div>
			

			<?php
			// Проверяем, была ли установлена информация о задержке рейса и выводим кнопку "Скачать" соответственно
			if (isset($last_row)) {
				echo "<div class='download-button'>";
				echo "<form action='pdf_generation.php' method='POST'>";
				echo "<input type='hidden' name='flight_number' value='" . $last_row["Номер рейса"] . "'>";
				echo "<button type='submit'>Скачать отчет</button>";
				echo "</form>";
				echo "</div>";
			}
			?>
		</section>
    </main>

</body>
</html>
