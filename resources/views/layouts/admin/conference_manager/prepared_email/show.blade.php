@extends('layouts.admin.conference_layout')
@section('title','Edit Review Form')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
@endsection
@section('page-header') Prepared Email
@endsection
@section('content')
    <form method="POST" action="{{ $emailTemplate['form_url'] ?? null }}">
        @csrf
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="box-body">
                <div class="form-group">
                    <label for="email_from">From*</label>
                    <input id="email_from" type="text" class="form-control" name="email_from" required value="{{ $emailTemplate['from'] ?? null }}">
                </div>
                <div class="form-group">
                    <label for="email_to">To*</label>
                    <input id="email_to" type="text" class="form-control" name="email_to" required value="{{ $emailTemplate['to'] ?? null }}">
                </div>
                <div class="form-group">
                    <label for="email_subject">Subject*</label>
                    <input id="email_subject" type="text" class="form-control" name="email_subject" required value="{{ $emailTemplate['subject'] ?? null }}">
                </div>
                <div class="form-group">
                    <label for="email_body">Body*</label>
                    <textarea id="email_body" name="email_body" class="form-control" rows="10" placeholder="Enter Body ...">{{ $emailTemplate['body'] ?? null }}</textarea>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plane"></i> Send</button>
                <a type="button" class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
            </div>
        </div>
    </form>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
@endsection
