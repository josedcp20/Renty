// js/detalle_coche.js
document.addEventListener("DOMContentLoaded", () => {
  const reservarBtn = document.getElementById("reservarBtn");
  const container   = document.getElementById("calendarContainer");
  const input       = document.getElementById("rangoFechas");
  const confirmBtn  = document.getElementById("confirmBtn");
  let selectedRange = [];

  function initDatePicker() {
    fetch(`php/get_reservas.php?matricula=${window.COCHE_MATRICULA}`)
      .then(res => {
        if (!res.ok) throw new Error("HTTP " + res.status);
        return res.json();
      })
      .then(reservas => {
        const disabled = reservas.map(r => ({
          from: r.start,
          to:   r.end
        }));

        flatpickr(input, {
          mode:       "range",
          // Este dateFormat es para el valor real,
          // altInput/altFormat para la vista bonita:
          dateFormat: "Y-m-d",
          altInput:   true,
          altFormat:  "d-m-Y",
          disable:    disabled,
          minDate:    "today",
          onClose:    (dates, dateStr) => {
            // dateStr = "01-07-2025 to 05-07-2025"
            selectedRange = dates;
            // ¡Aseguramos que el campo muestre algo!
            input.value = dateStr;
          }
        });
      })
      .catch(err => {
        console.error("Error cargando reservas:", err);
        alert("No se pudieron cargar las fechas ocupadas.");
      });
  }

  reservarBtn.addEventListener("click", () => {
    if (!window.USER_LOGGED) {
    window.location.href = 'login.php';
    return;
  }
    container.classList.toggle("hidden");
    if (!input._flatpickr) initDatePicker();
  });

  confirmBtn.addEventListener("click", () => {
    if (selectedRange.length < 2) {
      return alert("Selecciona primero un rango de fechas completo.");
    }
    const payload = {
      matricula: window.COCHE_MATRICULA,
      start:     selectedRange[0].toISOString().slice(0,10),
      end:       selectedRange[1].toISOString().slice(0,10)
    };

    fetch("php/crear_reserva.php", {
      method:  "POST",
      headers: { "Content-Type": "application/json" },
      body:    JSON.stringify(payload)
    })
    .then(res => {
      if (!res.ok) throw new Error("HTTP " + res.status);
      return res.json();
    })
    .then(json => {
      // Debe venir algo como { success: true, mensaje: "..." }
      alert(json.mensaje);
      if (json.success) location.reload();
    })
    .catch(err => {
      console.error("Error al procesar la reserva:", err);
      alert("Se produjo un error al comunicarse con el servidor.");
    });
  });
});
