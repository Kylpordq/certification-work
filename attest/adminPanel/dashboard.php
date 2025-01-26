<?php

/**
 * Начинает сессию и подключает необходимые файлы.
 * Загружает результаты из файла JSON и проверяет, вошел ли пользователь в систему.
 */
session_start();
require __DIR__ . '/../functions/functions.php';

/**
 * Загружает результаты из файла JSON.
 *
 * @var array Массив с результатами пользователей.
 */
$results = loadQuestions(__DIR__ . '/../questdata/results.json');

/**
 * Проверка, авторизован ли пользователь.
 * Если нет, перенаправляет на страницу входа.
 */
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login.php');
    exit;
}
?>
<a href="logout.php">Выйти</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Административная панель</title>
    <link rel="stylesheet" href="../css/result.css">
</head>
<body>
    <h1>Результаты пользователей</h1>
    <table border="1">
        <tr>
            <th>Имя</th>
            <th>Баллы</th>
            <th>Правильные ответы</th>
            <th>Время</th>
        </tr>
        <?php foreach ($results as $result): ?>
            <tr>
                <td><?= $result['name'] ?></td>
                <td><?= $result['score'] ?>%</td>
                <td><?= $result['correct_answers'] ?>/<?= $result['total_questions'] ?></td>
                <td><?= $result['time'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="../index.php">На главную</a>
</body>
</html>
