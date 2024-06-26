<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Отчеты и таблицы</title>
</head>
<body>
    <header>
        <h1>Отчеты и таблицы</h1>
    </header>

    <section id="reports">
        <h2>Отчеты</h2>
        <button onclick="location.href='../reports/summary/delays_summary.php'">Сводка по задержкам рейсов</button>
        <button onclick="location.href='../reports/airline/airline_summary.php'">Сводка по авиакомпании</button>
        <button onclick="location.href='../reports/delay_ann/delay_announcement.php'">Информация для объявления о задержке</button>
    </section>

    <section id="tables">
        <h2>Таблицы</h2>
        <button onclick="location.href='../tables/delay_ref/main/delay_ref.php'">Справочник задержек</button>
        <button onclick="location.href='employees.php'">Сотрудники</button>
        <button onclick="location.href='flight_control.php'">Контроль полетов</button>
        <button onclick="location.href='schedule.php'">Расписание</button>
        <button onclick="location.href='../tables/airport_ref/main/airport_ref.php'">Справочник аэропортов</button>
        <button onclick="location.href='../tables/airlines/main/airlines.php'">Авиакомпании</button>
		
    </section>

</body>
</html>
