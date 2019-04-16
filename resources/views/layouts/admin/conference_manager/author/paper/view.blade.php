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
        </div>
    </div>
@endsection
