@extends('layouts.home.layout')
@section('title','Event tag')
@section('css')

@endsection
@section('content')
<div class="section-row">
	<div class="section-title">
		@foreach($events as $event)
		@if($event->status=='published')
		<h2 class="title" style="margin-bottom: 50px;"><a href="{{ route('home-eventDetail',['slug'=>$event->slug]) }}">{{ $event->title }}</a></h2>
		@endif  
		@endforeach
	</div>
</div>
@endsection
@section('js')

@endsection