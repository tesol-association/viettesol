@extends('layouts.conference.layout')

@section('title','News Detail')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/news.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/news_responsive.css') }}">
@endsection
@section('banner')
<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/news.jpg') }}" data-speed="0.8"></div>
@endsection
@section('content-banner')
<div class="home_content_container">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="home_content d-flex flex-row align-items-end justify-content-start">
					<div class="current_page">News</div>
					<div class="breadcrumbs ml-auto">
						<ul>
							<li><a href="{{ route('conference_home',['conference_path'=>$conference->path]) }}">Home</a></li>
							<li>News</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="news">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">

				<div class="news_items">

					<!-- News Item -->
					<div class="news_item">
						
						<div class="news_body">
							<div class="news_title"><a href="{{ route('conference_news_detail',['id'=>$announcement->id, 'conference_path'=>$conference->path]) }}">{{ $announcement->title }}</a></div>
							<div class="news_info">
								<ul>
									<!-- News Author -->
									{{-- <li>
										<div class="news_author_image"><img src="images/news_author_1.jpg" alt=""></div>
										<span>by <a href="#">Michael Smith</a></span>
									</li> --}}
									<!-- Tags -->
									<li><span>in <a href="">Announcement</a></span></li>
									<!-- Comments -->
									{{-- <li><a href="#">3 Comments</a></li> --}}
								</ul>
							</div>
							<div class="news_text">
								<p>{!! $announcement->body !!}</p>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Sidebar -->
			<div class="col-lg-4">
				<div class="sidebar">
					<div class="tickets">
						<div class="background_image" style="background-image:url( {{ asset('conference/images/tickets.jpg') }} )"></div>
						<div class="tickets_inner text-center">
							<div class="tickets_title">Registration</div>
							<div class="tickets_text">{{ $conference->title }}</div>
							<div class="button tickets_button"><a href="{{ route('admin_registration_create',['conference_id'=>$conference->id]) }}">Registration</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="{{ asset('conference/js/news.js') }}"></script>
@endsection

