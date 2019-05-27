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
            @if ($conference->review_type == \Config::get('constants.CONFERENCE_REVIEW_TYPE.OPEN_REVIEW')
            || $conference->review_type == \Config::get('constants.CONFERENCE_REVIEW_TYPE.SINGLE_BLIND'))
                <dt>Author</dt>
                <dd>
                    @foreach ($paper->authors as $author)
                        <a href="{{ route('home_profile_show_mail', ['mail' => $author->email]) }}">{{ $author->full_name }} </a>,
                    @endforeach
                </dd>
            @endif
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
            <dd>
                @if (isset($trackDirectors) && count($trackDirectors))
                    @foreach ($trackDirectors as $trackDirector)
                        {{ $trackDirector->full_name }},
                    @endforeach
                @endif
            </dd>
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
@if ($reviewAssignment->date_confirmed && $reviewAssignment->declined != \Config::get('constants.REVIEW_ASSIGNMENT.DECLINED'))
    @include('reviewer.paper.sub_view.review_form')
@endif
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/paper/submission.js') }}"></script>
@endsection
