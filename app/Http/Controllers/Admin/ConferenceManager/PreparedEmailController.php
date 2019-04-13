<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\PreparedEmailRepository;
use App\ConferenceRepositories\ReviewAssignmentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PreparedEmailController extends BaseConferenceController
{
    /**
     * @param $conferenceId
     * @param $reviewAssignmentId
     * @param PreparedEmailRepository $preparedEmailRepository
     * @param ReviewAssignmentRepository $reviewAssignmentRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showReviewerRequest($conferenceId, $reviewAssignmentId, PreparedEmailRepository $preparedEmailRepository, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        $reviewAssignment = $reviewAssignmentRepository->find($reviewAssignmentId);
        $emailReviewerRequest = $preparedEmailRepository->findEmailKey('REVIEW_REQUEST');
        if (!$emailReviewerRequest) {
            return redirect()->back()->with('error', 'please create prepared email has email key: REVIEW_REQUEST');
        }
        $reviewerName = $reviewAssignment->reviewer->full_name;
        $paperTitle = $reviewAssignment->paper->title;
        $conferenceName = $this->conference->title;
        $emailReviewerRequest->body = str_replace(
            ['{$reviewerName}', '{$paperTitle}', '{$conferenceName}'],
            [$reviewerName, $paperTitle, $conferenceName],
            $emailReviewerRequest->body);
        return view('layouts.admin.conference_manager.prepared_email.show', [
            'emailReviewerRequest' => $emailReviewerRequest,
            'reviewAssignment' => $reviewAssignment
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
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $reviewAssignmentRepository->find($reviewAssignmentId);
        //SEND MAIL
        Mail::send([], [], function ($message) use ($data){
           $message->from($data['email_from'])
               ->to($data['email_to'])
               ->subject($data['email_subject'])
               ->setBody($data['email_body'], 'text/html');
        });
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
}
