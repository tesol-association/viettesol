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

.popper,
.tooltip {
	position: absolute;
	z-index: 9999;
	background: #FFC107;
	color: black;
	width: 150px;
	border-radius: 3px;
	box-shadow: 0 0 2px rgba(0,0,0,0.5);
	padding: 10px;
	text-align: center;
}
.style5 .tooltip {
	background: #1E252B;
	color: #FFFFFF;
	max-width: 200px;
	width: auto;
	font-size: .8rem;
	padding: .5em 1em;
}
.popper .popper__arrow,
.tooltip .tooltip-arrow {
	width: 0;
	height: 0;
	border-style: solid;
	position: absolute;
	margin: 5px;
}

.tooltip .tooltip-arrow,
.popper .popper__arrow {
	border-color: #FFC107;
}
.style5 .tooltip .tooltip-arrow {
	border-color: #1E252B;
}
.popper[x-placement^="top"],
.tooltip[x-placement^="top"] {
	margin-bottom: 5px;
}
.popper[x-placement^="top"] .popper__arrow,
.tooltip[x-placement^="top"] .tooltip-arrow {
	border-width: 5px 5px 0 5px;
	border-left-color: transparent;
	border-right-color: transparent;
	border-bottom-color: transparent;
	bottom: -5px;
	left: calc(50% - 5px);
	margin-top: 0;
	margin-bottom: 0;
}
.popper[x-placement^="bottom"],
.tooltip[x-placement^="bottom"] {
	margin-top: 5px;
}
.tooltip[x-placement^="bottom"] .tooltip-arrow,
.popper[x-placement^="bottom"] .popper__arrow {
	border-width: 0 5px 5px 5px;
	border-left-color: transparent;
	border-right-color: transparent;
	border-top-color: transparent;
	top: -5px;
	left: calc(50% - 5px);
	margin-top: 0;
	margin-bottom: 0;
}
.tooltip[x-placement^="right"],
.popper[x-placement^="right"] {
	margin-left: 5px;
}
.popper[x-placement^="right"] .popper__arrow,
.tooltip[x-placement^="right"] .tooltip-arrow {
	border-width: 5px 5px 5px 0;
	border-left-color: transparent;
	border-top-color: transparent;
	border-bottom-color: transparent;
	left: -5px;
	top: calc(50% - 5px);
	margin-left: 0;
	margin-right: 0;
}
.popper[x-placement^="left"],
.tooltip[x-placement^="left"] {
	margin-right: 5px;
}
.popper[x-placement^="left"] .popper__arrow,
.tooltip[x-placement^="left"] .tooltip-arrow {
	border-width: 5px 0 5px 5px;
	border-top-color: transparent;
	border-right-color: transparent;
	border-bottom-color: transparent;
	right: -5px;
	top: calc(50% - 5px);
	margin-left: 0;
	margin-right: 0;
}

</style>
@endsection
@section('content')

<div id='calendar'"></div>

@endsection
@section('js')
<script src='{{ asset('js/lib/calendar/moment.min.js') }}'></script>
<script src='{{ asset('js/lib/calendar/fullcalendar.min.js') }}'></script>
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src='https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js'></script>
<script src="{{ asset('js/admin/calendar/calendarConference.js') }}"></script>
@endsection