<?php
require_once 'functions/functions.php';

/**
 * Загружает вопросы из файла JSON.
 */
$questions = loadQuestions('questdata/questions.json');

/**
 * Обрабатывает форму, сохраняет результаты и перенаправляет на страницу с результатами.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем имя пользователя и его ответы
    $name = htmlspecialchars($_POST['name']);
    $answers = $_POST['answers'] ?? [];

    // Вычисляем количество правильных ответов
    $correctAnswers = calculateScore($questions, $answers);
    $totalQuestions = count($questions);

    // Если в тесте нет вопросов, выводим ошибку
    if ($totalQuestions === 0) {
        die("Ошибка: в тесте нет вопросов.");
    }

    // Вычисляем процент правильных ответов
    $score = round(($correctAnswers / $totalQuestions) * 100);

    // Сохраняем результаты в файл
    saveResults('questdata/results.json', [
        'name' => $name,
        'score' => $score,
        'correct_answers' => $correctAnswers,
        'total_questions' => $totalQuestions,
        'time' => date('Y-m-d H:i:s')
    ]);

    // Перенаправляем на страницу с результатами
    header("Location: result.php?score=$score");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Пройти тест</title>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
    <!-- Форма для прохождения теста -->
    <form method="POST">
        <!-- Поле для ввода имени пользователя -->
        <label>Введите ваше имя:</label> <br>
        <input type="text" name="name" required><br><br>

        <!-- Вопросы теста -->
        <?php foreach ($questions as $question): ?>
            <p><?= $question['question'] ?></p> <br>

            <!-- Варианты ответов для вопроса с типом "radio" -->
            <?php if ($question['type'] === 'radio'): ?>
                <?php foreach ($question['options'] as $option): ?>
                    <input type="radio" name="answers[<?= $question['id'] ?>]" value="<?= $option ?>"> <?= $option ?><br>
                <?php endforeach; ?>
            <?php elseif ($question['type'] === 'checkbox'): ?>
                <!-- Варианты ответов для вопроса с типом "checkbox" -->
                <?php foreach ($question['options'] as $option): ?>
                    <input type="checkbox" name="answers[<?= $question['id'] ?>][]" value="<?= $option ?>"> <?= $option ?><br>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Кнопка отправки формы -->
        <button type="submit">Завершить тест</button>
    </form>
</body>
</html>
