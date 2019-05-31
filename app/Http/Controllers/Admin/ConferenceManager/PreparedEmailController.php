<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\PreparedEmailRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Models\PreparedEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PreparedEmailController extends BaseConferenceController
{
    public function index()
    {
        $preparedEmails = PreparedEmail::all();
        return view('layouts.admin.prepare_email.list', ['emails' => $preparedEmails]);
    }

    /**
     * @param $conferenceId
     * @param $emailId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $emailId)
    {
        $preparedEmail = PreparedEmail::find($emailId);
        return view('layouts.admin.prepare_email.edit', ['email' => $preparedEmail]);
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @param $emailId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $conferenceId, $emailId)
    {
        $this->validate($request, [
            'email_key' => 'required',
            'subject' => 'required',
        ]);
        $preparedEmail = PreparedEmail::find($emailId);
        $preparedEmail->email_key = $request->email_key;
        $preparedEmail->subject = $request->subject;
        $preparedEmail->body = $request->body;
        $preparedEmail->save();
        return redirect()->route('admin_prepared_email_list', ['conference_id' => $this->conferenceId])->with('success', 'Update Prepared Email Successful !');
    }

    /**
     * @param $conferenceId
     * @param $reviewAssignmentId
     * @param PreparedEmailRepository $preparedEmailRepository
     * @param ReviewAssignmentRepository $reviewAssignmentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReviewerRequest(Request $request,$conferenceId, $reviewAssignmentId, PreparedEmailRepository $preparedEmailRepository, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        $this->authorize('view-prepair-email');
        $reviewAssignment = $reviewAssignmentRepository->find($reviewAssignmentId);
        if ($request->email_key == 'REVIEW_REQUEST') {
            $emailReviewerRequest = $preparedEmailRepository->findEmailKey('REVIEW_REQUEST');
        }
        if ($request->email_key == 'REVIEW_REMIND') {
            $emailReviewerRequest = $preparedEmailRepository->findEmailKey('REVIEW_REMIND');
        }
        if (!$emailReviewerRequest) {
            return redirect()->back()->with('error', 'please create prepared email has email key:' . $request->email_key);
        }
        $reviewerName = $reviewAssignment->reviewer->full_name;
        $paper = $reviewAssignment->paper;
        $paperTitle = $paper->title;
        $conferenceName = $this->conference->title;
        $emailReviewerRequest->body = str_replace(
            [
                '{$reviewerName}',
                '{$paperTitle}',
                '{$conferenceName}',
                '{$reviewerOpened}',
                '{$reviewDeadline}',
                '{$conferenceUrl}',
                '{$submissionReviewUrl}',
                '{$paperAbstract}',
            ],
            [
                $reviewerName,
                $paperTitle,
                $conferenceName,
                date('d/m/Y',strtotime($this->conference->timeline->reviewer_registration_opened)),
                date('d/m/Y',strtotime($reviewAssignment->date_due)),
                route('conference_home', ['conference_path' => $this->conference->path]),
                route('reviewer_do_review', ['conference_id' => $this->conferenceId, 'paper_id' => $paper->id]),
                $paper->abstract
            ],
            $emailReviewerRequest->body
        );
        $emailTemplate = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'to' => $reviewAssignment->reviewer->email,
            'subject' => $emailReviewerRequest->subject,
            'body' => $emailReviewerRequest->body,
            'form_url' => route('email_reviewer_store', ['conference_id' => $this->conferenceId, 'review_assignment_id' => $reviewAssignment->id]),
        ];
        return view('layouts.admin.conference_manager.prepared_email.show', [
            'emailTemplate' => $emailTemplate,
        ]);
    }

    /**
     * @param $conferenceId
     * @param $reviewAssignmentId
     * @param Request $request
     * @param ReviewAssignmentRepository $reviewAssignmentRepository
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeReviewerRequest($conferenceId, $reviewAssignmentId, Request $request, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        $this->authorize('send-prepair-email');
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $reviewAssignmentRepository->find($reviewAssignmentId);
        $this->sendMail($data);
        // EMAIL LOG
        #code
        // UPDATE Date notified
        $reviewAssignment->date_notified = Carbon::now();
        $reviewAssignment->save();
        return redirect()
            ->route('admin_paper_submission', [
                'conference_id' => $this->conferenceId,
                'paper_id' => $reviewAssignment->paper_id
            ])->with('success', 'Send Mail successful !');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'email_from' => 'required',
            'email_to' => 'required',
            'email_subject' => 'required',
            'email_body' => 'required',
        ]);
    }

    public function showDecidedForm(Request $request, $conferenceId, $paperId, PreparedEmailRepository $preparedEmailRepository, PaperRepository $paperRepository)
    {
        $paper = $paperRepository->find($paperId);
        $preparedEmail = $preparedEmailRepository->findEmailKey($request->email_key);
        if (!$preparedEmail) {
            return redirect()->back()->with('error', 'please create prepared email has email key:' . $request->email_key);
        }
        $preparedEmail->body = str_replace(
            [
                '{$authorName}',
                '{$paperTitle}',
                '{$conferenceName}',
                '{$conferenceStartTime}',
                '{$conferenceEndTime}',
                '{$conferenceVenue}',
            ],
            [
                $paper->authors->where('seq', 0)->first()->full_name,
                $paper->title,
                $this->conference->title,
                $this->conference->start_time,
                $this->conference->end_time,
                $this->conference->venue,
            ],
            $preparedEmail->body
        );
        $authorPrimary = $paper->authors()->where('seq', 0)->first();
        $emailTemplate = [
            'from' => env('MAIL_FROM_ADDRESS'),
            'to' => $authorPrimary->email,
            'subject' => $preparedEmail->subject,
            'body' => $preparedEmail->body,
            'form_url' => route('email_author_store', ['conference_id' => $this->conferenceId, 'paper_id' => $paper->id])
        ];
        return view('layouts.admin.conference_manager.prepared_email.show', [
            'emailTemplate' => $emailTemplate,
        ]);
    }

    public function storeDecidedForm(Request $request,$conferenceId, $paperId, PreparedEmailRepository $preparedEmailRepository, PaperRepository $paperRepository)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $this->sendMail($data);

        return redirect()->route('admin_paper_submission', [
                'conference_id' => $this->conferenceId,
                'paper_id' => $paperId,
            ])->with('success', 'Send Mail successful !');
    }

    /**
     * @param array $data
     */
    public function sendMail(array $data) {
        //SEND MAIL
        Mail::send([], [], function ($message) use ($data){
            $message->from($data['email_from'])
                ->to($data['email_to'])
                ->subject($data['email_subject'])
                ->setBody($data['email_body'], 'text/html');
        });
    }
}
