<!DOCTYPE html lang="es">
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Renty-Catálogo</title>
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    </head>
    <body>
        <header>
            <figure id="logo-container">
                <canvas id="logo-canvas" width="400" height="267"></canvas>
            </figure>
        </header>
        <nav id="navbar">
          <ul>
              <li><a href="index.html">Inicio</a></li>
              <li><a href="catalogo.html">Catálogo</a></li>
              <li><a href="#reservas">Reservas</a></li>
              <li><a href="#contacto">Contacto</a></li>
              <li class="search">
                <form action="#search-results" method="get">
                    <input type="text" id="search" name="query" placeholder="Buscar...">
                    <button type="submit">🔍</button>
                </form>
            </ul>
        </nav>

        <div class="container mx-auto p-4 mt-8">
            <h1 class="text-3xl font-bold mb-6">Catálogo de Coches Disponibles</h1>

            <?php
            include('php/conexion.php');
            $sql = "SELECT * FROM coches";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0){
                echo '<div class = "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">';
                while($producto = $resultado->fetch_assoc()){
                    echo '
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="'.$producto['imagen_url'].'" alt="'.$producto['modelo'].'">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">'. $producto['modelo'] .'('.$producto['anio'].')</div>
                            <p class="text-gray-700 text-base">
                                Alquiler_diario: '.number_format($producto['precio_alquiler'], 2). '€
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <button class="bg-ble-50 text-white py-2 px-4 rounded hover:bg-blue-700">
                                Ver detalles
                            </button>
                        </div>
                    </div>';
                }
                echo '</div>';
            }else{
                echo "No hay coches disponibles en este momento.";
            }

            $conexion->close();
            ?>
        </div>
        
        

        <footer>
            <p>&copy; 2025 Renty. Todos los derechos reservados.</p>
        </footer>

        <script src="js/script.js"></script>
    </body>
</html>
