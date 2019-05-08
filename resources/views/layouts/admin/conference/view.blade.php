@extends('layouts.admin.conference_layout')
@section('title','Dashboard Conferences')
@section('css')
    <link href='{{ asset('css/calendar/fullcalendar.min.css') }}' rel='stylesheet' />
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
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
</section>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('admin/bower_components/canvas-js/src/canvasjs.min.js') }}"></script>
    <script type="text/javascript" src='{{ asset('js/lib/calendar/moment.min.js') }}'></script>
    <script type="text/javascript" src='{{ asset('js/lib/calendar/fullcalendar.min.js') }}'></script>
    <script type="text/javascript" src="{{ asset('js/admin/calendar/calendarConference.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/conference/view.js') }}"></script>
@endsection
