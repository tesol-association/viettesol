@extends('layouts.admin.conference_layout')
@section('title','Calendar Management')
@section('css')
<link href='{{ asset('css/calendar/fullcalendar.min.css') }}' rel='stylesheet' />
<style>

#calendar {
	max-width: 950px;
	margin: 50px auto;
	border: 1px solid lightgray;
}

</style>
@endsection
@section('content')

<div id='calendar'"></div>
@endsection
@section('js')
<script src='{{ asset('js/lib/calendar/moment.min.js') }}'></script>
<script src='{{ asset('js/lib/calendar/fullcalendar.min.js') }}'></script>
<script src="{{ asset('js/admin/calendar/calendarConference.js') }}"></script>
@endsection