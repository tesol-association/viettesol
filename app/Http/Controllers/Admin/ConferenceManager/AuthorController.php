<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\PaperRepository;
use App\ConferenceRepositories\AuthorRepository;
use App\Models\User;

class AuthorController extends BaseConferenceController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferenceId = $this->conferenceId;
        $papers = $this->papers->get($conferenceId);
        $users = User::all();
        foreach ($users as $user) {
            $users->emailAuthor = $user->pluck('email')->all();
        }
        return view('layouts.admin.conference_manager.author.paper.list', [
            'papers'=> $papers,
            'users'=> $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($conferenceId, $id)
    {
        $paper = $this->papers->find($id);
        return view('layouts.admin.conference_manager.author.paper.view', ['paper'=> $paper]);
    }

    public function showAuthor($conferenceId, $id)
    {
        $author = $this->authors->find($id);
        if (!empty($author)) {
            $users = User::all();
            foreach ($users as $user) {
                if ($author->email == $user->email) {
                    $submissionId = $user->id;
                    break;
                }
            }
            if (!empty($submissionId)){
                $papers = $this->papers->get($conferenceId,['submission_by' => $submissionId]);
            }else{
                $papers = null;
            }
            return view('layouts.admin.conference_manager.author.view', ['author'=> $author, 'papers'=>$papers]);
        }else{
            return  redirect()->back()->with('error', 'No Information');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
