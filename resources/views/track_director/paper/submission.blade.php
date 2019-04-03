@extends('layouts.admin.conference_layout')
@section('title','Assign Manager')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('page-header') ABSTRACT REVIEW
@endsection
@section('content')
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#review" data-toggle="tab" aria-expanded="true">REVIEW</a></li>
            <li class=""><a href="#paper_history" data-toggle="tab" aria-expanded="false">HISTORY</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="review">
                <!-- Start: Paper Info-->
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
                        <h3 class="box-title">TITLE AND ABSTRACT</h3>
                    </div>
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>Author</dt>
                            <dd>
                                @foreach($paper->authors as $author)
                                    {{ $author->first_name }} {{ $author->last_name }} ,
                                @endforeach
                            </dd>
                            <dt>Title</dt>
                            <dd>{{ $paper->title }}</dd>
                            <dt>Track</dt>
                            <dd>{{ $paper->track->name }}</dd>
                            <dt>Review Form</dt>
                            <dd>
                                @if($paper->track->review_form_id)
                                    {{ $paper->track->reviewForm->name }}
                                @else
                                    No Review Form
                                @endif
                            </dd>
                            <dt>Session Type</dt>
                            <dd>{{ $paper->sessionType->name }}</dd>
                            <dt>Track Director</dt>
                            <dd>
                                @if (isset($users) && count($users))
                                    @foreach ($users as $user)
                                         {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }},
                                    @endforeach
                                @endif
                            </dd>
                            <dt>Abstract</dt>
                            <dd>{!! $paper->abstract !!}</dd>
                        </dl>
                    </div>
                </div>
                <!-- End: Paper Info-->

                <!-- Start: Review Assignment List-->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Review Assignment</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#assign_reviewer"><i class="fa fa-plus"></i> Assign to Reviewer</button>
                            <!-- Start:: Delete Assignment -->
                            <div class="modal fade" id="assign_reviewer" role="dialog">
                                <form method="post" action="{{ route('track_director_review_assignment_store', [ "conference_id" => $conference->id, 'paper_id'=> $paper->id ]) }}">
                                    @csrf
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Assign to Reviewer</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Choose Reviewer</label>
                                                    <select name="reviewer_id" id="add_reviewer" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                        @foreach($reviewers as $reviewer)
                                                            @if (in_array($reviewer->id, $reviewAssignmentIds))
                                                                <option value="{{ $reviewer->id }}" disabled> {{ $reviewer->first_name }} {{ $reviewer->last_name }} (Assigned)</option>
                                                            @else
                                                                <option value="{{ $reviewer->id }}"> {{ $reviewer->first_name }} {{ $reviewer->last_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    <input name="paper_id" type="hidden" value="{{ $paper->id }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Assign</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End:: Delete Assignment -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="review_form_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Name</th>
                                    <th>Assigned At</th>
                                    <th>Request</th>
                                    <th>Due</th>
                                    <th>Reply</th>
                                    <th>Review Response</th>
                                    <th>Response At</th>
                                    <th>Attach File</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviewAssignments as $index => $reviewAssignment)
                                    <tr>
                                        <td>REVIEWER {{ $INDEX_ASSIGNMENT[$index] }}</td>
                                        <td>{{ $reviewAssignment->reviewer->first_name }} {{ $reviewAssignment->reviewer->last_name }}</td>
                                        <td>{{ date('H:i d/m/Y',strtotime($reviewAssignment->date_assigned))  }}</td>
                                        <td><i class="fa fa-envelope-o"> Send</i></td>
                                        <td></td>
                                        <td>
                                            @if ($reviewAssignment->date_confirmed)
                                                @if ($reviewAssignment->declined)
                                                    <span class="label label-danger"><i class="fa fa-close"></i> Rejected</span>
                                                @else
                                                    <span class="label label-success"><i class="fa fa-check"></i> Accepted</span>
                                                @endif
                                                At <span>{{ date('H:i d/m/Y', strtotime($reviewAssignment->date_confirmed)) }}</span>
                                            @else
                                                <span class="label label-warning"><i class="fa fa-hourglass-o"></i> Not Yet</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reviewAssignment->date_completed)
                                            <span class="label label-info" data-toggle="modal" data-target="#result_{{ $reviewAssignment->id }}"><i class="fa fa-check-square-o"></i> Result</span> At {{ date('H:i d/m/Y', strtotime($reviewAssignment->date_completed)) }}
                                            <!-- Start:: Show result Assignment -->
                                            <div class="modal" id="result_{{ $reviewAssignment->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Result Review</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @if (isset($reviewAssignment->date_confirmed) && $reviewAssignment->declined == Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT'))
                                                                @foreach ($reviewForm->criteriaReviews as $criteriaReview)
                                                                    <div class="form-group">
                                                                        <label>{{ $criteriaReview->name }}</label>
                                                                        <select disabled class="form-control">
                                                                            <option selected>{{ $reviewAssignment->reviewer_response[$criteriaReview->name] }}</option>
                                                                        </select>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="total">Total*
                                                                <input id="total" type="text" class="form-control" placeholder="Enter Total" name="total" value="{{ $reviewAssignment->total }}" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="comment">Comment</label>
                                                                <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter comment ..." disabled>{{ $reviewAssignment->comment }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="upload_file">Upload File</label>
                                                                <input type="file" id="upload_file" name="upload_file" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recommendation">Recommendation</label>
                                                                <div class="form-control">
                                                                    @switch($reviewAssignment->recomendation)
                                                                        @case(Config::get('constants.REVIEW_ASSIGNMENT.ACCEPT_RECOMMENDATION'))
                                                                        <span class="label label-success">Accept Paper</span>
                                                                        @break
                                                                        @case(Config::get('constants.REVIEW_ASSIGNMENT.REVISION_RECOMMENDATION'))
                                                                        <span class="label label-success">Revision Paper</span>
                                                                        @break
                                                                        @case(Config::get('constants.REVIEW_ASSIGNMENT.REJECT_RECOMMENDATION'))
                                                                        <span class="label label-success">Reject Paper</span>
                                                                        @break
                                                                    @endswitch
                                                                    <span>At {{ date('H:i d/m/Y', strtotime($reviewAssignment->date_completed)) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End:: Show result Assignment -->
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reviewAssignment->date_completed)
                                                {{ date('H:i d/m/Y',strtotime($reviewAssignment->date_completed)) }}
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                        {{--<td>--}}
                                            {{--@if ($reviewForm->attach_file)--}}
                                                {{--<a target="_blank" href="{{ asset('/storage/' . $reviewForm->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--@if ($reviewForm->status == 'active')--}}
                                                {{--<span class="label label-success">{{ $reviewForm->status }}</span>--}}
                                            {{--@else--}}
                                                {{--<span class="label label-danger">{{ $reviewForm->status }}</span>--}}
                                            {{--@endif--}}
                                        {{--</td>--}}
                                        {{--<td>{{ $reviewForm->created_at }}</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route('admin_criteria_review_list', ["conference_id" => $conference->id, "review_form_id" => $reviewForm->id]) }}" class="btn btn-info">--}}
                                                {{--<i class="fa fa-eye"></i>--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route('admin_review_form_edit', ["conference_id" => $conference->id, "id" => $reviewForm->id]) }}" class="btn btn-info">--}}
                                                {{--<i class="fa fa-edit"></i>--}}
                                            {{--</a>--}}
                                        {{--</td>--}}
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_assignment_{{ $reviewAssignment->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal" id="delete_assignment_{{ $reviewAssignment->id }}" role="dialog">
                                        <form method="post" action="{{ route('reviewer_delete_assignment', ['conference_id' => $conference->id,'id' => $reviewAssignment->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $reviewAssignment->reviewer->first_name }} {{ $reviewAssignment->reviewer->last_name }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End:: Delete Modal Conference -->
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End: Review Assignment List-->

                <!-- Start: Track Director Decision-->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">DECISION</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-2">
                                <label>Choose One</label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control" id="decision_paper">
                                    <option value="{{ Config::get('constants.PAPER.ACCEPTED') }}">Accept</option>
                                    <option value="{{ Config::get('constants.PAPER.REVISION') }}">Revision</option>
                                    <option value="{{ Config::get('constants.PAPER.REJECTED') }}">Reject</option>
                                </select>
                                <span class="help-block" style="display: inline-block;">
                                    @if ($trackDecision = $trackDecisions->first())
                                        @switch($trackDecision->decision)
                                            @case(Config::get('constants.PAPER.ACCEPTED'))
                                            <span id="last_decided" class="text-green">Accepted At {{ $trackDecision->date_decided }}</span>
                                            @break
                                            @case(Config::get('constants.PAPER.REVISION'))
                                            <span id="last_decided" class="text-yellow">Revision At {{ $trackDecision->date_decided }}</span>
                                            @break
                                            @case(Config::get('constants.PAPER.REJECTED'))
                                            <span id="last_decided" class="text-red">Rejected At {{ $trackDecision->date_decided }}</span>
                                            @break
                                        @endswitch
                                    @else
                                        <span id="last_decided"></span>
                                    @endif
                                    @if (count($trackDecisions) > 1)
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#history">
                                            <i class="fa fa-history"></i> history
                                        </button>
                                        <div class="modal fade" id="history" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h3>History</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach($trackDecisions as $trackDecision)
                                                            <p>
                                                                @switch($trackDecision->decision)
                                                                    @case(Config::get('constants.PAPER.ACCEPTED'))
                                                                    <span id="last_decided" class="text-green">Accepted At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->first_name }} {{ $trackDecision->user->middle_name }} {{ $trackDecision->user->last_name }} </span>
                                                                    @break
                                                                    @case(Config::get('constants.PAPER.REVISION'))
                                                                    <span id="last_decided" class="text-yellow">Revision At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->first_name }} {{ $trackDecision->user->middle_name }} {{ $trackDecision->user->last_name }}</span>
                                                                    @break
                                                                    @case(Config::get('constants.PAPER.REJECTED'))
                                                                    <span id="last_decided" class="text-red">Rejected At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->first_name }} {{ $trackDecision->user->middle_name }} {{ $trackDecision->user->last_name }}</span>
                                                                    @break
                                                                @endswitch
                                                            </p>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </span>
                                {{--@foreach ($trackDecisions as $trackDecision)--}}
                                    {{--@switch($trackDecision->decision)--}}
                                        {{--@case(Config::get('constants.PAPER.ACCEPTED'))--}}
                                            {{--<p class="text-green">Accepted At {{ $trackDecision->date_decided }}</p>--}}
                                            {{--@break--}}
                                        {{--@case(Config::get('constants.PAPER.REVISION'))--}}
                                            {{--<p class="text-yellow">Revision At {{ $trackDecision->date_decided }}</p>--}}
                                            {{--@break--}}
                                        {{--@case(Config::get('constants.PAPER.REJECTED'))--}}
                                            {{--<p class="text-red">Rejected At {{ $trackDecision->date_decided }}</p>--}}
                                            {{--@break--}}
                                    {{--@endswitch--}}
                                {{--@endforeach--}}
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="record_decision"
                                        data-track_director_id="{{ Auth::id() }}"
                                        data-conference_id="{{ $conference->id }}"
                                        data-paper_id="{{ $paper->id }}">
                                    <i class="fa fa-send"></i> Record</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Track Director Decision-->
            </div>
            <!-- start::HISTORY PAPER -->
            <div class="tab-pane" id="paper_history">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
            </div>
            <!-- end::HISTORY PAPER -->
        </div>
        <!-- /.tab-content -->
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/track_director/paper/submission.js') }}"></script>
@endsection
