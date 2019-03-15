@extends('layouts.admin.conference_layout')
@section('title','Update Speakers')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Update Speakers</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_speakers_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> speakers List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_speakers_update', ["conference_id" => $conference_id, "id" => $speaker->id ]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('image') ? 'has-error' : ''}}">
                        <label for="image">Image*</label>
                        <br>
                        <img class="img-circle" src="{{ asset('/storage/' . $speaker->image) }}" alt="Avatar" height="100" width="100">
                        <input id="image" type="file" class="form-control" name="image" accept="image/*">
                        @if ($errors->has('image'))
                            <span class="help-block">{{ $errors->first('image') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('full_name') ? 'has-error' : ''}}">
                        <label for="full_name">Full Name*</label>
                        <input id="full_name" type="text" class="form-control" placeholder="Enter Full Name" name="full_name" value="{{ $speaker->full_name }}" required>
                        @if ($errors->has('full_name'))
                            <span class="help-block">{{ $errors->first('full_name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('affiliate') ? 'has-error' : ''}}">
                        <label for="affiliate">Affiliate*</label>
                        <input id="affiliate" type="text" class="form-control" name="affiliate" placeholder="Enter Affiliate" value="{{ $speaker->affiliate }}" required>
                        @if ($errors->has('affiliate'))
                            <span class="help-block">{{ $errors->first('affiliate') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('site_url') ? 'has-error' : ''}}">
                        <label for="site_url">Link Web Tite</label>
                        <input class="form-control" type="text" id="site_url" name="site_url" placeholder="Enter Link Web Tite" value="{{ $speaker->site_url }}">
                        @if ($errors->has('site_url'))
                            <span class="help-block">{{ $errors->first('site_url') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('biography') ? 'has-error' : ''}}">
                        <label for="biography">Biography</label>
                        <textarea class="form-control" id="biography" name="biography" rows="6" placeholder="Enter Biography">{{ $speaker->biography }}</textarea>
                        @if ($errors->has('biography'))
                            <span class="help-block">{{ $errors->first('biography') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('abstract') ? 'has-error' : ''}}">
                        <label for="abstract">Abstract</label>
                        <textarea class="form-control" id="abstract" name="abstract" rows="6" placeholder="Enter Abstract">{{ $speaker->abstract }}</textarea>
                        @if ($errors->has('abstract'))
                            <span class="help-block">{{ $errors->first('abstract') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                        <label for="attach_file">Attach File</label>
                        <input id="attach_file" type="file" class="form-control" name="attach_file">
                        @if ($speaker->attach_file)
                            <a target="_blank" href="{{ asset('/storage/' . $speaker->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                        @endif
                        @if ($errors->has('attach_file'))
                            <span class="help-block">{{ $errors->first('attach_file') }}</span>
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
@section('js')
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
