@extends('layouts.conference.layout')

@section('title','News')
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
						<div class="news_image_container">
							<div class="news_image"><img src="{{ asset('conference/images/news_1.jpg') }}" alt=""></div>
							<div class="date_container">
								<a href="#">
									<span class="date_content d-flex flex-column align-items-center justify-content-center">
										<div class="date_day">15</div>
										<div class="date_month">May</div>
									</span>
								</a>	
							</div>
						</div>
						<div class="news_body">
							<div class="news_title"><a href="#">10 Tips to start your small business</a></div>
							<div class="news_info">
								<ul>
									<!-- News Author -->
									<li>
										<div class="news_author_image"><img src="images/news_author_1.jpg" alt=""></div>
										<span>by <a href="#">Michael Smith</a></span>
									</li>
									<!-- Tags -->
									<li><span>in <a href="events.html">Events</a></span></li>
									<!-- Comments -->
									<li><a href="#">3 Comments</a></li>
								</ul>
							</div>
							<div class="news_text">
								<p>Donec quis metus ac arcu luctus accumsan. Nunc in justo tincidunt, sodales nunc id, finibus nibh. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce nec ante vitae lacus aliquet vulputate. Donec scelerisque accu msan molestie. Vestibulum ante ipsum primis in faucibus orci luctus.</p>
							</div>
							<div class="button news_button"><a href="#">Read More</a></div>
						</div>
					</div>

					<!-- Pagination -->
					<div class="pagination">
						<ul>
							<li class="active"><a href="#">01.</a></li>
							<li><a href="#">02.</a></li>
							<li><a href="#">03.</a></li>
						</ul>
					</div>
				</div>

			</div>

			<!-- Sidebar -->
			<div class="col-lg-4">
				<div class="sidebar">
					<div class="tickets">
						<div class="background_image" style="background-image:url( {{ asset('conference/images/tickets.jpg') }} )"></div>
						<div class="tickets_inner text-center">
							<div class="tickets_title">Ragistration</div>
							<div class="tickets_text">{{ $conference->title }}</div>
							<div class="button tickets_button"><a href="">Regiatration</a></div>
						</div>
					</div>
					<div class="sidebar_categories">
						<div class="sidebar_categories_title">Categories</div>
						<ul class="categories_list">
							<li><a href="#">The Speakers</a></li>
							<li><a href="#">Tips & Tricks</a></li>
							<li><a href="#">Events & Lifestyle</a></li>
							<li><a href="#">Marketing</a></li>
							<li><a href="#">Uncategorized</a></li>
						</ul>
					</div>
					<div class="latest_posts">
						<div class="latest_posts_title">Latest Posts</div>
						<div class="latest_container">

							<!-- Latest -->
							<div class="latest d-flex flex-row align-items-start justify-content-start">
								<div><div class="latest_image"><img src="images/latest_1.jpg" alt=""></div></div>
								<div class="latest_content">
									<div class="latest_title"><a href="#">A big discovery in science</a></div>
									<div class="latest_date">April 02, 2017</div>
								</div>
							</div>

							<!-- Latest -->
							<div class="latest d-flex flex-row align-items-start justify-content-start">
								<div><div class="latest_image"><img src="images/latest_2.jpg" alt=""></div></div>
								<div class="latest_content">
									<div class="latest_title"><a href="#">Marketing for everybody</a></div>
									<div class="latest_date">April 02, 2017</div>
								</div>
							</div>

							<!-- Latest -->
							<div class="latest d-flex flex-row align-items-start justify-content-start">
								<div><div class="latest_image"><img src="images/latest_3.jpg" alt=""></div></div>
								<div class="latest_content">
									<div class="latest_title"><a href="#">New ways to improve ypurself</a></div>
									<div class="latest_date">April 02, 2017</div>
								</div>
							</div>

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

