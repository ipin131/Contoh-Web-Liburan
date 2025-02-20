var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

$(function() {
    // Jika ada event dari variabel scheds, tambahkan ke dalam events
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k];
            events.push({
                id: row.id,
                title: row.title,
                start: row.start_datetime,
                end: row.end_datetime
            });
        });
    }

    // Inisialisasi Kalender
    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,list',
        },
        selectable: true,
        themeSystem: 'bootstrap',
        events: events,
        editable: true,

        // Event Klik pada Tanggal Kosong atau Berisi
        dateClick: function(info) {
            var dateClicked = info.dateStr; // Ambil tanggal yang diklik
            $('#date-title').text("Tanggal: " + dateClicked); // Set tanggal di modal
            $('#date-modal').modal('show'); // Tampilkan modal
        }
    });

    calendar.render();
});

// Fungsi untuk tombol aturan cuti
function togglePopup() {
    alert("Aturan cuti belum diatur. Silakan tambahkan aturan!");
}

// Fungsi untuk tombol ajukan cuti
function toggleThepopup() {
    alert("Fitur ajukan cuti masih dalam pengembangan.");
}