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



window.onload = function() {
    const canvas = document.getElementById("logo-canvas");
    const ctx = canvas.getContext("2d");
    const img = new Image();
    img.src = 'images/Renty.png';

    img.onload = function() {
        
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
    };
};
