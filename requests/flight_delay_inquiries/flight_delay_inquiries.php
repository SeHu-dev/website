<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylEs.css">
    <title>Частые задержки: авиакомпания</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../nav/nav.php'" id="homeButton">Домой</button>
        <h1>Частые задержки: авиакомпания</h1>
    </header>
    
    <div class="content-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <label for="start_date">Начало периода:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">

            <label for="end_date">Конец периода:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">

            <input type="submit" value="Показать">
        </form>

        <?php
        // Подключаем файл с обработкой данных
        include 'flight_delay_inquiries_script.php';
        ?>
    </div>
</body>
</html>
