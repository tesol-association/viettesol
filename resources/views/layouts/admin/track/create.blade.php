@extends('layouts.admin.conference_layout')
@section('title','Create Track')
@section('css')
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
@endsection
