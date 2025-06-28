
<?php 
session_start();
require_once('php/conexion.php');

if(!isset($_GET['matricula'])){
    echo "Matricula no proporcionada.";
    exit;
}

$matricula = $_GET['matricula'];

//Usamos consulta preparada para seguridad
$stmt = $conexion->prepare("SELECT c.*, m.nombre AS marca, s.nombre AS sede, s.direccion
                            FROM coches c
                            JOIN marcas m ON c.id_marca = m.id_marca
                            JOIN sedes s ON c.id_sede = s.id_sede
                            WHERE c.matricula = ?");
$stmt->bind_param("s", $matricula);
$stmt->execute();
$resultado = $stmt->get_result();

if($resultado-> num_rows === 0){
    echo "Coche no encontrado.";
    exit;
}

$coche = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $coche['modelo']; ?>| Renty</title>

        <!-- Tailwind (dev) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

        <!-- Flatpickr estilos -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"/>
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
        <main class="container mx-auto p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Imagen -->
                <div class="flex justify-center">
                    <img 
                    src="<?php echo $coche['imagen_url']; ?>" 
                    alt="Imagen del coche" 
                    class="rounded-lg shadow-lg max-w-full h-auto"
                    />
                </div>
                <!-- Detalles y reserva -->
                <div class="space-y-4">
                    <h1 class="text-3xl font-bold text-yellow-500">
                        <?= "{$coche['marca']} {$coche['modelo']} ({$coche['anio']})" ?>
                    </h1>
                    <p class="text-lg"><?= htmlspecialchars($coche['descripcion']) ?></p>
                    <p class="text-lg">
                        <strong>Precio/día:</strong> <?= $coche['precio_alquiler'] ?> €
                    </p>
                    <p class="text-lg"><strong>Sede:</strong> <?= htmlspecialchars($coche['sede']) ?></p>
                    <p class="text-lg">
                        <strong>Disponibilidad:</strong> 
                        <?= $coche['disponible'] ? 'Disponible' : 'No disponible' ?>
                    </p>

                    <button id="reservarBtn" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg">
                        Reservar
                    </button>

                    <div id="calendarContainer" class="hidden mt-4 space-y-2">
                        <input id="rangoFechas" placeholder="Selecciona rango de días" readonly class="w-full p-2 border rounded-lg bg-white text-black"/>
                        <button id="confirmBtn" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg">
                            Confirmar reserva
                        </button>
                    </div>
                </div>
            </div>
        </main>

        <footer class="text-center py-4">
            &copy; 2025 Renty. Todos los derechos reservados.
        </footer>

        <!-- Dependencias JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <!-- Pasa la matrícula al JS -->
        <script>
            window.COCHE_MATRICULA = '<?= $matricula ?>';
            window.USER_LOGGED    = <?= isset($_SESSION['dni']) ? 'true' : 'false' ?>;
        </script>

        <!-- Lógica de fechas y reservas -->
        <script src="js/detalle_coche.js"></script>

        <!-- jQuery + Slick (para canvas y sliders en script.js) -->
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <!-- Canvas logo + cualquier otro código -->
        <script src="js/script.js"></script>
    </body>
</html>

