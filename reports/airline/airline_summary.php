<?php
session_start(); // Начало сессии
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylEs.css">
    <title>Сводка по авиакомпании за период</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../nav/nav.php'" id="homeButton">Домой</button> <!-- Кнопка "Домой" в левом верхнем углу -->
        <h1>Сводка по авиакомпании за период</h1>
        <nav>
            <ul>
                <li><a href="../summary/delays_summary.php">Сводка по задержкам рейсов</a></li> <!-- Ссылка на сводку по задержкам рейсов -->
                <li><a href="../delay_ann/delay_announcement.php">Информация для объявления о задержке</a></li>
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
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
        <label for="airline">Выберите авиакомпанию:</label>
        <select id="airline" name="airline">
            <?php include 'get_airlines.php'; ?>
            <?php
            if (isset($_GET['airline'])) {
                $selected_airline = $_GET['airline'];
                echo "<script>document.getElementById('airline').value = '$selected_airline';</script>";
            }
            ?>
        </select>

        <label for="start_date">Начало периода:</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">

        <label for="end_date">Конец периода:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">

        <input type="submit" value="Показать">
    </form>

    <h2>Информация по выбранной авиакомпании и периоду:</h2>

    
	<tbody>
		<!-- PHP-код будет вставлен здесь -->
		<?php include 'airline_script.php'; ?>
	</tbody>

	    <?php
    // Проверяем, был ли установлен текст для отчета и выводим кнопку "Сохранить отчет" соответственно
    if (isset($_SESSION['pdf_text'])) {
        echo "<div class='download-button'>";
        echo "<form action='pdf_generation.php' method='POST'>";
        echo "<input type='hidden' name='pdf_text' value='" . $_SESSION['pdf_text'] . "'>";
        echo "<button type='submit'>Сохранить отчет</button>";
        echo "</form>";
        echo "</div>";
    }
    ?>


</body>
</html>
