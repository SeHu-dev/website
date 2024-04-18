<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Управление расписанием</title>
</head>
<body>
    <header>
        <button onclick="location.href='../../../nav/nav.php'" id="homeButton">Навигация</button>
        <h1>Управление расписанием</h1>
        <nav>
            <ul>
				<button onclick="location.href='../../delays/main/delays.php'">Задержки</button>
				<button onclick="location.href='../../employees/main/employees.php'">Справочник задержек</button>
				<button onclick="location.href='../../employees/main/employees.php'">Сотрудники</button>
				<button onclick="location.href='../../flight_control/main/flight_control.php'">Контроль полетов</button>
				<button onclick="location.href='../../airport_ref/main/airport_ref.php'">Справочник аэропортов</button>
				<button onclick="location.href='../../airlines/main/airlines.php'">Авиакомпании</button>
            </ul>
        </nav>
    </header>

    <div>
        <button onclick="location.href='../add_schedule/add_schedule.html'">Добавить новую запись</button>
    </div>

    <h2>Список записей</h2>
    <table>
        <tbody>
            <?php include 'get_schedule.php'; ?>
        </tbody>
    </table>

    <script>
        function editSchedule(id) {
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

            fetch('update_schedule.php', {
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
