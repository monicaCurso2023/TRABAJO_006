<?php
session_start();

// "Base de datos" de usuarios en sesión (demo)
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

$errors = [];

// Procesamos registro cuando el método es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    // Validaciones básicas
    if (strlen($username) < 3) {
        $errors[] = 'El nombre de usuario debe tener al menos 3 caracteres.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if ($password !== $password2) {
        $errors[] = 'Las contraseñas no coinciden.';
    }
    if (isset($_SESSION['users'][$username])) {
        $errors[] = 'El nombre de usuario ya existe.';
    }

    if (!$errors) {
        // Guardamos usuario con contraseña hasheada (solo demo)
        $_SESSION['users'][$username] = password_hash($password, PASSWORD_DEFAULT);
        $_SESSION['success'] = 'Registro correcto. Ya puedes iniciar sesión.';
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = implode(' ', $errors);
        header('Location: registro.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Registro</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="message error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="registro.php" method="post" autocomplete="off">
        <label for="username">Usuario:</label>
        <input id="username" name="username" type="text" required>
        <label for="password">Contraseña:</label>
        <input id="password" name="password" type="password" required>
        <label for="password2">Repetir contraseña:</label>
        <input id="password2" name="password2" type="password" required>
        <button class="btn" type="submit">Registrar</button>
    </form>

    <p><a href="index.php">Volver</a></p>
</div>
</body>
</html>