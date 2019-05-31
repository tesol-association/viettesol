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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#history">
                        <i class="fa fa-history"></i> history
                    </button>
                    <span id="send_mail_author" data-link="{{ route('email_author_show', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) }}">
                        @if ($trackDecision = $trackDecisions->first())
                            @switch($trackDecision->decision)
                                @case(Config::get('constants.PAPER.ACCEPTED'))
                                <a href="{{ route('email_author_show', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) . '?email_key=SUBMISSION_PAPER_ACCEPT' }}"><button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button></a>
                                @break
                                @case(Config::get('constants.PAPER.REVISION'))
                                <a href="{{ route('email_author_show', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) . '?email_key=SUBMISSION_ABSTRACT_REVISE' }}"><button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button></a>
                                @break
                                @case(Config::get('constants.PAPER.REJECTED'))
                                <a href="{{ route('email_author_show', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) . '?email_key=SUBMISSION_ABSTRACT_DECLINE' }}"><button class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button></a>
                                @break
                            @endswitch
                        @endif
                    </span>
                    <div class="modal fade" id="history" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h3>History</h3>
                                </div>
                                <div class="modal-body" id="edit_decision_histories">
                                    @foreach($trackDecisions as $trackDecision)
                                        <p>
                                            @switch($trackDecision->decision)
                                                @case(Config::get('constants.PAPER.ACCEPTED'))
                                                <span id="last_decided" class="text-green">Accepted At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->user_name }} </span>
                                                @break
                                                @case(Config::get('constants.PAPER.REVISION'))
                                                <span id="last_decided" class="text-yellow">Revision At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->user_name }} </span>
                                                @break
                                                @case(Config::get('constants.PAPER.REJECTED'))
                                                <span id="last_decided" class="text-red">Rejected At {{ $trackDecision->date_decided }} By {{ $trackDecision->user->user_name }} </span>
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
                </span>
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
