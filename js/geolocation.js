document.getElementById('get-location').addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude; 

            document.getElementById('location-result').textContent = `Tu ubicación es: Latitud: ${lat}, Longitud: ${lon}`;
        }, function(error) {
            document.getElementById('location-result').textContent = 'No se pudo obtener tu ubicación.';
        });
    } else {
        document.getElementById('location-result').textContent = 'Tu navegador no soporta la Geolocation API.';
    }
});

document.getElementById('reservar-btn').addEventListener('click', function() {
    window.location.href = 'catalogo.php';
});