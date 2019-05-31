@extends('layouts.admin.conference_layout')
@section('title','Edit Email')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Email {{ $email->name }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_prepared_email_list', ["id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Email List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_prepared_email_update', ["conference_id" => $conference->id, "id" => $email->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('email_key') ? 'has-error' : ''}}">
                        <label for="email_key">Email Key*</label>
                        <input id="email_key" type="text" class="form-control" placeholder="Enter Title" name="email_key" required value="{{ $email->email_key }}">
                        @if ($errors->has('email_key'))
                            <span class="help-block">{{ $errors->first('email_key') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('subject') ? 'has-error' : ''}}">
                        <label for="subject">Subject*</label>
                        <input id="subject" type="text" class="form-control" placeholder="Enter Title" name="subject" required value="{{ $email->subject }}">
                        @if ($errors->has('subject'))
                            <span class="help-block">{{ $errors->first('subject') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('body') ? 'has-error' : ''}}">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" rows="3" placeholder="Enter Policy ...">{{ $email->body }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
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
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/track/create.js') }}"></script>
@endsection
