<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\TrackRepository;
use App\ConferenceRepositories\PaperRepository;

class PaperFileManagerController extends BaseConferenceController
{
    protected $tracks;
    protected $papers;
    public function __construct(Request $request, TrackRepository $trackRepository, PaperRepository $paperRepository)
    {
        parent::__construct($request);
        $this->tracks = $trackRepository;
        $this->papers = $paperRepository;
    }

    public function show()
    {
        $this->authorize('view-paper-file');
        $tracks = $this->tracks->get(['conference_id' => $this->conferenceId]);
        return view('layouts.admin.conference_manager.paper_file_manager.view', ['tracks' => $tracks]);
    }

    public function getTrack()
    {
        $tracks = $this->tracks->get(['conference_id' => $this->conferenceId]);
        return $tracks;
    }

    public function getPaperOfTrack($conferenceId, $trackId)
    {
        $papers = $this->tracks->find($trackId)->papers;
        return $papers;
    }

    public function getAuthorOfPaperOfTrack($conferenceId, $trackId, $paperId)
    {
        $authors = $this->papers->find($paperId)->authors;
        return $authors;
    }

    public function getReviewerOfPaperOfTrack($conferenceId, $trackId, $paperId)
    {
        $reviewers = $this->papers->find($paperId)->reviewers;
        return $reviewers;
    }

    public function getAuthorFile($conferenceId, $trackId, $paperId, $authorId)
    {
        $attachFile[] = $this->papers->find($paperId)->attachFile;
        if(!empty($attachFile))
            return $attachFile;
        return null;
    }

    public function getReviewerFile($conferenceId, $trackId, $paperId, $reviewerId)
    {
        $reviewAssignments = $this->papers->find($paperId)->reviewAssignment;
        foreach ($reviewAssignments as $reviewAssignment) {
            if($reviewAssignment->reviewer_id == $reviewerId){
                $attachFile[] = $reviewAssignment->attachFile;
                return $attachFile;
            }
        }
        return null;
    }
}
