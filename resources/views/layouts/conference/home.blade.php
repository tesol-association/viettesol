@extends('layouts.conference.layout')

@section('title','Home')
@section('css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/responsive.css') }}"> 
<link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/custom.css') }}"> 
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
						<div class="button home_button"><a href="{{ route('admin_registration_create',['conference_id'=>$conference->id]) }}">Registration</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('content')
<div class="calendar">
	<div class="container reset_container">
		<div class="row">

			<div class="col-xl-6 calendar_col">
				<div class="calendar_container">
					<div class="calendar_title_bar d-flex flex-row align-items-center justify-content-start">
						<div><div class="calendar_icon"><img src="{{ asset('conference/images/calendar.svg') }}" alt=""></div></div>
						<div class="calendar_title">Important Dates</div>
					</div>
					<div class="calendar_items">

						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_5.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->author_registration_opened }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Open registration</div>
							</div>
						</div>

						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_6.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->author_registration_closed }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Open registration</div>
							</div>
						</div>

						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_7.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->submission_accepted }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Submission accepted</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="col-xl-6 calendar_col">
				<div class="calendar_container">
					<div class="calendar_title_bar d-flex flex-row align-items-center justify-content-start">
						<div><div class="calendar_icon"><img src="{{ asset('conference/images/calendar.svg') }}" alt=""></div></div>
						<div class="calendar_title">IMPORTANT DATES </div>
					</div>
					<div class="calendar_items">
						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_2.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->submission_closed }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Submission Closed</div>
							</div>
						</div>

						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_3.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->reviewer_registration_opened }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Reviewer registration opened</div>
							</div>
						</div>

						<!-- Calendar Item -->
						<div class="calendar_item d-flex flex-row align-items-center justify-content-start">
							<div><div class="calendar_item_image"><img src="{{ asset('conference/images/event_4.jpg') }}" alt=""></div></div>
							<div class="calendar_item_time">
								<div>{{ $conferenceTimeline->reviewer_registration_closed }}</div>
							</div>
							<div class="calendar_item_text">
								<div>Reviewer registration closed</div>
							</div>
						</div>


					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- Pricing -->

<div class="pricing">
	<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/pricing.jpg') }}" data-speed="0.8"></div>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<div class="pricing_section_title">Choose a plan</div>
			</div>
		</div>
		<div class="row pricing_row">

			@foreach($fees as $fee)
			<!-- Pricing Item -->
			<div class="col-lg-4 pricing_col">
				<div class="pricing_item">
					<div class="pricing_item_content">
						<div class="pricing_level">{{ $fee->category }} </div>
						<div class="pricing_price">{{ $fee->price_before_time }} $</div>
						<ul class="pricing_list">
							<li>{{ $fee->description }}</li>
						</ul>
						<div class="pricing_info">
							{{-- <a href="#">i</a> --}}
						</div>
						{{-- <div class="button pricing_button"><a href="#">Registration</a></div> --}}
					</div>
				</div>
			</div>

			@endforeach
		</div>
	</div>
</div>

<div class="intro">
	<div class="title"><h1 class="widget-content" >Partners/Sponsors</h1></div>
	@foreach($conferencePartnerSponsers as $conferencePartnerSponser)
	<img src="{{ asset('/storage/' .$conferencePartnerSponser->logo) }}" alt="" >
	@endforeach
</div>	

@endsection
@section('js')
<script src="{{ asset('conference/js/custom.js') }}"></script>
<script src="{{ asset('js/lib/toastr.min.js') }}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
 <script>
 	@if(Session::has('success'))
 	toastr.success('{{ Session::get("success") }}');
 	@endif
 	@if(Session::has('error'))
 	toastr.error('{{ Session::get("error") }}');
 	@endif
 	@if($errors->any())
 	@foreach($errors->all() as $error)
 	toastr.error('{{ $error }}');
 	@endforeach
 	@endif
 </script>
 @endsection

