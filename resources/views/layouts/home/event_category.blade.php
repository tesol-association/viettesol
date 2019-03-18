@extends('layouts.home.layout')
@section('title','Event category')
@section('css')

@endsection
@section('content')
<div class="section-row">
	<div class="section-title">
		@foreach($category->categoryLinks as $categoryLink)
		 @if($categoryLink->event['status'] == 'published')
		   <h2 class="title" style="margin-bottom: 50px;"><a href="{{ route('home-eventDetail',['slug'=>$categoryLink->event['slug']]) }}">{{ $categoryLink->event['title'] }}</a></h2>
		 @endif  
		@endforeach
	</div>
</div>
@endsection
@section('js')

@endsection