@extends('layouts.home.layout')
@section('title','Event')
@section('css')

@endsection
@section('content')
@foreach($events as $event)
<div class="post post-row">
	<a class="post-img" href=""><img src="{{ asset('storage/'.$event->cover) }}" alt=""></a>
	<div class="post-body">
		<div class="post-category">
			@foreach( $event->categoryLinks as $categoryLink)
			<a href="{{ route('home-event_category',['slug'=>$categoryLink->category->slug]) }}">{{ $categoryLink->category->name }}</a>
			@endforeach
		</div>
		<h3 class="post-title"><a href="{{ route('home-eventDetail',['slug'=>$event->slug]) }}">{{ $event->title }}</a></h3>
		<ul class="post-meta">
			<li>{{ $event->createdBy->user_name }}</li>
			<li>{{ \Carbon\Carbon::parse($event->created_at)->format('d/m/Y') }}</li>
		</ul>
		<p>{!! $event->short_content !!}</p>
	</div>
</div>
@endforeach
{{ $events->links() }}
@endsection
@section('js')

@endsection