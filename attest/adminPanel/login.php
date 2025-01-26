<?php
/**
 * Начинает сессию и обрабатывает процесс авторизации для входа в административную панель.
 * Проверяет логин и пароль, а также перенаправляет пользователя в случае успешного входа.
 */
session_start();

/**
 * Фиксированные логин и пароль администратора.
 * Эти данные используются для проверки входа.
 *
 * @var string Логин администратора.
 * @var string Пароль администратора.
 */
$adminUsername = "admin";
$adminPassword = "password";

/**
 * Проверка, если пользователь уже авторизован.
 * Если да, перенаправляет на страницу панели управления (dashboard.php).
 */
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
}

/**
 * Обработка формы авторизации при отправке POST-запроса.
 * Проверяет логин и пароль.
 * В случае успеха устанавливает сессию и перенаправляет на dashboard.php.
 * В случае неудачи выводит ошибку.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Неверные логин или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <h1>Вход в административную панель</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Логин:</label>
        <input type="text" name="username" required><br>
        <label>Пароль:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Войти</button>
        <button type="submit" onclick="window.location.href='../index.php'">Начало</button>
    </form>
</body>
</html>
