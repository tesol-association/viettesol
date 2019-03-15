@extends('layouts.admin.layout')
@section('title','View Timeline')
@section('css')
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <div class="col-md-4">
                <h3 class="box-title">Conference Info</h3>
            </div>
            <div class="col-md-2 col-md-offset-6">
                @if ($timeline)
                    <a href="{{ route('admin_timeline_edit', ["conference_id" => $conference->id, 'id' => $timeline->id]) }}" class="btn btn-block btn-info"><i class="fa fa-edit"></i> Edit Timeline </a>
                @else ($timeline)
                    <a href="{{ route('admin_timeline_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Create Timeline </a>
                @endif
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

    <form  method="post" action="{{ route('admin_conference_update', ["id" => $conference->id]) }}" enctype="multipart/form-data">
        @csrf
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">SUBMISSIONS</h3>
        </div>
        <div class="box-body">

            <div class="form-group">
                <label for="author_registration_opened">Author registration opened:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="author_registration_opened" id="author_registration_opened" value="{{ $timeline->author_registration_opened ? date('Y/m/d', strtotime($timeline->author_registration_opened)) : "" }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="author_registration_closed">Author registration closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="author_registration_closed" id="author_registration_closed" value="{{ $timeline ? date('Y/m/d', strtotime($timeline->author_registration_closed)) : "" }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="author_registration_opened">Submissions accepted:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="author_registration_opened" id="author_registration_opened" value="{{ $timeline ? date('Y/m/d', strtotime($timeline->author_registration_opened)) : "" }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="author_registration_closed">Submissions closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="author_registration_closed" id="author_registration_closed" value="{{ $timeline ? date('Y/m/d', strtotime($timeline->author_registration_closed)) : "" }}" disabled>
                </div>
            </div>

        </div>
    </div>

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">REVIEWS</h3>
        </div>
        <div class="box-body">

            <div class="form-group">
                <label for="reviewer_registration_opened">Reviewer registration opened:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="reviewer_registration_opened" id="reviewer_registration_opened" value="{{ $timeline ? date('Y/m/d', strtotime($timeline->reviewer_registration_opened)) : "" }}" disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="reviewer_registration_closed">Reviewer registration closed:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="reviewer_registration_closed" id="reviewer_registration_closed" value="{{ $timeline ? date('Y/m/d', strtotime($timeline->reviewer_registration_closed)) : "" }}" disabled>
                </div>
            </div>

        </div>
    </div>
    </form>
@endsection
@section('js')
@endsection
