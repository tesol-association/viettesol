@extends('layouts.admin.conference_layout')
@section('title','View Timeline')
@section('css')
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="col-md-4">
                <h3 class="box-title">Conference Info</h3>
            </div>
            <div class="col-md-2 col-md-offset-6">
                <a href="{{ route('admin_timeline_view', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> View Timeline </a>
            </div>
        </div>
        <div class="box-body">

            <div class="form-group">
                <label>Start Date:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="conference_start_time" value="{{ date('Y/m/d', strtotime($conference->start_time))  }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label>End Date:</label>

                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="conference_end_time" value="{{ date('Y/m/d', strtotime($conference->end_time))  }}" disabled>
                </div>
            </div>

        </div>
    </div>

    <form  method="post" action="{{ route('admin_timeline_update', ["conference_id" => $conference->id, "id" => $timeline->id]) }}">
    @csrf
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">SUBMISSIONS</h3>
        </div>
        <div class="box-body">

            <div class="form-group {{ $errors->first('author_registration_opened') ? 'has-error' : ''}}">
                <label for="author_registration_opened">Author registration opened:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="author_registration_opened" id="author_registration_opened" value="{{ $timeline->author_registration_opened }}">
                </div>
                @if ($errors->has('author_registration_opened'))
                    <span class="help-block">{{ $errors->first('author_registration_opened') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('author_registration_closed') ? 'has-error' : ''}}">
                <label for="author_registration_closed">Author registration closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="author_registration_closed" id="author_registration_closed" value="{{ $timeline->author_registration_closed }}">
                </div>
                @if ($errors->has('author_registration_closed'))
                    <span class="help-block">{{ $errors->first('author_registration_closed') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('submission_accepted') ? 'has-error' : ''}}">
                <label for="submission_accepted">Submissions accepted:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="submission_accepted" id="submission_accepted" value="{{ $timeline->submission_accepted }}">
                </div>
                @if ($errors->has('submission_accepted'))
                    <span class="help-block">{{ $errors->first('submission_accepted') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('submission_closed') ? 'has-error' : ''}}">
                <label for="submission_closed">Submissions closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="submission_closed" id="submission_closed" value="{{ $timeline->submission_closed }}">
                </div>
                @if ($errors->has('submission_closed'))
                    <span class="help-block">{{ $errors->first('submission_closed') }}</span>
                @endif
            </div>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">REVIEWS</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->first('reviewer_registration_opened') ? 'has-error' : ''}}">
                <label for="reviewer_registration_opened">Reviewer registration opened:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="reviewer_registration_opened" id="reviewer_registration_opened" value="{{ $timeline->reviewer_registration_opened }}">
                </div>
                @if ($errors->has('reviewer_registration_opened'))
                    <span class="help-block">{{ $errors->first('reviewer_registration_opened') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('reviewer_registration_closed') ? 'has-error' : ''}}">
                <label for="reviewer_registration_closed">Reviewer registration closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" required class="form-control pull-right" name="reviewer_registration_closed" id="reviewer_registration_closed" value="{{  $timeline->reviewer_registration_closed  }}">
                </div>
                @if ($errors->has('reviewer_registration_closed'))
                    <span class="help-block">{{ $errors->first('reviewer_registration_closed') }}</span>
                @endif
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/conference_timeline/create.js') }}"></script>
@endsection
