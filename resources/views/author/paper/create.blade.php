@extends('layouts.admin.conference_layout')
@section('title','Send Paper')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<form method="POST" action="{{ route('author_paper_store', ["id" => $conference->id]) }}">
    @csrf
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">TRACK AND SESSION TYPE</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->first('track_id') ? 'has-error' : ''}}">
                <label for="track_id">Track</label>
                <select id="track_id" style="width: 100%;" tabindex="-1" aria-hidden="true" name="paper[track_id]" required>
                    @if (isset($tracks) && count($tracks))
                        @foreach ($tracks as $track)
                            <option value="{{ $track->id }}">{{ $track->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('track_id'))
                    <span class="help-block">{{ $errors->first('track_id') }}</span>
                @endif
            </div>
            <div class="form-group {{ $errors->first('session_type_id') ? 'has-error' : ''}}">
                <label for="session_type_id">Session Type</label>
                <select id="session_type_id" style="width: 100%;" tabindex="-1" aria-hidden="true" name="paper[session_type_id]" required>
                    @if (isset($sessionTypes) && count($sessionTypes))
                        @foreach ($sessionTypes as $sessionType)
                            <option value="{{ $sessionType->id }}">{{ $sessionType->name }}</option>
                        @endforeach
                    @endif
                </select>
                @if ($errors->has('session_type_id'))
                    <span class="help-block">{{ $errors->first('session_type_id') }}</span>
                @endif
            </div>
        </div>
    </div>

    <div id="author_form_create" class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">AUTHORS</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->first('first_name') ? 'has-error' : ''}}">
                <label for="first_name">First Name*</label>
                <input id="first_name" type="text" class="form-control" name="author[first_name]" required value="{{ $author->first_name }}">
                @if ($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('middle_name') ? 'has-error' : ''}}">
                <label for="middle_name">Middle Name</label>
                <input id="middle_name" type="text" class="form-control" name="author[middle_name]" value="{{ $author->middle_name }}">
                @if ($errors->has('middle_name'))
                    <span class="help-block">{{ $errors->first('middle_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('last_name') ? 'has-error' : ''}}">
                <label for="last_name">Last Name*</label>
                <input id="last_name" type="text" class="form-control" name="author[last_name]" required value="{{ $author->last_name }}">
                @if ($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('email') ? 'has-error' : ''}}">
                <label for="email">Email*</label>
                <input id="email" type="email" class="form-control" name="author[email]" required value="{{ $author->email }}">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('affiliation') ? 'has-error' : ''}}">
                <label for="affiliation">Affiliation*</label>
                <input id="affiliation" type="text" class="form-control" name="author[affiliation]" required value="{{ $author->affiliation }}">
                @if ($errors->has('affiliation'))
                    <span class="help-block">{{ $errors->first('affiliation') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('site_url') ? 'has-error' : ''}}">
                <label for="site_url">Site URL</label>
                <input id="site_url" type="text" class="form-control" name="author[site_url]" value="{{ $author->site_url }}">
                @if ($errors->has('site_url'))
                    <span class="help-block">{{ $errors->first('site_url') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" name="author[country]" data-value="{{ $author->country }}">
                    @include('helper.country')
                </select>

                @if ($errors->has('country'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">TITLE AND ABSTRACT</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                <label for="title">Title*</label>
                <input id="title" type="text" class="form-control" name="paper[title]" required value="{{ old('title') }}">
                @if ($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('abstract') ? 'has-error' : ''}}">
                <label for="abstract">Abstract*</label>
                <textarea name="paper[abstract]" id="abstract" class="form-control" rows="3" placeholder="Enter Abstract ...">{{ old('abstract') }}</textarea>
                @if ($errors->has('abstract'))
                    <span class="help-block">{{ $errors->first('abstract') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="keywords">Keyword</label>
                <select id="keywords" name="paper[keywords][]" class="form-control" multiple="multiple" data-placeholder="Fill keyword and press Enter" style="width: 100%;">
                    @if (isset($sugguestKeywords) && count($sugguestKeywords))
                        @foreach($sugguestKeywords as $keyword)
                            <option value="{{ $keyword }}">{{ $keyword }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('author_paper_list', ["conference_id" => $conference->id]) }}" class="btn btn-info">
                <i class="fa fa-backward"></i> Paper List
            </a>
        </div>
    </div>
</form>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/author/create.js') }}"></script>
@endsection
