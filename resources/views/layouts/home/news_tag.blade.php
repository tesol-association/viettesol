@extends('layouts.home.layout')
@section('title','News tag')
@section('css')

@endsection
@section('content')
<div class="section-row">
	<div class="section-title">
		@foreach($news as $new)
		 @if($new->status=='published')
		   <h2 class="title" style="margin-bottom: 50px;"><a href="{{ route('home-newsDetail',['slug'=>$new->slug]) }}">{{ $new->title }}</a></h2>
		 @endif  
		@endforeach
	</div>
</div>
@endsection
@section('js')

@endsection