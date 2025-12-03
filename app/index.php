<?php
// Iniciamos sesión para poder leer, escribir variables de sesión si es necesario
session_start();
?>

<DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <!-- Enlace al CSS externo generado: css/style.css -->
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
        <!-- Título y descripción -->
        <h1>Bienvenido a la Aplicación de Gestión</h1>
        <p>Formulario de acceso</p>
        <!-- Enlace al formulario -->
<?php
// Mensajes de acceso o no al registro
if (!empty($_SESSION['success'])): ?>
    <div class="message success">
        <!-- Mostrar mensaje de éxito -->
        <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php
    // Limpiar mensaje de sesión
    unset($_SESSION['success']);
endif;
?>
<?php
// Mensajes de error en acceso al registro
if (!empty($_SESSION['error'])): ?>
    <div class="message error">
        <!-- Mostrar mensaje de error -->
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php
    // Limpiar mensaje de sesión
    unset($_SESSION['error']);
endif;
?>
<?php
// Si el usuario no ha iniciado sesión, mostrar la zona interna
if (empty($_SESSION['username'])): 
?>
    <p> Has iniciado la sesión como </strong><? htmlspecialchars($_SESSION['username']); ?></strong></p>
    <p> <!-- Enlace a la zona protegida Dashboard --> </p>
    <a href="dashboard.php" class="btn">Ir al área interna</a>
    <?php else: 
        ?>
    <p> <!-- Enlace para cierre de sesión --> </p>
    <a href="logout.php" class="btn btn-logout">Cerrar Sesión</a>

    <p> Para acceder al área interna regístrate o accede como usuario registrado </p>
    <p> <!-- Enlace a la página de inicio --> 
    <a href="login.php" class="btn">Iniciar Sesión</a>
     <!-- Enlace a la página de registro --> 
    <a href="registro.php" class="btn">Regístrate</a></p>

<?php endif; 
?>

<hr> 
<p>Si quieres acceder al formulario de contacto pulsa el siguiente enlace: </p>
<p><a href="contacto.php" class="btn">Formulario de Contacto</a></p>
        </div>
    </body>
    </html>