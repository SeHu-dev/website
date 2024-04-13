<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Сводка по задержкам рейсов</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../nav/nav.php'" id="homeButton">Домой</button> <!-- Кнопка "Домой" в левом верхнем углу -->
        <h1>Сводка по задержкам рейсов</h1>
        <nav>
            <ul>
                <li><a href="../airline/airline_summary.php">Сводка по авиакомпании</a></li> <!-- Ссылка на сводку по авиакомпании -->
                <li><a href="../delay_ann/delay_announcement.php">Информация для объявления о задержке</a></li>
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
        <label for="month">Выберите месяц:</label>
        <select id="month" name="month">
            <option value="01" <?php if(isset($_GET['month']) && $_GET['month'] === '01') echo 'selected'; ?>>Январь</option>
            <option value="02" <?php if(isset($_GET['month']) && $_GET['month'] === '02') echo 'selected'; ?>>Февраль</option>
            <option value="03" <?php if(isset($_GET['month']) && $_GET['month'] === '03') echo 'selected'; ?>>Март</option>
            <option value="04" <?php if(isset($_GET['month']) && $_GET['month'] === '04') echo 'selected'; ?>>Апрель</option>
            <option value="05" <?php if(isset($_GET['month']) && $_GET['month'] === '05') echo 'selected'; ?>>Май</option>
            <option value="06" <?php if(isset($_GET['month']) && $_GET['month'] === '06') echo 'selected'; ?>>Июнь</option>
            <option value="07" <?php if(isset($_GET['month']) && $_GET['month'] === '07') echo 'selected'; ?>>Июль</option>
            <option value="08" <?php if(isset($_GET['month']) && $_GET['month'] === '08') echo 'selected'; ?>>Август</option>
            <option value="09" <?php if(isset($_GET['month']) && $_GET['month'] === '09') echo 'selected'; ?>>Сентябрь</option>
            <option value="10" <?php if(isset($_GET['month']) && $_GET['month'] === '10') echo 'selected'; ?>>Октябрь</option>
            <option value="11" <?php if(isset($_GET['month']) && $_GET['month'] === '11') echo 'selected'; ?>>Ноябрь</option>
            <option value="12" <?php if(isset($_GET['month']) && $_GET['month'] === '12') echo 'selected'; ?>>Декабрь</option>
        </select>
        <input type="submit" value="Показать">
    </form>

    <h2>Сводка по задержкам за выбранный месяц:</h2>

    <table>
        <thead>
            <tr>
                <th>Код задержки</th>
                <th>Расшифровка</th>
                <th>Кол-во задержек</th>
                <th>Процент от общего числа задержек</th>
                <th>Процент от общего числа рейсов</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP-код будет вставлен здесь -->
            <?php include 'summary.php'; ?>
        </tbody>
    </table>

    <script>
        // Функция для перехода на страницу "Домой" при клике на кнопку "Дом
