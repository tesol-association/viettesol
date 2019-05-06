<?php

namespace App\Http\Controllers\Admin\ConferenceManager;

use App\ConferenceRepositories\ConferenceRoleRepository;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class ProceedingController extends BaseConferenceController
{
    public function exportPDF($conferenceId, ConferenceRoleRepository $conferenceRoleRepository)
    {
        $trackDirectors = $conferenceRoleRepository->getTrackDirectors($conferenceId);
        $reviewers = $conferenceRoleRepository->getReviewers($conferenceId);
        $directors = $conferenceRoleRepository->getDirectors($conferenceId);
        $authors = $conferenceRoleRepository->getAuthors($conferenceId);
        $timeLine = $this->conference->timeline;
//        return view('proceeding.template_01', [
//            'trackDirectors' => $trackDirectors,
//            'reviewers' => $reviewers,
//            'directors' => $directors,
//            'authors' => $authors,
//            'timeLine' => $timeLine,
//        ]);
        $pdf = PDF::loadView('proceeding.template_01', [
            'trackDirectors' => $trackDirectors,
            'reviewers' => $reviewers,
            'directors' => $directors,
            'authors' => $authors,
            'timeLine' => $timeLine,
        ]);
        return $pdf->download('proceeding_'. $this->conference->title .'.pdf');
    }
}
