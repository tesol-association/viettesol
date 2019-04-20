@extends('layouts.admin.layout')
@section('title','Author Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <div class="col-md-4">
                <h3 class="box-title">Author Infomation</h3>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="{{ asset('/storage/' . 'avatar_default/user_default.jpg') }}" alt="User profile picture">
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
                                    {{ $author->full_name }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-steam text-info"></i>
                                    Affiliation
                                </strong>
                                <p class="text-muted">
                                    {{ $author->affiliation }}
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
                                    <i class="fa fa-fw fa-fax text-info"></i>
                                     Web Site
                                </strong>
                                <p class="text-muted">
                                    <a target="_blank" href="{{ $author->site_url }}">{{ $author->site_url }}</a>
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-pencil margin-r-5 text-info"></i>
                                     Email
                                </strong>
                                <p class="text-muted">
                                    {{ $author->email }}
                                </p>
                                <hr>

                                <strong>
                                    <i class="fa fa-map-marker margin-r-5 text-info"></i>
                                     Country
                                </strong>
                                <p class="text-muted">
                                    {{ $author->country }}
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
                            <div class="tab-pane active" id="activity">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                  <!-- timeline time label -->
                                @if (!empty($papers))
                                    @foreach ($papers as $paper)
                                        <li class="time-label">
                                            <span class="bg-red">
                                                {{ date('H:i d/m/Y', strtotime($paper->created_at)) }}
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-envelope bg-blue"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Send Paper</a> sent you an email</h3>

                                                <div class="timeline-body">
                                                    {{ $paper->title }}
                                                </div>
                                                <div class="timeline-footer">
                                                    <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">Read more</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                    @endforeach
                                @endif
                                    <li>
                                        <i class="fa fa-clock-o bg-gray"></i>
                                    </li>
                                </ul>
                            </div>
                              <!-- /.tab-pane -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
