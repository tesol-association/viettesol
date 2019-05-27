<?php

namespace App\Http\Controllers\Admin\ConferenceManager\Author;

use App\ConferenceRepositories\AuthorRepository;
use App\Events\PaperEvent\AddCoAuthor;
use App\Events\PaperEvent\PaperEditSubmissioned;
use App\Events\PaperEvent\PaperSubmitted;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\Models\Author;
use App\ConferenceRepositories\PaperRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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

    public function listPaper()
    {
        $papers = $this->papers->get($this->conferenceId, ['submission_by' => Auth::id()]);
        return view('author.paper.list', [
            'papers'=> $papers
        ]);
    }

    public function sendPaper()
    {
        $this->authorize('send-paper');
        $tracks = $this->conference->tracks;
        $sessionTypes = $this->conference->sessionTypes;
        $author = Auth::user();
        $sugguestKeywords = [];
        foreach ($this->conference->tracks as $track) {
            if (is_array($track->keywords)) {
                $sugguestKeywords = array_merge($sugguestKeywords, $track->keywords);
            }
        }
        $sugguestKeywords = array_unique($sugguestKeywords);
        return view('author.paper.create', [
            'tracks' => $tracks,
            'sessionTypes' => $sessionTypes,
            'author' => $author,
            'sugguestKeywords' => $sugguestKeywords
        ]);
    }

    public function savePaper(Request $request)
    {
        $this->authorize('send-paper');
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $authorData = $request->author;
        $paperData = $request->paper;
        $paper = $this->papers->createSubmittedPaper($paperData);
        event(new PaperSubmitted($paper));
        $author = Author::where('email', $authorData['email'])->first();
        if (empty($author)) {
            $author = $this->authors->create($authorData);
        }
        $author->papers()->attach($paper->id, ['seq' => Config::get('constants.PAPER_AUTHOR.AUTHOR')]);
        return redirect()->route('author_paper_list', ["conference_id" => $this->conferenceId])->with('success', 'Submission ' . $paper->title . ' successful !');
    }

    public function editPaper(Request $request,$conferenceId, $id)
    {
        $paper = $this->papers->find($id);
        $this->authorize('update-paper', $paper);
        $tracks = $this->conference->tracks;
        $sessionTypes = $this->conference->sessionTypes;
        return view('author.paper.edit', [
            'paper' => $paper,
            'tracks' => $tracks,
            'sessionTypes' => $sessionTypes,
        ]);
    }

    public function updatePaper(Request $request, $conferenceId, $id)
    {
        $paper = $this->papers->find($id);
        $this->authorize('update-paper', $paper);
        $request->validate([
            'paper.title' => 'required',
            'paper.abstract' => 'required',
        ]);
        $paper = $this->papers->updatePaper($request->paper, $id);
        event(new PaperEditSubmissioned($paper));
        return redirect()->route('author_paper_list', ["conference_id" => $this->conferenceId])->with('success', 'Updated ' . $paper->title . ' successful !');
    }

    public function addCoAuthor(Request $request, $conferenceId, $id)
    {
        $paper = $this->papers->find($id);
        $this->authorize('update-paper', $paper);
        $author = $this->authors->create($request->all());

        $author->papers()->attach($id, ['seq' => Config::get('constants.PAPER_AUTHOR.CO_AUTHOR')]);
        event(new AddCoAuthor($paper, $author));

        return redirect()->back()->with('success', 'Added '.$author->full_name .' for paper '.$paper->title.' successful !');
    }

    public function deleteCoAuthor($conferenceId, $authorId, $id)
    {
        $paper = $this->papers->find($id);
        $this->authorize('update-paper', $paper);
        $paper->authors()->detach($authorId);
        $this->authors->destroy($authorId);

        return redirect()->back()->with('success', 'Deleted co author for paper '.$paper->title.' successful !');
    }

    public function updateAuthor(Request $request, $conferenceId, $authorId, $id)
    {
        $author = $this->authors->update($authorId, $request->all());

        return redirect()->back()->with('success', 'Updated '.$author->first_name.' '.$author->middle_name.' '.$author->last_name.' information successful !');
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
            'author.first_name' => 'required',
            'author.last_name' => 'required',
            'author.email' => 'required',
            'author.affiliation' => 'required',
        ]);
    }
}
