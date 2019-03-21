@extends('layouts.admin.conference_layout')
@section('title','Edit Review Form')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('page-header') ABSTRACT REVIEW
@endsection
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#review" data-toggle="tab" aria-expanded="true">REVIEW</a></li>
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">SUMMARY</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">HISTORY</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="review">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
                        <h3 class="box-title">TITLE AND ABSTRACT</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Author</dt>
                            <dd>
                                @foreach($paper->authors as $author)
                                    {{ $author->first_name }} {{ $author->last_name }} ,
                                @endforeach
                            </dd>
                            <dt>Title</dt>
                            <dd>{{ $paper->title }}</dd>
                            <dt>Track</dt>
                            <dd>{{ $paper->track->name }}</dd>
                            <dt>Session Type</dt>
                            <dd>{{ $paper->sessionType->name }}</dd>
                            <dt>Track Director</dt>
                            <dd>??</dd>
                            <dt>Abstract</dt>
                            <dd>{!! $paper->abstract !!}</dd>
                        </dl>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">
                The European languages are members of the same family. Their separate existence is a myth.
                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                new common language would be desirable: one could refuse to pay expensive translators. To
                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                words. If several languages coalesce, the grammar of the resulting language is more simple
                and regular than that of the individual languages.
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
<form method="POST" action="{{ route('admin_paper_store', ["id" => $conference->id]) }}">
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

    <div class="box box-primary">
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
                <input id="first_name" type="text" class="form-control" name="authors[0][first_name]" required value="">
                @if ($errors->has('first_name'))
                    <span class="help-block">{{ $errors->first('first_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('middle_name') ? 'has-error' : ''}}">
                <label for="middle_name">Middle Name</label>
                <input id="middle_name" type="text" class="form-control" name="authors[0][middle_name]" value="">
                @if ($errors->has('middle_name'))
                    <span class="help-block">{{ $errors->first('middle_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('last_name') ? 'has-error' : ''}}">
                <label for="last_name">Last Name*</label>
                <input id="last_name" type="text" class="form-control" name="authors[0][last_name]" required value="">
                @if ($errors->has('last_name'))
                    <span class="help-block">{{ $errors->first('last_name') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('email') ? 'has-error' : ''}}">
                <label for="email">Email*</label>
                <input id="email" type="email" class="form-control" name="authors[0][email]" required value="">
                @if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('affiliation') ? 'has-error' : ''}}">
                <label for="affiliation">Affiliation*</label>
                <input id="affiliation" type="text" class="form-control" name="authors[0][affiliation]" required value="">
                @if ($errors->has('affiliation'))
                    <span class="help-block">{{ $errors->first('affiliation') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('site_url') ? 'has-error' : ''}}">
                <label for="site_url">Site URL</label>
                <input id="site_url" type="text" class="form-control" name="authors[0][site_url]" value="">
                @if ($errors->has('site_url'))
                    <span class="help-block">{{ $errors->first('site_url') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" name="authors[0][country]" data-value="">
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
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin_paper_list', ["conference_id" => $conference->id]) }}" class="btn btn-info">
                <i class="fa fa-backward"></i> Paper List
            </a>
        </div>
    </div>
</form>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/paper/create.js') }}"></script>
@endsection
