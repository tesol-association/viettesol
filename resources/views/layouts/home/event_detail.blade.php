@extends('layouts.home.layout')
@section('title','Event Detail')
@section('css')

@endsection
@section('content')

<!-- post content -->
<div class="section-row">
	<h3>{{ $eventDetail->title }}</h3>
	<div class="post-body">
		<ul class="post-meta">
			<li>{{ $eventDetail->createdBy->user_name }}</li>
			<li>{{ \Carbon\Carbon::parse($eventDetail->created_at)->format('d/m/Y') }}</li>
			@foreach($eventDetail->categoryLinks as $categoryLink)
			<li><a href="{{ route('home-event_category',['slug'=>$categoryLink->category->slug]) }}">{{ $categoryLink->category->name }}</a></li>
			@endforeach
		</ul>
		<br>
		{!! $eventDetail->body !!}
		<br>
		<strong><a href="{{ route('create-form',['id'=>$eventDetail->id]) }}">Registration</a></strong>
	</div>
</div>
<!-- /post content -->

@if(!empty($tags))
<div class="section-row">
	<div class="post-tags">
		<ul>
			<li>TAGS:</li>
			@foreach($tags as $tag)
			<li><a href="{{ route('home-event_tag',['tag'=>$tag]) }}">{{ $tag }}</a></li>
			@endforeach  
		</ul>
	</div>
</div>
@endif



@endsection
@section('js')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c364861377e05c8"></script>
@endsection