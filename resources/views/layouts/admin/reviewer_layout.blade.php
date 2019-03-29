@extends('layouts.admin.conference_layout')
@section('sidebar')
    @include('layouts.sidebar.reviewer', ['conference' => $conference])
@endsection
