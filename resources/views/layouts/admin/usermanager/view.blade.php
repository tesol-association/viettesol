@extends('layouts.admin.layout')
@section('title','User Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <div class="col-md-4">
                <h3 class="box-title">User List</h3>
            </div>
            <div class="col-md-2 col-md-offset-6">
                <a href="{{ route('admin_user_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> User List</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ $users->image }}" alt="User profile picture">
                            <h3 class="profile-username text-center">{{ $users->user_name }}</h3>
                            <p class="text-muted text-center">{{ $users->initals }}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Full Name</b>
                                    <a class="pull-right">{{ $users->first_name }} {{ $users->middle_name }} {{ $users->last_name }}
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Gender</b>
                                    <a class="pull-right">{{ $users->gender }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Affiliation</b>
                                    <a class="pull-right">{{ $users->affiliation }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                             <h3 class="box-title">About Me</h3>
                        </div>
                        <div class="box-body">
                            <strong>
                                <i class="fa fa-fw fa-phone"></i> Phone
                            </strong>
                            <p class="text-muted">{{ $users->phone }}</p><hr>
                            <strong>
                                <i class="fa fa-fw fa-fax"></i> Fax
                            </strong>
                            <p class="text-muted">{{ $users->fax }}</p><hr>
                            <strong>
                                <i class="fa fa-pencil margin-r-5"></i> Email
                            </strong>
                            <p>{{ $users->email }} </p><hr>
                            <strong>
                                <i class="fa fa-map-marker margin-r-5"></i> Country
                            </strong>
                            <p class="text-muted">{{ $users->country }}</p><hr>
                            <strong>
                                <i class="fa fa-file-text-o margin-r-5"></i> Other
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection