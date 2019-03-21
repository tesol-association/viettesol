@extends('layouts.admin.conference_layout')
@section('title','Calendar Management')
@section('css')
<link href='{{ asset('css/calendar/fullcalendar.min.css') }}' rel='stylesheet' />
<link href='{{ asset('css/calendar/fullcalendar.print.min.css') }}' rel='stylesheet' media='print' />
<link href='{{ asset('css/calendar/scheduler.min.css') }}' rel='stylesheet' />
<style>

body {
	margin: 0;
	padding: 0;
	font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
	font-size: 14px;
	background-color: black;
}

#calendar {
	max-width: 900px;
	margin: 50px auto;
	border: 1px solid lightgray;
}

</style>
@endsection
@section('content')
<button class="btn btn-info" onclick="getCalendarPaper()">Calendar for paper</button>
<button class="btn btn-success">Calendar conference</button>

<div id='calendar' style="visibility: hidden;"></div>
@endsection
@section('js')
<script src='{{ asset('js/lib/calendar/moment.min.js') }}'></script>
<script src='{{ asset('js/lib/calendar/fullcalendar.min.js') }}'></script>
<script src='{{ asset('js/lib/calendar/scheduler.min.js') }}'></script>
<script src="{{ asset('js/admin/calendar/calendar.js') }}"></script>
@endsection