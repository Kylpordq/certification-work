# certification-work
# Инструкции по запуску проекта
Убедитесь, что у вас установлен PHP (версия 7.4 или выше) и веб-сервер (например, Apache или Nginx).
<p>
Клонируйте репозиторий с проектом:
git clone <URL репозитория>

Перейдите в папку проекта:
cd <имя папки проекта>
</p>
<p>
Убедитесь, что структура папок соответствует следующим требованиям:<br>
functions/ - папка с файлами функций.<br>
adminPanel/ - административная панель.<br>
css/ - стили для приложения.<br>
questdata/ - данные с вопросами и результатами.
</p>
<p>
Запустите встроенный сервер PHP (если не используете Apache/Nginx/):
</p>
<p>
php -S localhost:8000
</p>
<p>
Перейдите в браузере по адресу 
</p>
<p>
http://localhost:8000/index.php.
</p>

# Краткое описание функционала приложения
<p>
Приложение для тестирования: позволяет пользователям проходить тесты и получать результаты.
Административная панель: предоставляет доступ администраторам для просмотра результатов тестирования пользователей.
Сохранение данных: результаты сохраняются в формате JSON для последующего анализа.
</p>

## Основные компоненты:
<p>
Авторизация администратора: доступ к панели управления возможен только после ввода корректных логина и пароля.
Тестирование: поддержка вопросов с единственным (radio) или несколькими (checkbox) правильными ответами.
Сохранение результатов: результаты пользователей записываются в файл results.json.
</p>

# Примеры тестов
Пример вопроса с одним правильным ответом:
```json
{
        "id": 3,
        "question": "Какая способность используется у Лины для замедления врагов?",
        "type": "radio",
        "options": ["Light Strike Array", "Laguna Blade", "Fiery Soul"],
        "correct": ["Light Strike Array"]
}
```
Пример вопроса с несколькими правильными ответами:
```json
{
        "id": 2,
        "question": "Какие из этих героев могут лечить союзников?",
        "type": "checkbox",
        "options": ["Даззл", "Венга", "Оракл", "Вайт Спирит"],
        "correct": ["Даззл", "Оракл"]
}
```
# Структура базы данных или файла

Данные хранятся в JSON-файлах:
questions.json: содержит вопросы теста.
results.json: сохраняет результаты тестирования пользователей.
Пример структуры файла results.json:
```json
    {
        "name": "Никита",
        "score": 80,
        "correct_answers": 8,
        "total_questions": 10,
        "time": "2025-01-26 03:41:41"
    },
    {
        "name": "Денис",
        "score": 90,
        "correct_answers": 9,
        "total_questions": 10,
        "time": "2025-01-26 03:44:04"
    },
  ```
# Скриншоты работы приложения.
## index.php он же начальная страница 
![image](https://github.com/user-attachments/assets/78c0ca82-a95d-4688-92a5-f01f172214ff)
## test.php (сам тест)
![image](https://github.com/user-attachments/assets/847b5461-9531-4b82-a09f-4731b32a3b07)
![image](https://github.com/user-attachments/assets/630c6b5e-704d-4828-a06b-2fce61b99778)
## result.php (результат теста)
![image](https://github.com/user-attachments/assets/6bfefe11-3bb1-4c61-9d5b-7320e629b553)
## login.php (вход в административную панель)
![image](https://github.com/user-attachments/assets/264b2771-78c4-4103-b604-a31aac6fbe2a)
## dashbord.php (результаты всех прохождений теста)
![image](https://github.com/user-attachments/assets/ae7bd881-7251-4d09-911b-1982995b5933)
![image](https://github.com/user-attachments/assets/c65e9bcd-869c-4624-b892-71f58237039b)




