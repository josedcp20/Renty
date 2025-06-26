<?php 
session_start();
require_once 'php/conexion.php';

$error = '';

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $dni = $_POST['dni'];+
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE dni = ?");
    $stmt->bind_param("s", $dni);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $usuarios = $resultado->fetch_assoc();
        if(password_verify($password, $usuarios['password'])){
            $_SESSION['dni'] = $usuarios['dni'];
            $_SESSION['nombre'] = $usuarios['nombre'];
            $_SESSION['rol'] = $usuarios['rol'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    }else{
        $error = "Usario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión - Renty</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <figure id="logo-container">
            <canvas id="logo-canvas" width="400" height="267"></canvas>
        </figure>
    </header>

    <main id="formulario">
        <section style="max-width: 400px; margin: 60px auto; background-color: #222; padding: 20px; border-radius: 8px;">
            <h2 style="color: #D4AF37; text-align: center;">Iniciar sesión</h2>

            <?php if ($error): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <form method="POST">
                <label for="dni">DNI:</label><br>
                <input type="text" name="dni" required style="width: 100%;"><br><br>

                <label for="password">Contraseña:</label><br>
                <input type="password" name="password" required style="width: 100%;"><br><br>

                <button type="submit" class="boton-personalizado" style="width: 100%;">Entrar</button>
            </form>

            <p style="text-align: center; margin-top: 20px;">
                <a href="index.php" class="boton-personalizado">Volver al inicio</a>
            </p>

            <p style="margin-top: 20px; text-align: center;">
                ¿No tienes cuenta? 
                <a href="register.php" style="color: #D4AF37;">Regístrate aquí</a>
            </p>
        </section>
    </main>


    <footer>
        <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>