@extends('layouts.admin.conference_layout')
@section('title','Create Track')
@section('css')
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Create Track For Conference {{ $conference->title }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_conference_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Conference List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_conference_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('slogan') ? 'has-error' : ''}}">
                        <label for="slogan">Slogan*</label>
                        <input id="slogan" type="text" class="form-control" placeholder="Enter Title" name="slogan" required value="{{ old('slogan') }}">
                        @if ($errors->has('slogan'))
                            <span class="help-block">{{ $errors->first('slogan') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                        <label for="title">Title*</label>
                        <input id="title" type="text" class="form-control" placeholder="Enter Title" name="title" required value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('path') ? 'has-error' : ''}}">
                        <label for="path">Path*</label>
                        <input id="path" type="text" class="form-control" placeholder="Enter Title" name="path" required value="{{ old('path') }}">
                        @if ($errors->has('path'))
                            <span class="help-block">{{ $errors->first('path') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('start_time') ? 'has-error' : ''}}">
                        <label for="start_time">Start Time*</label>
                        <input id="start_time" type='text' class="form-control" name="start_time" required value="{{ old('start_time') }}" />
                        @if ($errors->has('start_time'))
                            <span class="help-block">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('end_time') ? 'has-error' : ''}}">
                        <label for="end_time">End Time*</label>
                        <input id="end_time" type='text' class="form-control" name="end_time" required value="{{ old('end_time') }}" />
                        @if ($errors->has('end_time'))
                            <span class="help-block">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('venue') ? 'has-error' : ''}}">
                        <label for="venue">Venue*</label>
                        <input id="venue" type="text" class="form-control" placeholder="Enter Venue" name="venue" required value="{{ old('venue') }}">
                        @if ($errors->has('venue'))
                            <span class="help-block">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                        <label for="attach_file">Attach File</label>
                        <input type="file" id="attach_file" name="attach_file">
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
