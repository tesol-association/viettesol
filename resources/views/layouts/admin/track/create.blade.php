@extends('layouts.admin.conference_layout')
@section('title','Create Track')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Create Track For Conference: {{ $conference->title }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_track_list', ["id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Track List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_track_store', ["id" => $conference->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Title" name="name" required value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('abbrev') ? 'has-error' : ''}}">
                        <label for="abbrev">Abbrev*</label>
                        <input id="abbrev" type="text" class="form-control" placeholder="Enter Title" name="abbrev" required value="{{ old('abbrev') }}">
                        @if ($errors->has('abbrev'))
                            <span class="help-block">{{ $errors->first('abbrev') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('policy') ? 'has-error' : ''}}">
                        <label for="policy">Policy</label>
                        <textarea name="policy" id="policy" class="form-control" rows="3" placeholder="Enter Policy ...">{{ old('policy') }}</textarea>
                        @if ($errors->has('policy'))
                            <span class="help-block">{{ $errors->first('policy') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="review_form_id">Choose Review Form</label>
                        <select id="review_form_id" name="review_form_id" class="form-control">
                            <option value=""></option>
                            @foreach($reviewForms as $reviewForm)
                                <option value="{{ $reviewForm->id }}">{{ $reviewForm->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group {{ $errors->first('user_id') ? 'has-error' : ''}}">
                        <label for="choose_user">Choose Track Director</label>
                        <select id="choose_user" name="user_id[]" class="form-control" multiple="multiple" data-placeholder="Select a Track Director" style="width: 100%;">
                            @if (isset($users) && count($users))
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('user_id'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="keywords">Keyword</label>
                        <select id="keywords" name="keywords[]" class="form-control" multiple="multiple" data-placeholder="Fill keyword and press Enter" style="width: 100%;">
                        </select>
                    </div>

                    <input type="hidden" name="conference_id" value="{{ $conference->id }}"/>
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
