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
                    <button type="submit" class="p-2 rounded bg-[#D4AF37] hover:bg-[#C5A300] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color: black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1016.65 2a7.5 7.5 0 000 14.65z" />
                        </svg>
                    </button>
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
                    <div class="max-w-sm rounded overflow-hidden shadow-lg bg-black text-white min-h-[420px] flex flex-col justify-between">
                        <div class="h-64 overflow-hidden">
                            <img class="w-full h-full object-cover" src="'.$producto['imagen_url'].'" alt="'.$producto['modelo'].'">
                        </div>
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">'. $producto['modelo'] .'('.$producto['anio'].')</div>
                            <p class="text-gray-700 text-base">
                                Alquiler_diario: '.number_format($producto['precio_alquiler'], 2). '€
                            </p>
                        </div>
                        <div class="px-6 py-4">
                            <button class="bg-ble-50 text-white py-2 px-4 rounded hover:bg-#D4AF37">
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
