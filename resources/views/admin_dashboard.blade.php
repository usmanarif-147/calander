@extends('layouts.app')


@section('content')

    <div id="calendar">

    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            let flights = @json($flights);
            $('#calendar').fullCalendar({
                header:{
                    'left': 'prev, next, today',
                    'center': 'title',
                    'right': 'month, agendaWeek, agendaDay'
                },
                events: flights
            });
        })
    </script>

@endsection