<!DOCTYPE html>
<html lang="en">
<head>
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/bootstrap4/bootstrap.min.css') }}">
<link href="{{ asset('conference/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/plugins/OwlCarousel2-2.2.1/animate.css') }}">
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/responsive.css') }}"> --}}
@yield('css')
</head>
<body>

<div class="super_container">

	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="{{ asset('conference/images/logo.png') }}" alt=""></div></div>
						<div class="logo_content">
							<div class="logo_text logo_text_not_ie">{{ $conference->title }}</div>
							<div class="logo_sub">{{ \Carbon\Carbon::parse($conference->start_time)->format('d/m/Y') }}-{{ \Carbon\Carbon::parse($conference->end_time)->format('d/m/Y') }} - {{ $conference->venue }}</div>
						</div>
					</div>
				</a>
			</div>
			<ul>

				<li class="menu_item"><a href="{{ route('conference_home', $conference->path) }}">Home</a></li>
				<li class="menu_item"><a href="{{ route('conference_speakers', $conference->path) }}">Speakers</a></li>
				<li class="menu_item"><a href="">Tickets</a></li>
				<li class="menu_item"><a href="{{ route('conference_news', $conference->path) }}">News</a></li>
				<li class="menu_item"><a href="{{ route('conference_contact', $conference->path) }}">Contact</a></li>

			</ul>
		</div>
		<div class="menu_social">
			<div class="menu_social_title">Follow uf on Social Media</div>
			<ul>
				<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
			</ul>
		</div>
	</div>

	<!-- Home -->

	<div class="home">
		<!-- <div class="home_background" style="background-image: url(images/index.jpg)"></div> -->
		@yield('banner')

		<!-- Header -->

		<header class="header" id="header">
			<div>
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="header_top_content d-flex flex-row align-items-center justify-content-start">
									<div>
										<a href="#">
											<div class="logo_container d-flex flex-row align-items-start justify-content-start">
												<div class="logo_image"><div><img src="{{ asset('conference/images/logo.png') }}" alt=""></div></div>
												<div class="logo_content">
													<div id="logo_text" class="logo_text logo_text_not_ie">{{ $conference->title }}</div>
													<div class="logo_sub">{{ \Carbon\Carbon::parse($conference->start_time)->format('d/m/Y') }}-{{ \Carbon\Carbon::parse($conference->end_time)->format('d/m/Y') }} - {{ $conference->venue }}</div>
												</div>
											</div>
										</a>
									</div>
									<div class="header_social ml-auto">
										<ul>
											<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
										</ul>
									</div>
									<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header_nav" id="header_nav_pin">
					<div class="header_nav_inner">
						<div class="header_nav_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
											<nav class="main_nav">
												<ul>
													<li><a href="{{ route('conference_home',['conference_path'=>$conference->path]) }}">Home</a></li>
													<li><a href="{{ route('conference_speakers',['conference_path'=>$conference->path]) }}">Speakers</a></li>
													<li><a href="{{ route('conference_news',['conference_path'=>$conference->path]) }}">News</a></li>
													<li><a href="{{ route('conference_contact',[$conference->path]) }}">Contact</a></li>
												</ul>
											</nav>
											<div class="header_extra ml-auto">
												<div class="header_search"><i class="fa fa-search" aria-hidden="true"></i></div>
												<div class="button header_button"><a href="{{ route('admin_conference_view',['conference_id'=>$conference->id]) }}">Dashboard</a></div>
												<div class="button header_button"><a href="{{ route('admin_registration_create',['conference_id'=>$conference->id]) }}">Registration</a></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="search_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="search_content d-flex flex-row align-items-center justify-content-end">
											<form action="#" id="search_container_form" class="search_container_form">
												<input type="text" class="search_container_input" placeholder="Search" required="required">
												<button class="search_container_button"><i class="fa fa-search" aria-hidden="true"></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

	@yield('content-banner')
	</div>

	@yield('content')

	<!-- Call to action -->

	<div class="cta">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/cta_1.jpg') }}" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="cta_content text-center">
						<div class="cta_title">Get your tickets now!</div>
						<div class="button cta_button"><a href="{{ route('admin_registration_create',['conference_id'=>$conference->id]) }}">Regiatration</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
		<div class="footer_content">
			<div class="container">
				<div class="row">

					<!-- Footer Column -->
					<div class="col-lg-4 footer_col">
						<div class="footer_about">
							<div>
								<a href="#">
									<div class="logo_container d-flex flex-row align-items-start justify-content-start">
										<div class="logo_image"><div><img src="{{ asset('conference/images/logo.png') }}" alt=""></div></div>
										<div class="logo_content">
											<div id="logo_text" class="logo_text logo_text_not_ie">{{ $conference->title }}</div>
											<div class="logo_sub">{{ \Carbon\Carbon::parse($conference->start_time)->format('d/m/Y') }}-{{ \Carbon\Carbon::parse($conference->end_time)->format('d/m/Y') }} - {{ $conference->venue }}</div>
										</div>
									</div>
								</a>
							</div>
							<div class="footer_about_text">
								<p>{{ $conference->slogan }}</p>
							</div>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-lg-3 footer_col">
						<div class="footer_links">
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Speakers</a></li>
								<li><a href="#">Event Dates</a></li>
								<li><a href="#">Information</a></li>
								<li><a href="#">Calendar</a></li>
							</ul>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-lg-3 footer_col">
						<div class="footer_links">
							<ul>
								<li><a href="#">Logistics</a></li>
								<li><a href="#">Our Partners</a></li>
								<li><a href="#">Testimonials</a></li>
								<li><a href="#">Price Plans</a></li>
								<li><a href="#">News</a></li>
								<li><a href="{{ route('conference_contact', $conference->path) }}">Contact</a></li>
							</ul>
						</div>
					</div>

					<!-- Footer Column -->
					<div class="col-lg-2 footer_col">
						<div class="footer_links">
							<ul>
								<li><a href="#">About Us</a></li>
								<li><a href="#">Services</a></li>
								<li><a href="#">Speakers</a></li>
								<li><a href="#">Event Dates</a></li>
								<li><a href="#">Information</a></li>
								<li><a href="#">Calendar</a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="footer_extra">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_extra_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="footer_social">
								<div class="footer_social_title">Follow us on Social Media</div>
								<ul class="footer_social_list">
									<li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
								</ul>
							</div>
							<div class="footer_extra_right ml-lg-auto text-lg-right">
								<div class="footer_extra_links">
									<ul>
										<li><a href="{{route('conference_contact', $conference->path)}}">Contact us</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
								<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | VietTESOL Association</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>

</div>

<script src="{{ asset('conference/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('conference/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('conference/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('conference/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset('conference/plugins/easing/easing.js') }}"></script>
<script src="{{ asset('conference/plugins/parallax-js-master/parallax.min.js') }}"></script>
{{-- <script src="{{ asset('conference/js/custom.js') }}"></script> --}}
@yield('js')
</body>
</html>
