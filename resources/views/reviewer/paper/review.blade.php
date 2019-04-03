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
<!-- Start: Paper Info-->
<div class="box box-solid">
    <div class="box-header with-border">
        <i class="fa fa-newspaper-o"></i>
        <h3 class="box-title">TITLE AND ABSTRACT</h3>
        <div class="box-tools pull-right">
            <a href="{{ route('reviewer_paper_list', [ 'conference_id' => $conference->id]) }}" class="btn btn-primary"><i class="fa fa-backward"></i> Paper List</a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <dl class="dl-horizontal">
            <dt>Title</dt>
            <dd>{{ $paper->title }}</dd>
            <dt>Track</dt>
            <dd>{{ $paper->track->name }}</dd>
            <dt>Review Form</dt>
            <dd>
                @if($paper->track->review_form_id)
                    {{ $paper->track->reviewForm->name }}
                @else
                    No Review Form
                @endif
            </dd>
            <dt>Session Type</dt>
            <dd>{{ $paper->sessionType->name }}</dd>
            <dt>Track Director</dt>
            <dd>??</dd>
            <dt>Abstract</dt>
            <dd>{!! $paper->abstract !!}</dd>
            <dt>Decided</dt>
            <dd>
            @if ($reviewAssignment->date_confirmed)
                @if ($reviewAssignment->declined)
                    <span class="label label-danger">Rejected</span>
                @else
                    <span class="label label-success">Accepted</span>
                @endif
            @else
                <span class="label label-warning">Not Decided</span>
            @endif
            </dd>
        </dl>
    </div>
    @if (!$reviewAssignment->date_confirmed)
        <div class="box-footer">
            <div class="col-md-2">
                <form action="{{ route('reviewer_accept_assignment', ['conference_id' => $conference->id, 'assignment_id' => $reviewAssignment->id]) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#accept_assignment"><i class="fa fa-check"></i> Accept</button>
                </form>
            </div>
            <div class="col-md-10">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject_assignment"><i class="fa fa-remove"></i> Reject</button>
            </div>
        </div>
        <!-- Start:: Reject Paper -->
        <div class="modal fade" id="reject_assignment" role="dialog">
            <form method="post" action="{{ route('reviewer_reject_assignment', [ "conference_id" => $conference->id, 'assignment_id'=> $reviewAssignment->id ]) }}">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure reject: {{ $paper->title }} ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Yes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- End:: Reject Paper -->
    @endif
</div>
<!-- End: Paper Info-->

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">DO REVIEW</h3>
    </div>
    <!-- form start -->
    <form role="form" method="POST" action="{{ route('reviewer_store_assignment', ['conference_id' => $conference->id, 'assignment_id' => $reviewAssignment->id]) }}">
        @csrf
        <div class="box-body">
            <div class="box-body">
                @if (isset($reviewAssignment->date_confirmed) && $reviewAssignment->declined == Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT'))
                    @foreach ($reviewForm->criteriaReviews as $criteriaReview)
                        <div class="form-group">
                            <label>{{ $criteriaReview->name }}</label>
                            @if ($reviewAssignment->date_completed)
                                <select disabled class="form-control">
                                    <option selected>{{ $reviewAssignment->reviewer_response[$criteriaReview->name] }}</option>
                                </select>
                            @else
                                <select name="review_form[{{ $criteriaReview->name }}]" class="form-control">
                                    @if (isset($criteriaReview->possible_values) && count($criteriaReview->possible_values))
                                        @foreach($criteriaReview->possible_values as $possibleValue)
                                            <option value="{{ $possibleValue }}">{{ $possibleValue }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif
                        </div>
                    @endforeach
                @endif
                <div class="form-group">
                    <label for="total">Total*
                    @if ($reviewAssignment->date_completed)
                        <input id="total" type="text" class="form-control" placeholder="Enter Total" name="total" value="{{ $reviewAssignment->total }}" disabled>
                    @else
                        <input id="total" type="text" class="form-control" placeholder="Enter Total" name="total" required="" value="{{ old('total') }}">
                    @endif
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    @if ($reviewAssignment->date_completed)
                        <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter comment ..." disabled>{{ $reviewAssignment->comment }}</textarea>
                    @else
                        <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter comment ...">{{ old('comment') }}</textarea>
                    @endif
                </div>
                <div class="form-group">
                    <label for="upload_file">Upload File</label>
                    @if ($reviewAssignment->date_completed)
                        <input type="file" id="upload_file" name="upload_file" disabled>
                    @else
                        <input type="file" id="upload_file" name="upload_file">
                    @endif
                </div>
                <div class="form-group">
                    <label for="recommendation">Recommendation</label>
                    @if ($reviewAssignment->date_completed)
                        <div class="form-control">
                        @switch($reviewAssignment->recomendation)
                            @case(Config::get('constants.REVIEW_ASSIGNMENT.ACCEPT_RECOMMENDATION'))
                                <span class="label label-success">Accept Paper</span>
                                @break
                            @case(Config::get('constants.REVIEW_ASSIGNMENT.REVISION_RECOMMENDATION'))
                                <span class="label label-success">Revision Paper</span>
                                @break
                            @case(Config::get('constants.REVIEW_ASSIGNMENT.REJECT_RECOMMENDATION'))
                                <span class="label label-success">Reject Paper</span>
                                @break
                        @endswitch
                            <span>At {{ date('H:i d/m/Y', strtotime($reviewAssignment->date_completed)) }}</span>
                        </div>
                    @else
                        <select name="recommendation" class="form-control" title="Choose One" required>
                            <option value=""></option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT') }}">Accept Paper</option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.REVISION_RECOMMENDATION') }}">Revision Paper</option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.REJECTED_ASSIGNMENT') }}">Reject Paper</option>
                        </select>
                    @endif
                </div>
            </div>
        </div>
        @if (!$reviewAssignment->date_completed)
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        @endif
    </form>
</div>

@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/paper/submission.js') }}"></script>
@endsection
