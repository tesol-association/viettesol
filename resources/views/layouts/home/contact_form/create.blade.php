@extends('layouts.home.layout')

@section('content')
<div class="container">
    <div class="col-md-8">
        <fieldset class="form-border">
            <legend class="form-border">
                <h1>
                    Contact Form
                </h1>
            </legend>
            <form method="POST" action="{{ route('home_contactForm_store') }}">
                @csrf
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">
                            <h2><i class="fa fa-envelope"></i> Contact us</h2>
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
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-lightbulb-o"></i>
                                </div>
                                <input id="subject" type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for=message>Message</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <textarea id='message' class="form-control" name="message" placeholder="Enter Message" rows="6" required></textarea>
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