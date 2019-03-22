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
                <h3 class="box-title">User Infomation</h3>
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
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('/storage/' . $users->image) }}" alt="User profile picture">
                            <h3 class="profile-username text-center">{{ $users->user_name }}</h3>
                            <p class="text-muted text-center">{{ $users->initals }}</p>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <h3 class="text-muted">                       
                                About Me
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <strong>
                                    <i class="fa fa-user text-info"></i> 
                                     Full Name
                                </strong>
                                <p class="text-muted">
                                    {{ $users->first_name }} {{ $users->middle_name }} {{ $users->last_name }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-user text-info"></i> 
                                    Initals
                                </strong>
                                <p class="text-muted">
                                    {{ $users->initals }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-genderless text-info"></i>
                                    Gender
                                </strong>
                                <p class="text-muted">
                                    {{ $users->gender }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-steam text-info"></i> 
                                    Affiliation
                                </strong>
                                <p class="text-muted">
                                    {{ $users->affiliation }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-body">
                            <h3 class="box-title">                       
                                Contact Me
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <strong>
                                    <i class="fa fa-fw fa-phone text-info"></i>
                                     Phone
                                </strong>
                                <p class="text-muted">
                                    {{ $users->phone }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-fw fa-fax text-info"></i>
                                     Fax
                                </strong>
                                <p class="text-muted">
                                    {{ $users->fax }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-pencil margin-r-5 text-info"></i>
                                     Email
                                </strong>
                                <p class="text-muted">
                                    {{ $users->email }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-map-marker margin-r-5 text-info"></i>
                                     Country
                                </strong>
                                <p class="text-muted">
                                    {{ $users->country }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-body">
                            <h3 class="box-title">                       
                                Other
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <strong>
                                    <i class="fa fa-file-text-o margin-r-5 text-info"></i> Other
                                </strong>
                                <p class="text-muted">
                                    
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection