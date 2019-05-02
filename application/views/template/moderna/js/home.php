<script src="<?php echo base_url('assets/plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/moment/locale/id.js'); ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var mykey = 'AIzaSyCTJRXfOLm2EjYTnJaRKAyx2nDp-MJxfGc';
        var calendarid = 'bantulkab.go.id_onj228sckri9k46lgl514h8ias@group.calendar.google.com';
        var timeMin = '2018-03-20T07:28:41.776Z';
        // var timeMin = moment().toISOString();
        var timeMax = moment().add(7, 'd').toISOString();

        $.ajax({
            type: 'GET',
            url: 'https://pajakda.bantulkab.go.id/api/v1/layanan/jadwalmobil',
            dataType: 'json',
            success: function (response) {
                if (response.items.length > 0) {
                    $.each(response.items, function (index, val) {
                        /* iterate through array or object */
                        console.log(val);
                        addEvent(val);
                    });
                } else {
                    var htmlEvent = '<li class="event clearfix">';
                    htmlEvent += '<time class="event-datetime">';
                    htmlEvent += '<div class="day">&nbsp;</div>';
                    htmlEvent += '<div class="month">&nbsp; </div>';
                    htmlEvent += '<div class="time">&nbsp; </div>';
                    htmlEvent += '</time>';
                    htmlEvent += '<div class="info">';
                    htmlEvent += '<div class="event-summary">Tidak ada Jadwal</div>';
                    htmlEvent += '<div class="event-description">Tidak ada jadwal layanan</div>';
                    htmlEvent += '</li>';
                    $('#list-event').append(htmlEvent);
                }
            },
            error: function (response) {
                alert(response)
                //tell that an error has occurred
            }
        });

        console.log(moment('2018-03-20T07:28:41.776Z').format('LL'));
    });

    function addEvent(event) {
        let htmlEvent = '<li class="event clearfix">';
        //Summary Event
        // Waktu Pelaksanaan
        let day = moment(event.start.dateTime).format('D');
        let month = moment(event.start.dateTime).format('MMM');
        let timeStart = moment(event.start.dateTime).format('HH:mm');
        let timeEnd = moment(event.end.dateTime).format('HH:mm');

        htmlEvent += '<time class="event-datetime">';
        htmlEvent += '<div class="day">' + day + '</div>';
        htmlEvent += '<div class="month">' + month + '</div>';
        htmlEvent += '<div class="time">' + timeStart + ' - ' + timeEnd + '</div>';
        htmlEvent += '</time>';
        htmlEvent += '<div class="info">';
        htmlEvent += '<div class="event-summary">' + event.summary + '</div>';
        htmlEvent += '<div class="event-description">' + event.description + '</div>';
        htmlEvent += '</div>';
        htmlEvent += '</li>';

        $('#list-event').append(htmlEvent);

    }
</script>
