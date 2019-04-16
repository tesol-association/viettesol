@extends('layouts.admin.layout')
@section('title','Membership Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <div class="col-md-4">
                <h3 class="box-title">Member Infomation</h3>
            </div>
            <div class="col-md-2 col-md-offset-6">
                <a href="{{ route('admin_membership_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Member List</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="http://viettesol.weebly.com/uploads/6/0/0/1/60017649/logo_orig.png" alt="VIETTESOL's Member">
                            @if ( $member->memberType->name === "Premium" )
                            <h2 class="profile-username text-center"> <i class="fa fa-diamond"></i> Premium Membership <i class="fa fa-diamond"></i> </h2>
                            @elseif ( $member->memberType->name === "Normal" )
                            <h2 class="profile-username text-center"> <i class="fa fa-check"></i> Normal Membership <i class="fa fa-check"></i> </h2>
                            @else
                            <h2 class="profile-username text-center"> <i class="fa fa-certificate"></i> {{ $member->memberType->name }} Membership <i class="fa fa-certificate"></i> </h2>
                            @endif

                            @if ( $member->contact->contactType->name === "Individual" )
                            <h2 class="profile-username text-center">{{ $member->contact->first_name }} {{ $member->contact->middle_name }} {{ $member->contact->last_name }}</h2>
                            @else
                            <h2 class="profile-username text-center">{{ $member->contact->organize_name }}</h2>
                            @endif
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <h3 class="text-muted">                       
                                Member's Basic Information
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <strong>
                                    <i class="fa fa-user text-info"></i> 
                                     Contact Name
                                </strong>
                                @if ( $member->contact->contactType->name === "Individual" )
                                <p class="text-muted">
                                    {{ $member->contact->first_name }} {{ $member->contact->middle_name }} {{ $member->contact->last_name }}
                                </p>
                                @else
                                <p class="text-muted">
                                    {{ $member->contact->organize_name }}
                                </p>
                                @endif
                                <hr>

                                <strong>
                                    <i class="fa fa-user text-info"></i> 
                                    Membership Type
                                </strong>
                                <p class="text-muted">
                                    <b> {{ $member->memberType->name }} </b>
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-user text-info"></i>
                                    Contact Type
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->contactType->name }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-steam text-info"></i> 
                                    Website
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->website }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-body">
                            <h3 class="box-title">                       
                                Member's Contact Information
                            </h3>
                            <div class="col-md-10 col-md-offset-1">
                                <strong>
                                    <i class="fa fa-fw fa-phone text-info"></i>
                                     Phone
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->phone }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-fw fa-fax text-info"></i>
                                     Fax
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->fax }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-pencil margin-r-5 text-info"></i>
                                     Email
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->email }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-map-marker margin-r-5 text-info"></i>
                                    Country/ Nationality
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->country }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-map-marker margin-r-5 text-info"></i>
                                    Address
                                </strong>
                                <p class="text-muted">
                                    {{ $member->contact->address }}
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
                                    {{ $member->contact->other }}
                                </p>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Activity History</a></li>
                            <li><a href="#timeline" data-toggle="tab" aria-expanded="false">Fee/Donation History</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                
                            </div>
                            <div class="tab-pane" id="timeline">
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
                <a class="btn btn-primary" href="{{ route('admin_membership_edit', ["id" => $member->id]) }}"> <i class="fa fa-edit"></i> Edit This Membership </a>
        </div>
    </div>
</section>
@endsection