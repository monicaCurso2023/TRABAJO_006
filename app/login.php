<?php
session_start();

// Aseguramos estructura de usuarios en sesión (demo)
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Procesar formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validación básica
    if ($username === '' || $password === '') {
        $_SESSION['error'] = 'Usuario y contraseña son obligatorios.';
        header('Location: login.php');
        exit;
    }

    // Comprobar credenciales contra la "base de datos" en sesión
    if (!isset($_SESSION['users'][$username]) || !password_verify($password, $_SESSION['users'][$username])) {
        $_SESSION['error'] = 'Credenciales inválidas.';
        header('Location: login.php');
        exit;
    }

    // Guardar usuario en sesión (logged in)
    $_SESSION['username'] = $username;
    $_SESSION['success'] = 'Has iniciado sesión correctamente.';
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="message error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="login.php" method="post" autocomplete="off">
        <label for="username">Usuario:</label>
        <input id="username" name="username" type="text" required>
        <label for="password">Contraseña:</label>
        <input id="password" name="password" type="password" required>
        <button class="btn" type="submit">Entrar</button>
    </form>

    <p><a href="index.php">Volver</a></p>
</div>
</body>
</html>