<?php 
session_start();
require_once 'php/conexion.php';

$mensaje = '';
$errores = [];

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    if($password !== $confirmar) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE dni = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        $errores[] = "Ya existe una cuenta con ese DNI.";
    }

    if(empty($errores)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $conexion->prepare("INSERT INTO clientes (dni, nombre, apellidos, email, password, rol)
                                        VALUES (?, ?, ?, ?, ?, 'cliente')");
        $insert->bind_param("sssss", $dni, $nombre, $apellidos, $email, $hash);

        if($insert->execute()) {
            $_SESSION['dni'] = $dni;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['rol'] = 'cliente';
            header("Location: index.html");
            exit;
        } else {
            $errores[] = "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Renty</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <figure id="logo-container">
            <canvas id="logo-canvas" width="400" height="267"></canvas>
        </figure>
    </header>

    <main>
        <section style="max-width: 400px; margin: 60px auto; background-color: #222; padding: 20px; border-radius: 8px;">
            <h2 style="color: #D4AF37;">Crear cuenta</h2>

            <?php foreach ($errores as $error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endforeach; ?>

            <form method="POST">
                <label>DNI:</label><br>
                <input type="text" name="dni" required style="width: 100%;"><br><br>

                <label>Nombre:</label><br>
                <input type="text" name="nombre" required style="width: 100%;"><br><br>

                <label>Apellidos:</label><br>
                <input type="text" name="apellidos" required style="width: 100%;"><br><br>

                <label>Email:</label><br>
                <input type="email" name="email" required style="width: 100%;"><br><br>

                <label>Contraseña:</label><br>
                <input type="password" name="password" required style="width: 100%;"><br><br>

                <label>Confirmar contraseña:</label><br>
                <input type="password" name="confirmar_password" required style="width: 100%;"><br><br>

                <button type="submit" class="boton-personalizado" style="width: 100%;">Registrarse</button>
            </form>

            <p style="margin-top: 20px;">¿Ya tienes cuenta? 
                <a href="login.php" style="color: #D4AF37;">Inicia sesión</a>
            </p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>