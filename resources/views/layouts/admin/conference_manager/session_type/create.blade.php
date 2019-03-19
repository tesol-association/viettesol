@extends('layouts.admin.conference_layout')
@section('title','Create Session Type')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Session Type</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_session_type_list', ['conference_id' => $conference_id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Session Type List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_session_type_store', ['conference_id' => $conference_id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('length') ? 'has-error' : ''}}">
                        <label for="length">Duration</label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="length" name="length" placeholder="Enter Duration (ex: 60)" value="{{ old('length') }}">
                            <span class="input-group-addon">minutes</span>
                        </div>
                        @if ($errors->has('length'))
                            <span class="help-block">{{ $errors->first('length') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('abstract_length') ? 'has-error' : ''}}">
                        <label for="abstract_length">Abstract length</label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="abstract_length" name="abstract_length" placeholder="Enter abstract length (word)" value="{{ old('abstract_length') }}">
                            <span class="input-group-addon">words</span>
                        </div>
                        @if ($errors->has('abstract_length'))
                            <span class="help-block">{{ $errors->first('abstract_length') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                    	<label for="description">Description</label>
                    	<textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter Description"></textarea>
                    	@if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
