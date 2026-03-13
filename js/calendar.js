// js/calendar.js - Calendário usando FullCalendar

function initCalendar(reservas) {
    const calendarEl = document.getElementById('calendar');

    // Transformar reservas em eventos
    const events = reservas.map(reserva => ({
        title: `${reserva.sala_nome} - ${reserva.usuario_nome}`,
        start: reserva.data_inicio,
        end: reserva.data_fim,
        color: '#4CAF50' // Verde para reservas aprovadas
    }));

    // Inicializar FullCalendar
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: events,
        eventClick: function(info) {
            alert('Reserva: ' + info.event.title);
        },
        height: 'auto'
    });

    calendar.render();
}