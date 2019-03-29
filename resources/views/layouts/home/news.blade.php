@extends('layouts.home.layout')
@section('title','News')
@section('css')

@endsection
@section('content')
    @foreach($news as $new)
     @if($new->status == 'published')
		<div class="col-md-12" style="margin-bottom: 50px">
			<div class="section-title">
				<h2 class="title"><a href="{{ route('home-newsDetail',['slug'=> $new->slug]) }}">{{ $new->title }}</a></h2>
			</div>	
			<div class="post-body">
				<ul class="post-meta">
					<li>{{ $new->createdBy->user_name }}</li>
					<li>{{ \Carbon\Carbon::parse($new->created_at)->format('d/m/Y') }}</li>
					@foreach($new->categoryLinks as $categoryLink)
					   <li><a href="{{ route('home-news_category',['slug'=>$categoryLink->category->slug]) }}">{{ $categoryLink->category->name }}</a></li>
					@endforeach
				</ul>
				<br>
				{!! $new->short_content !!}
			</div>
		</div>
	 @endif	
	@endforeach
	{{ $news->links() }}
@endsection
@section('js')

@endsection