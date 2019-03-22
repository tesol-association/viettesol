@extends('layouts.admin.conference_layout')
@section('title','Create Conference Partners Sponsers')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Conference Partners Sponsers</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_conference_partners_sponsers_list', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Conference Partners Sponsers List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_conference_partners_sponsers_store', ['conference_id' => $conference->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">

                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Name" name="name" value="{{ old('name') }}" required>
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('logo') ? 'has-error' : ''}}">
                        <label for="logo">Logo*</label>
                        <input id="logo" type="file" class="form-control" name="logo" accept="image/*" required>
                        @if ($errors->has('logo'))
                            <span class="help-block">{{ $errors->first('logo') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('type') ? 'has-error' : ''}}">
                        <label for="type">Type*</label>
                        <select id="type" name="type" class="form-control" data-placeholder="Select a Type" style="width: 100%;" data-value="{{ old('type') }}" required>
                            <option value=""></option>
                            <option value="partner">Partner</option>
                            <option value="sponsor">Sponsor</option>
                        </select>
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
