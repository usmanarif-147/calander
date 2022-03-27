<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css"/>--}}
{{--    <link rel="stylesheet" href="{{asset('css/calendar.min.css')}}">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
        .custom_pointer {cursor: no-drop}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
            integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
            crossorigin="anonymous"></script>
{{--    <script src="{{asset('js/calendar.min.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

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
                <input type="date" class="form-control" id="selected_date" hidden>
                <div class="calender-content">
                    <input type="text" class="form-control" placeholder="title" id="title">
                    <h2 class="calender-title mt-1">Select Slots</h2>
                    <section class="admin-total-wrap">
                        <strong>Slot 1: </strong>
                        <span class="slots"><label>
                                <span>8:00 AM</span>
                                <input type="time" value="08:00" id="slot_one">
                            </label>
                        </span>
                        <span class="assign">
                            <select class="form-control" id="first_slot">
                                <option>Select</option>
                                <option value="available">Mark As Available</option>
                            </select>
                        </span>
                    </section>
                    <section class="admin-total-wrap">
                        <strong>Slot 2: </strong>
                        <span class="slots">
                            <label>
                                <span>9:00 AM</span>
                                <input type="time" value="09:00" id="slot_two">
                            </label>
                        </span>
                        <span class="assign">
                            <select class="form-control" id="second_slot">
                                <option>Select</option>
                                <option value="available">Mark As Available</option>
                            </select>
                        </span>
                    </section>
                    <section class="admin-total-wrap">
                        <strong>Slot 3: </strong>
                        <span class="slots">
                            <label>
                                <span>03:00 PM</span>
                                <input type="time" value="15:00" id="slot_three">
                            </label>
                        </span><span class="assign">
                            <select class="form-control" id="third_slot">
                                <option>Select</option>
                                <option value="available">Mark As Available</option>
                            </select>
                        </span>
                    </section>
                    <hr>
                </div>
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

    var calendar='';
    $(document).ready(function () {
        calendar = $('#calendar').fullCalendar({
            editable:true,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay'
            },
            events:'{{route('get-events')}}',
            eventBackgroundColor: '#FF0000',
            selectable:true,
            selectHelper: true,
            showNonCurrentDates: false,
            /**
             * change cell background color
             * */
            dayRender: function (date, cell) {
                var today = new Date().getDate();
                var checkDate = new Date(date).getDate();
                if( checkDate < today) {
                    cell.css("background-color", "lightGray");
                    cell.addClass('custom_pointer');
                } // this is for previous date

                if(checkDate >= today) {
                    cell.css("background-color", "lightBlue");
                }
            },
            /**
             * click on date count total number of events for clicked date.
             * */
            dayClick: function (date, allDay, jsEvent, view) {
                var eventsCount = 0;
                var checkEvent = date.format('YYYY-MM-DD');
                $('#calendar').fullCalendar('clientEvents', function(event) {
                    var start = moment(event.start).format("YYYY-MM-DD");
                    var end = moment(event.end).format("YYYY-MM-DD");
                    if(checkEvent === start)
                    {
                        eventsCount++;
                    }
                });
                // alert(eventsCount);
            },
            /**
             * on select date open modal pop up
             * */
            select:function(start, end, allDay)
            {
                console.log("select")
                var now = new Date(moment(start).format('MM-DD-YYYY'));
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);

                var today = now.getFullYear() + "-" + (month) + "-" + (day);

                $('#selected_date').val(today);

                $('#booking-modal').modal('show')
            },

            /**
             * only show dates of selected month
             * */
            selectAllow: function(select) {
                return moment().diff(select.start, 'days') <= 0
            },

            /**
             * event click (edit or remove or view details)
             * */
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    $.ajax({
                        url:"{{route('delete-booking')}}",
                        type:"POST",
                        data:{
                            id:id,
                            _token: '{{csrf_token()}}',
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                        }
                    })
                }
            }
        });

    });

    /**
     * save booking
     * */
    $('#save-booking').click(function () {
        let start = $('#selected_date').val();
        let slots = [];
        let first_slot = $('#first_slot').val();
        let second_slot = $('#second_slot').val();
        let third_slot = $('#third_slot').val();
        if( first_slot === "available" || second_slot === "available" || third_slot === "available"){
            let slot_one = $('#slot_one').val();
            let slot_two = $('#slot_two').val();
            let slot_three = $('#slot_three').val();

            if (first_slot === "available") {
                slots.push(`${start}T${slot_one}`)
            }
            if (second_slot === "available") {
                slots.push(`${start}T${slot_two}`)
            }
            if (third_slot === "available") {
                slots.push(`${start}T${slot_three}`)
            }

            // console.log(slots);

            $('#booking-modal').modal('hide');
            alert("data available");
            $.ajax({
                url: "{{route('store-booking')}}",
                method: 'post',
                data: {
                    _token: '{{csrf_token()}}',
                    title: $('#title').val(),
                    slots: slots,
                },
                success: function (res) {
                    calendar.fullCalendar('refetchEvents');
                    console.log(res);
                },
                error: function (res) {
                    console.log(res);
                }
            });
        }
        else{
            alert("no data");
        }
    })

</script>
</body>
</html>


{{--<script>--}}

{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        let currentDate = new Date();--}}
{{--        var events = @json($bookings);--}}
{{--        console.log(events);--}}
{{--        var calendarEl = document.getElementById('calendar');--}}
{{--        var calendar = new FullCalendar.Calendar(calendarEl, {--}}
{{--            initialView: 'dayGridMonth',--}}
{{--            initialDate: '2022-03-07',--}}
{{--            headerToolbar: {--}}
{{--                left: 'prev,next today',--}}
{{--                center: 'title',--}}
{{--                right: 'dayGridMonth,timeGridWeek,timeGridDay'--}}
{{--            },--}}
{{--            eventClick: function (info) {--}}
{{--                alert("working");--}}
{{--                // var eventObj = info.event;--}}
{{--                //--}}
{{--                // if (eventObj.url) {--}}
{{--                //     alert(--}}
{{--                //         'Clicked ' + eventObj.title + '.\n' +--}}
{{--                //         'Will open ' + eventObj.url + ' in a new tab'--}}
{{--                //     );--}}
{{--                //--}}
{{--                //     window.open(eventObj.url);--}}
{{--                //--}}
{{--                //     info.jsEvent.preventDefault(); // prevents browser from following link in current tab.--}}
{{--                // } else {--}}
{{--                //     alert('Clicked ' + eventObj.title);--}}
{{--                // }--}}
{{--            },--}}
{{--            events: events,--}}
{{--            selectable: true,--}}
{{--            dateClick: function (info) {--}}
{{--                var now = new Date(moment(info.dateStr).format('MM-DD-YYYY'));--}}

{{--                if (currentDate.getDate() > now.getDate()) {--}}
{{--                    // alert("selected date is less")--}}
{{--                }--}}
{{--                if (currentDate.getDate() <= now.getDate()) {--}}
{{--                    var day = ("0" + now.getDate()).slice(-2);--}}
{{--                    var month = ("0" + (now.getMonth() + 1)).slice(-2);--}}

{{--                    var today = now.getFullYear() + "-" + (month) + "-" + (day);--}}

{{--                    $('#selected_date').val(today);--}}

{{--                    $('#booking-modal').modal('show')--}}
{{--                }--}}
{{--            },--}}
{{--        });--}}

{{--        $('#save-booking').click(function () {--}}

{{--            let start = $('#selected_date').val();--}}

{{--            let slot_one = $('#slot_one').val();--}}
{{--            let slot_two = $('#slot_two').val();--}}
{{--            let slot_three = $('#slot_three').val();--}}

{{--            let slots = [];--}}
{{--            if ($('#first_slot').val() === "available") {--}}
{{--                slots.push(`${start}T${slot_one}`)--}}
{{--            }--}}
{{--            if ($('#second_slot').val() === "available") {--}}
{{--                slots.push(`${start}T${slot_two}`)--}}
{{--            }--}}
{{--            if ($('#third_slot').val() === "available") {--}}
{{--                slots.push(`${start}T${slot_three}`)--}}
{{--            }--}}

{{--            // console.log(slots);--}}

{{--            $('#booking-modal').modal('hide');--}}
{{--            $.ajax({--}}
{{--                url: "{{route('store-booking')}}",--}}
{{--                method: 'post',--}}
{{--                data: {--}}
{{--                    _token: '{{csrf_token()}}',--}}
{{--                    title: $('#title').val(),--}}
{{--                    // start_date: `${start}T${start_time}`,--}}
{{--                    // end_date: `${start}T${end_time}`,--}}
{{--                    slots: slots,--}}
{{--                },--}}
{{--                success: function (res) {--}}

{{--                    let bookings = res.bookings;--}}
{{--                    for (let i = 0; i < bookings.length; i++) {--}}

{{--                        // calendarEl.calendar('renderEvent', {--}}
{{--                        //     'title': bookings[i].title,--}}
{{--                        //     'start' : bookings[i].start_date--}}
{{--                        // })--}}
{{--                    }--}}
{{--                    window.location.reload()--}}
{{--                    console.log("success");--}}
{{--                },--}}
{{--                error: function (res) {--}}
{{--                    console.log(res);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        calendar.render();--}}
{{--    });--}}

{{--</script>--}}
