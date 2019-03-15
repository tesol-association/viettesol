@extends('layouts.admin.conference_layout')
@section('title','Edit Buildings')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
	<div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Buildings</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_buildings_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Buildings List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_buildings_update', ["conference_id" => $conference->id, "id" => $building->id ]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ $building->name }}" required>
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('abbrev') ? 'has-error' : ''}}">
                        <label for="abbrev">Abbrev*</label>
                        <input class="form-control" type="text" id="abbrev" name="abbrev" placeholder="Enter Abbrev" value="{{ $building->abbrev }}" required>
                        @if ($errors->has('abbrev'))
                            <span class="help-block">{{ $errors->first('abbrev') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                    	<label for="description">Description</label>
                    	<textarea class="form-control" id="description" name="description" rows="6" placeholder="Enter discription for building">{{ $building->description }}</textarea>
                    	@if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection