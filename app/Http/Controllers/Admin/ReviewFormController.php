<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceRepositories\ReviewFormRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReviewFormController extends BaseConferenceController
{
    protected $reviewForms;
    public function __construct(Request $request, ReviewFormRepository $reviewFormRepository)
    {
        parent::__construct($request);
        $this->reviewForms = $reviewFormRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view-review-form');
        $reviewForms = $this->reviewForms->all();
        return view('layouts.admin.review_form.list', [
            'reviewForms'=> $reviewForms
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create-review-form');
        return view('layouts.admin.review_form.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create-review-form');
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_review_form_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewForm = $this->reviewForms->create($request->all());
        return redirect()->route('admin_review_form_list', ['id' => $this->conferenceId])->with('success', 'Create ' . $reviewForm->name . ' successful !');
    }

    /**
     * @param $conferenceId
     * @param $reviewFormId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($conferenceId, $reviewFormId)
    {
        $this->authorize('update-review-form');
        $reviewForm = $this->reviewForms->find($reviewFormId);
        return view('layouts.admin.review_form.edit', ['reviewForm' => $reviewForm]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $conferenceId, $reviewFormId)
    {
        $this->authorize('update-review-form');
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_review_form_create', ['conference_id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $reviewForm = $this->reviewForms->update($reviewFormId, $request->all());
        return redirect()->route('admin_review_form_list', ['id' => $this->conferenceId])->with('success', 'Update ' . $reviewForm->name . ' successful !');
    }

    public function destroy($conferenceId, $reviewFormId)
    {
        $reviewForm = $this->reviewForms->destroy($reviewFormId);
        return redirect()->route('admin_review_form_list', ['conference_id' => $this->conferenceId])->with('success', 'Delete ' . $reviewForm->name . ' successful !');
    }
    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'status' => ["required", Rule::in(["active", "inactive"])],
        ]);
    }
}
