@extends('layouts.conference.layout')

@section('title','Home')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/responsive.css') }}"> 
@endsection
@section('banner')
<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/index.jpg') }}" data-speed="0.8"></div>
@endsection
@section('content-banner')
<div class="home_content_container">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="home_content">
					<div class="home_date">{{ \Carbon\Carbon::parse($conference->start_time)->format('d/m/Y') }}-{{ \Carbon\Carbon::parse($conference->end_time)->format('d/m/Y') }}</div>
					<div class="home_title">{{ $conference->title }}</div>
					<div class="home_location">{{ $conference->venue }}</div>
					<div class="home_text">{{ $conference->slogan }}</div>
					<div class="home_buttons">
						<div class="button home_button"><a href="#">Registration</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')

@endsection
@section('js')
<script src="{{ asset('conference/js/custom.js') }}"></script>
@endsection

