@extends('layouts.admin.conference_layout')
@section('title','Paper Information')
@section('css')
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('page-header') Paper Information
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Paper Information</h3>
        </div>
        <div class="box-body">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">TITLE</h3>
                </div>
                <div class="box-body">
                    {{ $paper->title }}
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">ABSTRACK</h3>
                </div>
                <div class="box-body">
                    {!! $paper->abstract !!}
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">ATTACH FILE</h3>
                </div>
                <div class="box-body">
                    @if ($paper->file_id)
                        <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}" class="btn btn-primary"><span class="fa fa-download"></span> {{ $paper->attachFile->original_file_name }}</a>
                    @endif
                </div>
            </div>
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">KEYWORDS:</h3>
                </div>
                <div class="box-body">
                    @if (isset($paper->keywords) && count($paper->keywords))
                        @foreach ($paper->keywords as $keyword)
                            <span class="label label-success">{{ $keyword }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
