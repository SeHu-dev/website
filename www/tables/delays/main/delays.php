<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Управление задержками</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../../nav/nav.php'" id="homeButton">Навигация</button>
        <h1>Управление задержками</h1>
        <nav>
            <ul>
                <li><button onclick="location.href='airports.php'">Аэропорты</button></li>
                <li><button onclick="location.href='../../delay_ref/main/delay_ref.php'">Справочник задержек</button></li>
                <li><button onclick="location.href='employees.php'">Сотрудники</button></li>
                <li><button onclick="location.href='flight_control.php'">Контроль полетов</button></li>
                <li><button onclick="location.href='schedule.php'">Расписание</button></li>
                <li><button onclick="location.href='../../airport_ref/main/airport_ref.php'">Справочник аэропортов</button></li>
            </ul>
        </nav>
    </header>

    <div>
        <button onclick="location.href='../add_delay/add_delay.html'">Добавить новую задержку</button>
    </div>

    <h2>Список авиакомпаний</h2>
    <table>
        <tbody>
            <?php include 'get_delays.php'; ?>
        </tbody>
    </table>

    <script>
        function editDelay(id) {
            var row = document.getElementById(id);
            var cells = row.getElementsByTagName("td");

            for (var i = 1; i < cells.length - 1; i++) {
                var cell = cells[i];
                var value = cell.innerText;
                cell.innerHTML = "<input type='text' value='" + value + "' name='" + cell.dataset.field + "'>";
            }

            var okButton = document.createElement("button");
            okButton.innerHTML = "ОК";
            okButton.onclick = function() { saveChanges(id); };
            row.appendChild(okButton);

            var cancelButton = document.createElement("button");
            cancelButton.innerHTML = "Отмена";
            cancelButton.onclick = function() { cancelEdit(id); };
            row.appendChild(cancelButton);

            var editButton = row.querySelector(".edit-button");
            var deleteButton = row.querySelector(".delete-button");
            editButton.style.display = "none";
            deleteButton.style.display = "none";
        }

        function saveChanges(id) {
            var row = document.getElementById(id);
            var inputs = row.getElementsByTagName("input");
            var formData = new FormData();

            for (var i = 0; i < inputs.length; i++) {
                formData.append(inputs[i].name, inputs[i].value);
            }

            fetch('update_delay.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

		function cancelEdit(id) {
			location.reload();
		}



    </script>
</body>
</html>
