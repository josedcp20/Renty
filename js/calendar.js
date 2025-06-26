document.addEventListener('DOMContentLoaded', function(){

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.calendar(calendarEl, {
        plugins: ['dayGrid', 'interaction'],
        defaultView: 'dayGridMonth',
        events: function(info, successCallback, failureCallback){
            fetch('get_reservas.php')
                .then(response => response.json())
                .then(data =>{
                    successCallback(data);
                })
                .catch(error =>{
                    console.log(error);
                    failureCallback(error);
                });
        },
        dateClick: function(info){
            alert('Fecha clickeada: '+ info.dateStr);
        }
    });

    calendar.render();
});