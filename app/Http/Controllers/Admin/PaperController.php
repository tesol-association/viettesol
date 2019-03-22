<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceRepositories\AuthorRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Author;
use App\Models\PaperAuthor;
use App\ConferenceRepositories\PaperRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaperController extends BaseConferenceController
{
    protected $papers;
    protected $authors;
    public function __construct(Request $request, PaperRepository $paperRepository, AuthorRepository $authorRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
        $this->authors = $authorRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conferenceId = $this->conferenceId;
        $papers = $this->papers->get($conferenceId);
        return view('layouts.admin.paper.list', [
            'papers'=> $papers
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tracks = $this->conference->tracks;
        $sessionTypes = $this->conference->sessionTypes;
        $author = Auth::user();
        return view('layouts.admin.paper.create', [
            'tracks' => $tracks,
            'sessionTypes' => $sessionTypes,
            'author' => $author
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_paper_create', ['id' => $this->conferenceId])
                ->withErrors($validator)
                ->withInput();
        }
        $authorDatas = $request->authors;
        $paperData = $request->paper;
        $paper = $this->papers->createSubmittedPaper($paperData);
        foreach ($authorDatas as $seq => $authorData) {
            $author = Author::where('email', $authorData['email'])->first();
            if (empty($author)) {
                $author = $this->authors->create($authorData);
            }
            $paperAuthor = new PaperAuthor();
            $paperAuthor->paper_id = $paper->id;
            $paperAuthor->author_id = $author->id;
            $paperAuthor->seq = $seq;
            $paperAuthor->save();
        }
        return redirect()->route('admin_paper_list', ["conference_id" => $this->conferenceId])->with('success', 'Submission ' . $paper->title . ' successful !');
    }

    public function submission($conferenceId, $paperId)
    {
        $paper = $this->papers->find($paperId);
        return view('layouts.admin.paper.submission', [
            'paper' => $paper
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'paper.track_id' => 'required|numeric',
            'paper.session_type_id' => 'required|numeric',
            'paper.title' => 'required',
            'paper.abstract' => 'required',
            'authors.*.first_name' => 'required',
            'authors.*.last_name' => 'required',
            'authors.*.email' => 'required',
            'authors.*.affiliation' => 'required',
        ]);
    }
}
