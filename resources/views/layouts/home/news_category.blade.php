@extends('layouts.home.layout')
@section('title','News category')
@section('css')

@endsection
@section('content')
<div class="section-row">
	<div class="section-title">
		@foreach($category->categoryLink as $categoryLink)
		 @if($categoryLink->new['status'] == 'published')
		   <h2 class="title" style="margin-bottom: 50px;"><a href="{{ route('home-newsDetail',['slug'=>$categoryLink->new['slug']]) }}">{{ $categoryLink->new['title'] }}</a></h2>
		 @endif  
		@endforeach
	</div>
</div>
@endsection
@section('js')

@endsection