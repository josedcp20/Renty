<?php 
    session_start();

    if(!isset($_SESSION['dni'])) {
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Mis reservas - Renty</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <figure id="logo-container">
                <canvas id="logo-canvas" width="400" height="267"></canvas>
            </figure>
        </header>
        <nav id="navbar">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="catalogo.php">Catalogo</a></li>
                <li><a href="reservas.php">Reservas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <?php if(isset($_SESSION['dni'])):?>
                    <li><a href="loguot.php" class="botono-persoanlizado">Cerrar sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <main>
            <h2 style="color: #D4AF37; text-align: center;">Área de reservas</h2>
            <p style="text-align: center;">(Aquí mostraremos el calendario y el historial más adelante)</p>
        </main>

        <footer>
            <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
        </footer>

        <script src="js/script.js"></script>
    </body>
</html>