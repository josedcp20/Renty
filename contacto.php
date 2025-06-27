<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Renty - Contacto</title>
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
                    <li class="dropdown">
                        <a href="#" class="user-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="perfil.php">Ver cuenta</a></li>
                            <li><a href="logout.php">Cerrar sesión</a></li>
                            <?php if ($_SESSION['rol'] === 'admin'): ?>
                                <li><a href="admin.php">Administrar</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="login.php" class="user-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <main id="contacto" style="padding: 40px 20px">
            <h2>Quiénes somos?</h2>
            <p>Renty es una empresa dedicada al alquiler doches exclusivos y clásicos. Nuestro objetivos es brindarte una experiencia de conducción única, combinando estilo, rendimiento y confianza.</p>
            
            <h3>Contacto</h3>
            <ul>
                <li>📍 Dirección: Calle Ejemplo 123, Madrid</li>
                <li>📞 Teléfono: +34 600 123 456</li>
                <li>📧 Email: info@renty.com</li>
            </ul>

            <h3>Horario de atención</h3>
            <p>Lunes a viernes: 9:00 - 18:00 <br>Sábados: 10:00 - 14:00</p>

            <h3>Ubicación</h3>
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.427405293489!2d-3.7037906846055546!3d40.416775379365025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997aa763b9b%3A0xa43e2782f0a68a1d!2sMadrid!5e0!3m2!1ses!2ses!4v1591918677791!5m2!1ses!2ses"
            width="100%" height="400" style="border:1px solid #D4AF37; border-radius: 8px;" allowfullscreen="" loading="lazy"></iframe>
        </main>

            <footer>
            <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
        </footer>

        <script src="js/script.js"></script>
    </body>