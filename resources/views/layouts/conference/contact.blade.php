@extends('layouts.conference.layout')
@section('title','Contact')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/contact.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('conference/styles/contact_responsive.css') }}">
@endsection
@section('banner')
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('conference/images/contact.jpg') }}" data-speed="0.8"></div>
@endsection
@section('content-banner')
   <div class="home_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content d-flex flex-row align-items-end justify-content-start">
                        <div class="current_page">Contact</div>
                        <div class="breadcrumbs ml-auto">
                            <ul>
                                <li><a href="{{ route('conference_home', $conference->path) }}">Home</a></li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="contact">
        <div class="contact_map_background">
            <!-- Contact Map -->
            <div class="contact_map">
                <!-- Google Map -->
                <div class="map">
                    <div id="google_map" class="google_map">
                        <div class="map_container">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Contact us</div>
                        <form action="#" class="contact_form" id="contact_form">
                            <input type="text" class="contact_input" placeholder="Name" required="required">
                            <input type="email" class="contact_input" placeholder="E-mail" required="required">
                            <input type="text" class="contact_input" placeholder="Subject" required="required">
                            <textarea name="contact_textarea" id="contact_textarea" class="contact_textarea contact_input" placeholder="Message" required="required"></textarea>
                            <button class="button contact_button"><span>Send Message</span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="contact_info_container">
                        <div>
                            <a href="#">
                                <div class="logo_container d-flex flex-row align-items-start justify-content-start">
                                    <div class="logo_image"><div><img src="{{ asset('conference/images/logo.png') }}" alt=""></div></div>
                                    <div class="logo_content">
                                        <div id="logo_text" class="logo_text logo_text_not_ie">{{ $conference->title }}</div>
                                        <div class="logo_sub">{{ $conference->start_time }} - {{ $conference->end_time }}</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="contact_info_list_container">
                            <ul class="contact_info_list">
                                <li class="d-flex flex-row align-items-start justify-content-start">
                                    <div><div class="contact_info_icon text-center"><img src="{{ asset('conference/images/contact_1.png') }}" alt=""></div></div>
                                    <div class="contact_info_text">{{ $conference->venue }}</div>
                                </li>
                                <li class="d-flex flex-row align-items-start justify-content-start">
                                    <div><div class="contact_info_icon text-center"><img src="{{ asset('conference/images/contact_2.png') }}" alt=""></div></div>
                                    <div class="contact_info_text">0034 37483 2445 322</div>
                                </li>
                                <li class="d-flex flex-row align-items-start justify-content-start">
                                    <div><div class="contact_info_icon text-center"><img src="{{ asset('conference/images/contact_3.png') }}" alt=""></div></div>
                                    <div class="contact_info_text">hello@company.com</div>
                                </li>
                            </ul>
                        </div>
                        <div class="contact_info_pin"><div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
    <script src="{{ asset('conference/js/contact.js') }}"></script>
@endsection
