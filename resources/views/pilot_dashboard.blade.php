@extends('layouts.app')


@section('content')

    <div id="calendar">

    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function () {
            $('#calendar').fullCalendar();
        })
    </script>

@endsection