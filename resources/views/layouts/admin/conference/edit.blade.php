@extends('layouts.admin.layout')
@section('title','Edit Conference')
@section('css')
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Edit Conference</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_conference_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Conference List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_conference_update', ["id" => $conference->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('slogan') ? 'has-error' : ''}}">
                        <label for="slogan">Slogan*</label>
                        <input id="slogan" type="text" class="form-control" placeholder="Enter Title" name="slogan" required value="{{ $conference->slogan }}">
                        @if ($errors->has('slogan'))
                            <span class="help-block">{{ $errors->first('slogan') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                        <label for="title">Title*</label>
                        <input id="title" type="text" class="form-control" placeholder="Enter Title" name="title" required value="{{ $conference->title }}">
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('path') ? 'has-error' : ''}}">
                        <label for="path">Path*</label>
                        <input id="path" type="text" class="form-control" placeholder="Enter Title" name="path" required value="{{ $conference->path }}">
                        @if ($errors->has('path'))
                            <span class="help-block">{{ $errors->first('path') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('start_time') ? 'has-error' : ''}}">
                        <label for="start_time">Start Time*</label>
                        <input id="start_time" type='text' class="form-control" name="start_time" required value="{{ $conference->start_time }}" />
                        @if ($errors->has('start_time'))
                            <span class="help-block">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('end_time') ? 'has-error' : ''}}">
                        <label for="end_time">End Time*</label>
                        <input id="end_time" type='text' class="form-control" name="end_time" required value="{{ $conference->end_time }}" />
                        @if ($errors->has('end_time'))
                            <span class="help-block">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('venue') ? 'has-error' : ''}}">
                        <label for="venue">Venue*</label>
                        <input id="venue" type="text" class="form-control" placeholder="Enter Venue" name="venue" required value="{{ $conference->venue }}">
                        @if ($errors->has('venue'))
                            <span class="help-block">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('review_type') ? 'has-error' : ''}}">
                        <label for="review_type">Review Process Type*</label>
                        <select id="review_type" name="review_type" class="form-control" data-placeholder="Select a Review Process Type" style="width: 100%;">
                            @if ($conference->review_type == Config::get('constants.CONFERENCE_REVIEW_TYPE.OPEN_REVIEW'))
                                <option value="double_blind">Double Blind</option>
                                <option value="single_blind">Single Blind</option>
                                <option value="open_review" selected>Open Review</option>
                            @elseif ($conference->review_type == Config::get('constants.CONFERENCE_REVIEW_TYPE.SINGLE_BLIND'))
                                <option value="double_blind">Double Blind</option>
                                <option value="single_blind" selected>Single Blind</option>
                                <option value="open_review">Open Review</option>
                            @else
                                <option value="double_blind" selected>Double Blind</option>
                                <option value="single_blind">Single Blind</option>
                                <option value="open_review">Open Review</option>
                            @endif
                        </select>
                        @if ($errors->has('review_type'))
                            <span class="help-block">{{ $errors->first('review_type') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ $conference->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                        <label for="attach_file">Attach File</label>
                        <input type="file" id="attach_file" name="attach_file">
                        @if ($conference->attach_file)
                            <a href="{{ asset('/storage' . $conference->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                        @endif
                        @if ($errors->has('attach_file'))
                            <span class="help-block">{{ $errors->first('attach_file') }}</span>
                        @endif
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/conference/create.js') }}"></script>
@endsection
