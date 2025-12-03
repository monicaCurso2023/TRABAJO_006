<?php
// Iniciamos la sesión para poder mostrar mensajes y datos del usuario
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido a la Aplicación de Gestión</h1>
        <p>Formulario de acceso</p>

        <!-- Mensajes guardados en sesión: success / error -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="message success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="message error"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Comprobamos si el usuario está autenticado -->
        <?php if (!empty($_SESSION['username'])): ?>
            <!-- Usuario autenticado: mostrar dashboard y logout -->
            <p>Has iniciado sesión como <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
            <p>
                <a href="dashboard.php" class="btn">Ir al área interna</a>
                <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>
            </p>
        <?php else: ?>
            <!-- Usuario no autenticado: mostrar login/registro -->
            <p>Para acceder al área interna regístrate o accede como usuario registrado</p>
            <p>
                <a href="login.php" class="btn">Iniciar Sesión</a>
                <a href="registro.php" class="btn">Regístrate</a>
            </p>
        <?php endif; ?>

        <hr>
        <p>Si quieres acceder al formulario de contacto pulsa el siguiente enlace:</p>
        <p><a href="contacto.php" class="btn">Formulario de Contacto</a></p>
    </div>
</body>
</html>