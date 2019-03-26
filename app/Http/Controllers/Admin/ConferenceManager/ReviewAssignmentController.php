<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\ReviewAssignmentRepository;
use App\Models\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewAssignmentController extends BaseConferenceController
{
    protected $reviewAssignments;
    public function __construct(Request $request, ReviewAssignmentRepository $reviewAssignmentRepository)
    {
        parent::__construct($request);
        $this->reviewAssignments = $reviewAssignmentRepository;
    }

    public function index()
    {
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request, $conferenceId, $paperId)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_paper_submission', ['conference_id' => $this->conferenceId, 'paper_id' => $paperId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewAssignment = $this->reviewAssignments->assignReviewer($data);
        return redirect()->route('admin_paper_submission', ['conference_id' => $this->conferenceId, 'paper_id' => $paperId])->with('success', 'Assign Reviewer ' . $reviewAssignment->reviewer->first_name . ' ' . $reviewAssignment->reviewer->last_name . ' successful !');
    }

    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'paper_id' => 'required|numeric',
            'reviewer_id' => 'required|numeric',
        ]);
    }
}
