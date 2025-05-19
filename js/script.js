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

$(document).ready(function(){
  $('.carousel').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    fade: true,
    arrows: false,
    dots: true,
    infinite: true,
    speed: 1000,
    pauseOnHover: false
  });
});

fetch("http://localhost/Renty/php/listar_coches.php")
  .then(res => res.json())
  .then(data => {
    console.log("Coches:", data);
    // Aquí puedes mostrar los coches en tarjetas, tablas, etc.
  })
  .catch(error => console.error("Error:", error));
