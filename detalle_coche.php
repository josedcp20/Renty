
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
    <title><?php echo htmlspecialchars($coche['modelo']); ?>| Renty</title>
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
    <main style="padding: 40px 20px;">
        <h2><?php echo htmlspecialchars($coche['modelo']); ?>(<?php echo $coche['anio']; ?>)</h2>
        <img src="<?php echo $coche['imagen_url']; ?>" alt="Imagen del coche" style="max-width: 400px; border-radius: 8px;"><br><br>

         <ul>
            <li><strong>Marca:</strong> <?php echo htmlspecialchars($coche['marca']); ?></li>
            <li><strong>Matrícula:</strong> <?php echo $coche['matricula']; ?></li>
            <li><strong>Precio por día:</strong> <?php echo $coche['precio_alquiler']; ?>€</li>
            <li><strong>Disponibilidad:</strong> <?php echo $coche['disponible'] ? 'Sí' : 'No'; ?></li>
            <li><strong>Sede:</strong> <?php echo htmlspecialchars($coche['sede']); ?> (<?php echo htmlspecialchars($coche['direccion']); ?>)</li>
        </ul>
        <br>
    </main>

    <footer>
        <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
