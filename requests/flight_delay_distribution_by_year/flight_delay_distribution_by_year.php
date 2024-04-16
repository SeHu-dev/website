<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylEs.css">
    <title>Распределение задержек по аэропортам за год</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../nav/nav.php'" id="homeButton">Домой</button>
        <h1>Распределение задержек по аэропортам за год</h1>
    </header>
    
    <div class="content-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
            <label for="year">Выберите год:</label>
            <input type="number" id="year" name="year" value="<?php echo isset($_GET['year']) ? htmlspecialchars($_GET['year']) : ''; ?>" min="1900" max="2099">

            <input type="submit" value="Показать">
        </form>

        <?php
        // Подключаем файл с обработкой данных
        include 'flight_delay_distribution_by_year_script.php';
        ?>
    </div>
</body>
</html>
