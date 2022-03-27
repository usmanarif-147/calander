<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>--}}
    <link rel="stylesheet" href="{{asset('css/calendar.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
            integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
            crossorigin="anonymous"></script>
    <script src="{{asset('js/calendar.min.js')}}"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>--}}

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
        $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            // events: [
            //     {
            //         title: 'event1',
            //         start: '2022-03-21 11:30:00',
            //         end: '2022-03-21',
            //     },
            //     {
            //         title: 'event2',
            //         start: '2022-03-22',
            //         end: '2022-03-22',
            //     },
            //     {
            //         title: 'event3',
            //         start: '2022-03-23 10:30:00',
            //         end: '2022-03-23 12:30:00',
            //         // allDay : false // will make the time show
            //     }
            // ],

            // events: [
            //     {
            //         title: "All Day Event",
            //         start: "2022-03-01"
            //     }, {
            //         title: "Long Event",
            //         start: "2022-03-07",
            //         end: "2022-03-10"
            //     }, {
            //         id: 999,
            //         title: "Repeating Event",
            //         start: "2022-03-09T16:00:00"
            //     }, {
            //         id: 999,
            //         title: "Repeating Event",
            //         start: "2022-03-16T16:00:00"
            //     }, {
            //         title: "Meeting",
            //         start: "2022-03-12T10:30:00",
            //         end: "2022-03-12T12:30:00"
            //     }, {
            //         title: "Lunch",
            //         start: "2022-03-12T12:00:00"
            //     }, {
            //         title: "Birthday Party",
            //         start: "2022-03-13T07:00:00"
            //     }, {
            //         title: "Click for Google",
            //         url: "http://google.com/",
            //         start: "2022-03-28"
            //     }
            // ],
            // events: events,
            selectable: true,
            selectHelper: true,
            select: function (start, end, allDay) {

                $('#booking-modal').modal('show');
                $('#save-booking').click(function () {
                    $('#booking-modal').modal('hide');
                    $.ajax({
                        url: "{{route('store-booking')}}",
                        method: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                            title: $('#title').val(),
                            start_time: $('#start-time').val(),
                            end_time: $('#end-time').val(),
                        },
                        success: function (res) {
                            console.log(res);
                        },
                        error: function (res) {
                            console.log(res);
                        }
                    });

                })
            }
        })
    })

</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: '2022-03-07',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: [
                {
                    title: 'All Day Event',
                    start: '2022-03-01'
                },
                {
                    title: 'Long Event',
                    start: '2022-03-07',
                    end: '2022-03-10'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2022-03-09T16:00:00'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2022-03-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2022-03-11',
                    end: '2022-03-13'
                },
                {
                    title: 'Meeting',
                    start: '2022-03-12T10:30:00',
                    end: '2022-03-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2022-03-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2022-03-12T14:30:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2022-03-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2022-03-28'
                }
            ]
        });

        $('#btn-add-event').click(function () {
            var newEvents = [
                {
                    title: 'All Day Event 2',
                    start: '2020-02-02',
                },
                {
                    title: 'All Day Event 3',
                    start: '2020-02-03',
                }
            ];

            calendar.addEventSource(newEvents);

        });

        calendar.render();
    });

</script>
</body>
</html>
