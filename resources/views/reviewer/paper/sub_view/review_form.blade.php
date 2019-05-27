<!-- Start: Review Form for reviewer-->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">DO REVIEW</h3>
    </div>
    <!-- form start -->
    <form role="form" method="POST" action="{{ route('reviewer_store_assignment', ['conference_id' => $conference->id, 'assignment_id' => $reviewAssignment->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="box-body">
                @if (isset($reviewAssignment->date_confirmed) && $reviewAssignment->declined == Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT'))
                    @foreach ($reviewForm->criteriaReviews as $criteriaReview)
                        <div class="form-group">
                            <label>{{ $criteriaReview->name }}</label>
                            @if ($reviewAssignment->date_completed)
                                <select disabled class="form-control">
                                    <option selected>{{ $reviewAssignment->reviewer_response[$criteriaReview->name] }}</option>
                                </select>
                            @else
                                <select name="review_form[{{ $criteriaReview->name }}]" class="form-control">
                                    @if (isset($criteriaReview->possible_values) && count($criteriaReview->possible_values))
                                        @foreach($criteriaReview->possible_values as $possibleValue)
                                            <option value="{{ $possibleValue }}">{{ $possibleValue }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif
                        </div>
                    @endforeach
                @endif
                <div class="form-group">
                    <label for="total">Total*
                        @if ($reviewAssignment->date_completed)
                            <input id="total" type="text" class="form-control" placeholder="Enter Total" name="total" value="{{ $reviewAssignment->total }}" disabled>
                        @else
                            <input id="total" type="text" class="form-control" placeholder="Enter Total" name="total" required="" value="{{ old('total') }}">
                    @endif
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    @if ($reviewAssignment->date_completed)
                        <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter comment ..." disabled>{{ $reviewAssignment->comment }}</textarea>
                    @else
                        <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Enter comment ...">{{ old('comment') }}</textarea>
                    @endif
                </div>
                <div class="form-group">
                    @if ($reviewAssignment->date_completed)
                        @if ($reviewAssignment->attachFile)
                        <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                        @endif
                    @else
                        <input type="file" id="upload_file" name="upload_file">
                    @endif
                </div>
                <div class="form-group">
                    <label for="recommendation">Recommendation</label>
                    @if ($reviewAssignment->date_completed)
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
                    @else
                        <select name="recommendation" class="form-control" title="Choose One" required>
                            <option value=""></option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.ACCEPTED_ASSIGNMENT') }}">Accept Paper</option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.REVISION_RECOMMENDATION') }}">Revision Paper</option>
                            <option value="{{ Config::get('constants.REVIEW_ASSIGNMENT.REJECTED_ASSIGNMENT') }}">Reject Paper</option>
                        </select>
                    @endif
                </div>
            </div>
        </div>
        @if (!$reviewAssignment->date_completed)
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        @endif
    </form>
</div>
<!-- End: Review Form for reviewer-->
