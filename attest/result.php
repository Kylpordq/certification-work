<?php
$score = $_GET['score'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Результаты</title>
    <link rel="stylesheet" href="css/result.css">
</head>
<body>
    <h1>Ваш результат</h1>
    <p>Вы набрали <?= $score ?>%.</p>
    <a href="index.php">На главную</a>
</body>
</html>