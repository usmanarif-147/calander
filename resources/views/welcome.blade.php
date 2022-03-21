<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
            integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<!-- Modal -->
<div class="modal fade" id="booking-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="title" class="form-control" placeholder="Title">
                <input type="time" id="start-time" class="form-control mt-3" placeholder="Start">
                <input type="time" id="end-time" class="form-control mt-3" placeholder="End">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save-booking">Save Booking</button>
            </div>
        </div>
    </div>
</div>

<body class="antialiased">
<div class="container">
    <div id="calendar" class="m-5"></div>
</div>



<script>
    $(document).ready(function () {
        let events = @json($events);
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: events,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDays) {
                $('#booking-modal').modal('show')
                $('#save-booking').on('click', function () {
                    console.log("title: " + $('#title').val());
                    console.log("start time: " + $('#start-time').val());
                    console.log("end time: " + $('#end-time').val());
                    let start_booking = new Date()
                    console.log(moment(start).format('YYYY-MM-DD') + ' '+ moment($('#start-time').val()).format('HH:mm'))
                })



            }
        })
    })
</script>
</body>
</html>
