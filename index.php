<?php session_start(); ?>
<!DOCTYPE html lang="es">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Renty</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
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

        <main>
            <section id="home">
                <article class="carousel">
                    <figure><img src="images/m1.png" alt="BMW M1 e26"></figure>
                    <figure><img src="images/300sl.jpg" alt="Mercedes 300SL gullwings"></figure>
                    <figure><img src="images/911.jpg" alt="Porsche 911"></figure>
                </article>

                <article id="bienvenida">
                    <h2>Bienvenido a Renty</h2>
                    <p>Alquila coches exclusivos con nosotros. ¡Haz tu reserva ahora!</p>
                    <button id="reservar-btn" class="boton-personalizado">Reservar ahora</button>
                </article>
                
                <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-4 mb-12" id="noticias">
                    <article>
                        <h2 class="text-2xl font-extrabold text-gray-900">NOTICIAS</h2>
                        <section class="mt-6 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-x-6 gap-y-8">
                            <article class="relative w-full h-64 bg-cover bg-center group rounded-lg overflow-hidden shadow-lg hover:shadow-2xl  transition duration-300 ease-in-out"
                            style="background-image: url('images/yaris.webp');">
                                <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:opacity-75 transition duration-300 ease-in-out"></div>
                                <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex justify-center items-center">
                                    <h3 class="text-center">
                                        <a class="text-white text-2xl font-bold text-center" href="https://www.caranddriver.com/es/coches/novedades/a64454861/toyota-gr-yaris-2025/"
                                            target="_blank" >
                                            <span class="absolute inset-0"></span>
                                            Toyota actualiza el GR Yaris 2025
                                        </a>
                                    </h3>
                                </div>
                            </article>
                            <article class="relative w-full h-64 bg-cover bg-center group rounded-lg overflow-hidden shadow-lg hover:shadow-2xl  transition duration-300 ease-in-out"
                                style="background-image: url('images/indianapolis.webp');">
                                <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:opacity-75 transition duration-300 ease-in-out"></div>
                                <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex justify-center items-center">
                                    <h3 class="text-center">
                                        <a class="text-white text-2xl font-bold text-center" href="https://www.20minutos.es/deportes/noticia/5715533/0/500-millas-indianapolis-2025-directo-parrilla-resultado-ultima-hora-alex-palou-indycar/"
                                            target="_blank">
                                            <span class="absolute inset-0"></span>
                                            Alex Palou gana las 500 millas de Indianápolis
                                        </a>
                                    </h3>
                                </div>
                            </article>
                            <article class="relative w-full h-64 bg-cover bg-center group rounded-lg overflow-hidden shadow-lg hover:shadow-2xl  transition duration-300 ease-in-out"
                                style="background-image: url('images/r35.webp');">
                                <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:opacity-75 transition duration-300 ease-in-out"></div>
                                <div class="relative w-full h-full px-4 sm:px-6 lg:px-4 flex justify-center items-center">
                                    <h3 class="text-center">
                                        <a class="text-white text-2xl font-bold text-center" href="https://www.caranddriver.com/es/coches/novedades/a64565959/nissan-gt-r-r36-hibrido/"
                                            target="_blank">
                                            <span class="absolute inset-0"></span>
                                            GT-R R36: Híbrido en desarrollo
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        </section>
                    </article>
                </section>
            
                
                <article id="location">
                    <h3>Encuentra tu sede más cercana</h3>
                    <button id="get-location" class="boton-personalizado">Encontrar sede más cercana</button> <br>
                    <p id="location-result">⭢⭢Tu ubicación se mostrará aquí⭠⭠</p>
                </article>

                <article id="calendar">
                    <h3>Calenadrio de disponibilidad de coches</h3>
                    <iframe src="https://calendar.google.com/calendar/embed?src=c_6dc68a3342ce401ed204163461507e6384dfac1d9ccd5de4486cd193cea948cb%40group.calendar.google.com&ctz=Europe%2FMadrid"
                        id="googleCalendar"
                        frameborder="0"
                        scrolling="no">
                    </iframe>
                </article>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
        </footer>
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Slick Carousel -->
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!--Noticias-->
        <script src="https://unpkg.com/tw-elements/dist/js/index.min.js"></script>

        <!--Geolocalizacion-->
        <script src="js/geolocation.js"></script>

        <!--Llamada archivo .js-->
        <script src="js/script.js"></script>
    </body>
</html>