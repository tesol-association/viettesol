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
            <li class=""><a href="#paper_history" data-toggle="tab" aria-expanded="false">HISTORY</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="review">
                @include('layouts.admin.paper.sub_view.paper_info', ['paper' => $paper])
                @include('layouts.admin.paper.sub_view.review_assignment_list', [
                        'conference' => $conference,
                        'paper' => $paper,
                        'reviewers' => $reviewers,
                ])
                @include('layouts.admin.paper.sub_view.track_decision', [
                    'trackDecisions' => $trackDecisions,
                    'conference' => $conference,
                    'paper' => $paper,
                ])
            </div>
            <!-- start::HISTORY PAPER -->
            <div class="tab-pane" id="paper_history">
                @include('layouts.admin.paper.sub_view.paper_history', [
                    'histories' => $paperHistories
                ])
            </div>
            <!-- end::HISTORY PAPER -->
        </div>
        <!-- /.tab-content -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/paper/submission.js') }}"></script>
@endsection
