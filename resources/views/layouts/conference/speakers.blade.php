@extends('layouts.conference.layout')

@section('title', 'Conference Speakers')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/speakers.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/speakers_responsive.css') }}">
@endsection

@section('banner')
<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/speakers.jpg') }}" data-speed="0.8"></div>
@endsection

@section('content-banner')
<div class="home_content_container">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="home_content d-flex flex-row align-items-end justify-content-start">
					<div class="current_page">Speakers</div>
					<div class="breadcrumbs ml-auto">
						<ul>
							<li><a href="#">Home</a></li>
							<li>Speakers</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('content')

@foreach( $speakers as $speaker )

	@if( $speaker->id % 2 == 1 )
	<div class="speakers">
		<div class="container reset_container">

			<div class="row row-lg-eq-height">
				<div class="col-lg-6 speaker_col reset_col">
					<div class="speaker_image" style="background-image:url({{ asset('/storage/'.$speaker->image) }})"> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SAMPLE PICTURE
					</div>
				</div>
				<div class="col-lg-6">
					<div class="speaker_content d-flex flex-column align-items-start justify-content-center">
						<div class="speaker_title"> {{ $speaker->full_name }} </div>
						<div class="speaker_subtitle"> {{ $speaker->affiliate }} </div>
						<div class="speaker_text">
							<p> {{ $speaker->biography }} </p>
						</div>
						<div class="button speaker_button"><a href="#">Buy Tickets Now!</a></div>
					</div>
				</div>
			</div>

		</div>
	</div>
	@elseif ( $speaker->id % 2 == 0 )
	<div class="speakers">
		<div class="container reset_container">

			<div class="row row-lg-eq-height">
				<div class="col-lg-6">
					<div class="speaker_content d-flex flex-column align-items-start justify-content-center">
						<div class="speaker_title"> {{ $speaker->full_name }} </div>
						<div class="speaker_subtitle"> {{ $speaker->affiliate }} </div>
						<div class="speaker_text">
							<p> {{ $speaker->biography }} </p>
						</div>
						<div class="button speaker_button"><a href="#">Buy Tickets Now!</a></div>
					</div>
				</div>
				<div class="col-lg-6 speaker_col reset_col">
					<div class="speaker_image" style="background-image:url({{ asset('/storage/'.$speaker->image) }})">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SAMPLE PICTURE
					</div>
				</div>
			</div>

		</div>
	</div>
	@endif
@endforeach

@endsection

@section('js')
<script src="{{ asset('conference/js/speakers.js') }}"></script>
@endsection

