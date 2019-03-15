@extends('layouts.home.layout')
@section('css')
    <script src="https://www.google.com/recaptcha/api.js?hl=en" async defer></script>
@endsection
@section('content')
<div class="container">
    <div class="col-md-8">
        <fieldset class="form-border">
            <legend class="form-border">
                <h1>
                    Contact Form
                </h1>
            </legend>
            @if (session('errors'))
                <div class="alert alert-danger">
                    {{ session('errors') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('home_contactForm_store') }}">
                @csrf
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">
                            <h2><i class="fa fa-envelope text-info"></i> Contact us</h2>
                            <p class="section-description">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within matter of hours to help you.</p>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user text-info"></i>
                                </div>
                                <input id="name" type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
                                
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope text-info"></i>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lightbulb-o text-info"></i>
                                </div>
                                <input id="subject" type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject') }}" required>

                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=message>Message</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-comments text-info"></i>
                                </div>
                                <textarea id='message' class="form-control" name="message" placeholder="Enter Message" rows="6" required></textarea>

                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <br>
                                <!-- Google reCaptcha -->
                                <div class="g-recaptcha" id="feedback-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                <!-- End Google reCaptcha -->

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block rounded-0 py-2">
                                    Send
                                </button>
                            </div>
                            <div class="col-md-2 col-md-offset-2">
                                <a href="{{ route('home_page') }}" class="btn btn-danger btn-block rounded-0 py-2">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </fieldset>
    </div>
</div>
@endsection