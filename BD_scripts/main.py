from faker import Faker
import random
from datetime import datetime, timedelta

fake = Faker('ru_RU')

# Генерация N записей для таблицы "работники"
def generate_employees_data(N):
    data = []
    for i in range(N):
        last_name = fake.last_name()
        first_name = fake.first_name()
        patronymic = fake.middle_name()
        birth_date = fake.date_of_birth(minimum_age=20, maximum_age=60)
        gender = random.choice(['M', 'W'])
        education = random.choice(['Высшее', 'Среднее'])
        phone_number = f'+7{random.randint(1000000000, 9999999999)}'
        service_type = random.choice(['наземная', 'обслуживания'])
        if service_type == 'наземная':
            position = random.choice(['Диспетчер', 'Механик', 'Инженер', 'Специалист по технике безопасности', 'Охранник', 'Погрузчик', 'Оператор радиосвязи'])
        else:
            position = random.choice(['Техник-механик', 'Специалист по обслуживанию пассажиров', 'Багажник', 'Авиакассир', 'Специалист по категории безопасности', 'Техник по питанию'])
        passport_series = ''.join([random.choice('0123456789') for _ in range(4)])
        passport_number = ''.join([random.choice('0123456789') for _ in range(6)])
        passport_issue_date = fake.date_between(start_date=birth_date + timedelta(days=365 * 18), end_date='today')
        passport_issuing_authority = f"Отделением УФМС России по {fake.city()}"

        data.append((last_name, first_name, patronymic, birth_date.strftime('%Y-%m-%d'), gender, education, phone_number, service_type, position, f"{passport_series} {passport_number}", passport_issue_date.strftime('%Y-%m-%d'), passport_issuing_authority))
    return data

# Генерация SQL-запроса для добавления данных в таблицу "работники"
def generate_sql_query(data):
    sql_query = "INSERT INTO employees (last_name, first_name, patronymic, birth_date, gender, education, phone_number, service_type, position, passport_number, passport_issue_date, passport_issuing_authority) VALUES\n"
    for record in data:
        sql_query += f"('{record[0]}', '{record[1]}', '{record[2]}', '{record[3]}', '{record[4]}', '{record[5]}', '{record[6]}', '{record[7]}', '{record[8]}', '{record[9]}', '{record[10]}', '{record[11]}'),\n"
    # Удаляем последнюю запятую и перенос строки
    sql_query = sql_query[:-2] + ";"
    return sql_query

# Генерация данных и SQL-запроса для добавления N записей
N = 90  # Желаемое количество записей
employees_data = generate_employees_data(N)
sql_query = generate_sql_query(employees_data)

print(sql_query)  # Выводим SQL-запрос на экран
