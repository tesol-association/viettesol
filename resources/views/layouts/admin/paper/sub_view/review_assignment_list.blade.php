<!-- Start: Review Assignment List-->
<div class="box box-info">
    <div class="box-header with-border">
        <div class="col-md-4">
            <h3 class="box-title">Review Assignment</h3>
        </div>
        <div class="col-md-2 col-md-offset-6">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#assign_reviewer"><i class="fa fa-plus"></i> Assign to Reviewer</button>
            <!-- Start:: Assign a Reviewer-->
            <div class="modal fade" id="assign_reviewer" role="dialog">
                <form method="post" action="{{ route('admin_review_assignment_store', [ "conference_id" => $conference->id, 'paper_id'=> $paper->id ]) }}">
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
            <!-- End:: Assign a Reviewer-->
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
                        <td>{{ $reviewAssignment->reviewer->full_name }}</td>
                        <td>{{ date('H:i d/m/Y',strtotime($reviewAssignment->date_assigned)) }}</td>
                        <td>
                            @if ($reviewAssignment->date_notified)
                                <i class="fa fa-check-circle"></i> Sented At {{ date('H:i d/m/Y',strtotime($reviewAssignment->date_notified)) }}
                            @else
                                <a href="{{ route('email_reviewer_request_show', ['conference_id' => $conference->id, 'review_assignment_id' => $reviewAssignment->id]) }}">
                                    <i class="fa fa-envelope-o"> Send</i>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($reviewAssignment->date_due)
                                <span data-toggle="modal" data-target="#change_date_due{{ $reviewAssignment->id }}">{{ date('d/m/Y',strtotime($reviewAssignment->date_due)) }}</span>
                            @else
                                <span data-toggle="modal" data-target="#change_date_due{{ $reviewAssignment->id }}">___</span>
                            @endif
                            <!-- Start:: Change Date Due For Review Assignment -->
                                <div class="modal" id="change_date_due{{ $reviewAssignment->id }}" role="dialog">
                                    <form method="post" action="{{ route('track_director_review_assignment_change_date', ['conference_id' => $conference->id, 'paper_id' => $paper->id, 'review_assignment_id' => $reviewAssignment->id]) }}">
                                        @csrf
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Change Deadline for Assignment</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="review_deadline">Review Deadline:</label>
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <input type="text" required class="review_deadline form-control pull-right" name="date_due" value="{{ $reviewAssignment->date_due }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End:: Change Date Due For Review Assignment -->
                        </td>
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
                        <td>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_assignment_{{ $reviewAssignment->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <!-- Start:: Delete Review Assignment -->
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
                    <!-- End:: Delete Review Assignment -->
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
