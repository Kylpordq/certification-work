<?php
/**
 * Загружает вопросы из файла JSON.
 *
 * @param string $filePath Путь к файлу с вопросами.
 * @return array Возвращает массив вопросов из файла. Если файл не существует, возвращает пустой массив.
 */
function loadQuestions($filePath) {
    // Проверяем, существует ли файл
    if (!file_exists($filePath)) {
        return [];
    }

    // Читаем содержимое файла и декодируем его как JSON в массив
    $data = file_get_contents($filePath);
    return json_decode($data, true) ?? [];
}

/*
 * Вычисляет количество правильных ответов на основе заданных вопросов и ответов пользователя.
 *
 * @param array $questions Список вопросов.
 * @param array $answers Ответы пользователя.
 * @return int Количество правильных ответов.
 */
function calculateScore($questions, $answers) {
    $correctCount = 0;

    // Перебираем все вопросы
    foreach ($questions as $question) {
        // Если в вопросе нет правильного ответа, пропускаем его
        if (!isset($question['correct'])) {
            continue;
        }

        // Получаем правильный ответ и ответ пользователя
        $correctAnswer = $question['correct'];
        $userAnswer = $answers[$question['id']] ?? null;

        // Проверяем, если это вопрос типа "radio"
        if ($question['type'] === 'radio') {
            // Если правильный ответ - это массив, выбираем первый элемент
            if (is_array($correctAnswer)) {
                $correctAnswer = $correctAnswer[0];  
            }

            // Если ответ пользователя совпадает с правильным, увеличиваем счетчик
            if ($userAnswer === $correctAnswer) {
                $correctCount++;
            }
        }
        // Проверяем, если это вопрос типа "checkbox"
        elseif ($question['type'] === 'checkbox') {
            // Если пользователь выбрал правильные варианты (массивы), считаем ответ правильным
            if (is_array($userAnswer) && is_array($correctAnswer) && !array_diff($correctAnswer, $userAnswer)) {
                $correctCount++;
            }
        }
    }

    return $correctCount;
}

/*
 * Сохраняет результаты теста в файл.
 *
 * @param string $filePath Путь к файлу для сохранения результатов.
 * @param array $result Массив с результатами, которые нужно сохранить.
 * @return void
 */
function saveResults($filePath, $result) {
    // Если файл существует, загружаем текущие результаты
    $results = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];
    
    // Добавляем новый результат
    $results[] = $result;

    // Сохраняем обновленный список результатов в файл
    file_put_contents($filePath, json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
?>
