@extends('layouts.admin.conference_layout')
@section('title','Dashboard Conferences')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href='{{ asset('css/calendar/fullcalendar.min.css') }}' rel='stylesheet' />
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
@endsection
@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Conferences</small>
    </h1>
    </section>
<section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ count($papers) }}</h3>
                    <p>Paper</p>
                </div>
                <div class="icon">
                  <i class="fa fa-newspaper-o"></i>
                </div>
                <a href="{{ route('admin_paper_list', ['id'=>$conference->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
       <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($tracks) }}</h3>
                    <p>Track</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('admin_track_list', ['id'=>$conference->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($author) }}</h3>
                    <p>Author</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ count($reviewer) }}</h3>
                    <p>Reviewer</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="{{ route('track_director_user_list', ['id'=>$conference->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($reviewerAssignment) }}</h3>
                    <p>Review Assignment</p>
                </div>
                <div class="icon">
                  <i class="fa fa-eyedropper"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ count($announcements) }}</h3>
                    <p>Announcements</p>
                </div>
                <div class="icon">
                  <i class="fa fa-paper-plane"></i>
                </div>
                <a href="{{ route('admin_announcements_list', ['id'=>$conference->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Time line</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <ul class="timeline">
                            @if(!empty($timeLine))
                                <li>
                                    <i class="fa fa-close bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($conference->end_time)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Conferences End</a></h3>
                                    </div>
                                </li>
                                <li class="time-label">
                                    <span class="bg-red">
                                        {{ date('d/m/Y', strtotime($conference->end_time)) }}
                                    </span>
                                </li>
                                <li>
                                    <i class="fa fa-clock-o bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 0:00  {{ date('d/m/Y', strtotime($conference->start_time)) }} - 24:00  {{ date('d/m/Y', strtotime($conference->end_time)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Conferences Process</a></h3>
                                    </div>
                                </li>
                                @if(!($conference->end_time == $conference->start_time))
                                    <li class="time-label">
                                        <span class="bg-green">
                                            {{ date('d/m/Y', strtotime($conference->start_time)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa  fa-circle-o-notch bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($conference->start_time)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Conferences Start</a></h3>
                                    </div>
                                </li>
                                @if(!($conference->start_time == $timeLine->review_deadline))
                                    <li class="time-label">
                                        <span class="bg-red">
                                            {{ date('d/m/Y', strtotime($timeLine->review_deadline)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa fa-close bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($timeLine->review_deadline)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Review Deadline</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-close bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_closed)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Reviewer Registration Close</a></h3>
                                    </div>
                                </li>
                                @if(!($timeLine->review_deadline == $timeLine->reviewer_registration_closed))
                                    <li class="time-label">
                                        <span class="bg-red">
                                            {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_closed)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa fa-clock-o bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_opened)) }} - 24:00  {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_closed)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Reviewer Registration</a></h3>
                                    </div>
                                </li>
                                @if(!($timeLine->reviewer_registration_closed == $timeLine->reviewer_registration_opened))
                                    <li class="time-label">
                                        <span class="bg-green">
                                            {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_opened)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa  fa-circle-o-notch bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_opened)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Reviewer Registration Open</a></h3>
                                    </div>
                                </li>
                                <li>
                                    <i class="fa fa-close bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($timeLine->author_registration_closed)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Author Registration Close</a></h3>
                                    </div>
                                </li>
                                @if(!($timeLine->reviewer_registration_opened == $timeLine->author_registration_closed))
                                    @if($timeLine->author_registration_closed == $timeLine->submission_closed)
                                        <li>
                                            <i class="fa fa-close bg-red"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($timeLine->submission_closed)) }}</span>
                                                <h3 class="timeline-header"><a href="#">Submission Close</a></h3>
                                            </div>
                                        </li>
                                    @endif
                                    <li>
                                    <li class="time-label">
                                        <span class="bg-red">
                                            {{ date('d/m/Y', strtotime($timeLine->author_registration_closed)) }}
                                        </span>
                                    </li>
                                @endif
                                @if(!($timeLine->author_registration_closed == $timeLine->submission_closed))
                                    <li>
                                        <i class="fa fa-close bg-red"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 24:00  {{ date('d/m/Y', strtotime($timeLine->submission_closed)) }}</span>
                                            <h3 class="timeline-header"><a href="#">Submission Close</a></h3>
                                        </div>
                                    </li>
                                    <li class="time-label">
                                        <span class="bg-red">
                                            {{ date('d/m/Y', strtotime($timeLine->submission_closed)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa fa-clock-o bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 00:00 {{ date('d/m/Y', strtotime($timeLine->submission_accepted)) }} - 24:00  {{ date('d/m/Y', strtotime($timeLine->submission_closed)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Submission Process</a></h3>
                                    </div>
                                </li>
                                @if(!($timeLine->submission_closed == $timeLine->submission_accepted))
                                    <li class="time-label">
                                        <span class="bg-green">
                                            {{ date('d/m/Y', strtotime($timeLine->submission_accepted)) }}
                                        </span>
                                    </li>
                                @endif
                                    <li>
                                        <i class="fa  fa-circle-o-notch bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($timeLine->submission_accepted)) }}</span>
                                            <h3 class="timeline-header"><a href="#">Submission Accepted</a></h3>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="fa fa-clock-o bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($timeLine->author_registration_opened)) }} - 24:00 {{ date('d/m/Y', strtotime($timeLine->author_registration_closed)) }}</span>
                                            <h3 class="timeline-header"><a href="#">Author Registration</a></h3>
                                        </div>
                                    </li>
                                @if(!($timeLine->submission_accepted == $timeLine->author_registration_opened))
                                    <li class="time-label">
                                        <span class="bg-green">
                                            {{ date('d/m/Y', strtotime($timeLine->author_registration_opened)) }}
                                        </span>
                                    </li>
                                @endif
                                <li>
                                    <i class="fa  fa-circle-o-notch bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 00:00  {{ date('d/m/Y', strtotime($timeLine->author_registration_opened)) }}</span>
                                        <h3 class="timeline-header"><a href="#">Author Registration Open</a></h3>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box box-solid bg-aqua-gradient">
                    <div class="box-header ui-sortable-handle" style="cursor: move;">
                        <i class="fa fa-calendar"></i>
                        <h3 class="box-title">Calendar</h3>
                        <div class="pull-right box-tools">
                            <button type="button" class="btn bg-aqua btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn bg-aqua btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div id="calendar" style="width: 100%" data-conference_id = {{ $conference->id }}></div>
                    </div>
                    @if(!empty($timeLine))
                    <div class="box-footer text-black">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <span class="pull-left">Author Registration Process</span>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{ date('d/m/Y', strtotime($timeLine->author_registration_opened)) }} - {{ date('d/m/Y', strtotime($timeLine->author_registration_closed)) }}</span>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-blue" style="width: {{ ((strtotime(Carbon\Carbon::now()) - strtotime($timeLine->author_registration_opened))/((strtotime($timeLine->author_registration_closed) - strtotime($timeLine->author_registration_opened)))) * 100 }}%;"></div>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-left">Submission Process</span>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{ date('d/m/Y', strtotime($timeLine->submission_accepted)) }} - {{ date('d/m/Y', strtotime($timeLine->submission_closed)) }}</span>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-blue" style="width: {{ ((strtotime(Carbon\Carbon::now()) - strtotime($timeLine->submission_accepted))/((strtotime($timeLine->submission_closed) - strtotime($timeLine->submission_accepted)))) * 100 }}%;"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <span class="pull-left">Reviewer Registration Process</span>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_opened)) }} - {{ date('d/m/Y', strtotime($timeLine->reviewer_registration_closed)) }}</span>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-blue" style="width: {{ ((strtotime(Carbon\Carbon::now()) - strtotime($timeLine->reviewer_registration_opened))/((strtotime($timeLine->reviewer_registration_closed) - strtotime($timeLine->reviewer_registration_opened)))) * 100 }}%;"></div>
                                </div>
                                <div class="clearfix">
                                    <span class="pull-left">Conferences Process</span>
                                    <span class="time pull-right"><i class="fa fa-clock-o"></i> {{ date('d/m/Y', strtotime($conference->start_time)) }} - {{ date('d/m/Y', strtotime($conference->start_time)) }}</span>
                                </div>
                                <div class="progress xs">
                                    <div class="progress-bar progress-bar-blue" style="width: {{ ((strtotime(Carbon\Carbon::now()) - strtotime($conference->start_time))/((strtotime($conference->end_time) - strtotime($conference->start_time)))) * 100 }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Paper Status</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                </div>
                <div class="box-body">
                    <div id="admin_chart" style="height: 300px; width: 100%;" data-paper_submitted="{{ count($paperSubmitted) }}" data-paper_submitted="{{ count($paperInReview) }}" data-paper_review_result="{{ count($paperReviewResult) }}" data-paper_accepted="{{ count($paperAccepted) }}" data-paper_rejected="{{ count($paperReJected) }}" data-paper_revision="{{ count($paperRevision) }}" data-paper_un_schedule="{{ count($paperUnscheduled) }}" data-paper_schedule="{{ count($paperScheduled) }}"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Review Assignment</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ count($reviewerAssignmentUnfinish) }}</h3>
                            <p>Review Assignment Un Finish</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-paper-plane"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ count($reviewerAssignmentCompleted) }}</h3>
                            <p>Review Assignment Completed On Time</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ count($reviewerAssignmentDeadlive) }}</h3>
                            <p>Review Assignment Out Of Deadline</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-paper-plane"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Paper Status Submited</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="paper_submitted" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Track</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paperSubmitted as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>{{ $paper->status }}</td>
                                <td>{{ $paper->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="filters">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Paper Status Review Result</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="paper_review_result" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Track</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paperReviewResult as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>{{ $paper->status }}</td>
                                <td>{{ $paper->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="filters">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Paper Status Accepted Revision ReJected</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                 </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="paper_accept_rivision_reject" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Track</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paperAccepted as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>{{ $paper->status }}</td>
                                <td>{{ $paper->created_at }}</td>
                            </tr>
                        @endforeach
                        @foreach($paperRevision as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>{{ $paper->status }}</td>
                                <td>{{ $paper->created_at }}</td>
                            </tr>
                        @endforeach
                        @foreach($paperReJected as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>{{ $paper->status }}</td>
                                <td>{{ $paper->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="filters">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">My Paper List</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="paper_list" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Track</th>
                                <th>Status</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                <th>Send Full Paper</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paperAuthor as $paper)
                            <tr>
                                <td>{{ $paper->id }}</td>
                                <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                <td>{{ $paper->track->name }}</td>
                                <td>
                                    @switch($paper->status)
                                        @case(Config::get('constants.PAPER_STATUS.ACCEPTED'))
                                        <span class="label label-success">Accept Paper</span>
                                        @break
                                        @case(Config::get('constants.PAPER_STATUS.REVISION'))
                                        <span class="label label-info">Revision Paper</span>
                                        @break
                                        @case(Config::get('constants.PAPER_STATUS.REJECTED'))
                                        <span class="label label-danger">Reject Paper</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @foreach($paper->authors as $author)
                                        @if($author->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR'))
                                            <span class="label label-success">{{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }}</span>
                                        @else
                                            <span class="label label-primary">{{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }}</span>
                                        @endif
                                    @endforeach
                                    @include('helper.authors.add_coauthor', ['paper' => $paper, 'conference' => $conference, 'name' => ''])
                                </td>
                                <td>{{ $paper->created_at }}</td>
                                <td>
                                    <a href="{{ route('author_paper_edit', ['conference_id' => $conference->id, 'id' => $paper->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    @if ( $paper->file_id )
                                        <button type="button" data-toggle="modal" data-target="#update_attach_file_{{ $paper->id }}"class="btn btn-success"><i class="fa fa-eye"></i></button>
                                        <div class="modal fade" id="update_attach_file_{{ $paper->id }}" role="dialog">
                                            <form method="post" action="{{ route('author_paper_file_update', ['conference_id' => $conference->id, 'paper_id' => $paper->id, 'id' => $paper->attachFile->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="box-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h3 class="box-title">Update Attach File</h3>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div align="center">
                                                                    <h4>You had sent the file</h4>
                                                                    <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}" class="btn btn-primary"><span class="fa fa-download"></span> {{ $paper->attachFile->original_file_name }}</a>
                                                                    <h4>If you want to modify the file please select the file and save</h4>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                <div align="center">
                                                                    <input type="file" id="attach_file" name="attach_file" accept=".doc, .docx, .pptx, .pdf, .ppt, .zip, .rar">
                                                                    @if ($errors->has('attach_file'))
                                                                        <span class="help-block">{{ $errors->first('attach_file') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div>
                                                                    <h4><strong> Full Paper</strong></h4>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->first('full_paper') ? 'has-error' : ''}}">
                                                                <textarea name="full_paper" class="full_paper form-control" rows="3" placeholder="Enter Full Paper ...">{{ $paper->full_paper }}</textarea>
                                                                @if ($errors->has('full_paper'))
                                                                    <span class="help-block">{{ $errors->first('full_paper') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @else
                                        <button type="button" data-toggle="modal" data-target="#create_attach_file_{{ $paper->id }}"class="btn btn-primary"><i class="fa fa-send-o"></i></button>
                                        <div class="modal fade" id="create_attach_file_{{ $paper->id }}" role="dialog">
                                            <form method="post" action="{{ route('author_paper_file_store', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <div class="box-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h3 class="box-title">Add New Attach File</h3>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                <div align="center">
                                                                    <h3>Select Attach File</h3>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                <div align="center">
                                                                    <input type="file" id="attach_file" name="attach_file" accept=".doc, .docx, .pptx, .pdf, .ppt, .zip, .rar">
                                                                    @if ($errors->has('attach_file'))
                                                                        <span class="help-block">{{ $errors->first('attach_file') }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div>
                                                                    <h4><strong> Full Paper</strong></h4>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->first('full_paper') ? 'has-error' : ''}}">
                                                                <textarea name="full_paper" class="full_paper form-control" rows="3" placeholder="Enter full_paper ...">{{ $paper->full_paper }}</textarea>
                                                                @if ($errors->has('full_paper'))
                                                                    <span class="help-block">{{ $errors->first('full_paper') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="filters">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="box box-gray">
            <div class="box-header with-border">
                <h3 class="box-title">Reviewer</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-4 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ count($paperReviewerNoAnswer) }}</h3>
                                <p>No Answer</p>
                            </div>
                            <div class="icon">
                              <i class="fa fa-newspaper-o"></i>
                            </div>
                            <a href="{{ route('admin_paper_list', ['id'=>$conference->id]) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                   <div class="col-lg-4 col-xs-6">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ count($paperReviewerAccept) }}</h3>
                                <p>Accepted</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ count($paperReviewerReject) }}</h3>
                                <p>Rejected</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('admin/bower_components/canvas-js/src/canvasjs.min.js') }}"></script>
    <script type="text/javascript" src='{{ asset('js/lib/calendar/moment.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('js/lib/calendar/fullcalendar.min.js') }}'></script>
    <script type="text/javascript" src="{{ asset('js/admin/calendar/calendarConference.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/conference/view.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/author/list.js') }}"></script>
@endsection
