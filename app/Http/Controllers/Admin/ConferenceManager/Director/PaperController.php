<?php

namespace App\Http\Controllers\Admin\ConferenceManager\Director;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use App\ConferenceRepositories\PaperRepository;
use Illuminate\Support\Facades\Config;

class PaperController extends BaseConferenceController
{
    protected $papers;
    public function __construct(Request $request, PaperRepository $paperRepository)
    {
        parent::__construct($request);
        $this->papers = $paperRepository;
    }


    public function showPaperUnSchedule()
    {
        $paperResults = $this->papers->get($this->conferenceId, ['status' => [Config::get('constants.PAPER_STATUS.ACCEPTED'), Config::get('constants.PAPER_STATUS.REJECTED'), Config::get('constants.PAPER_STATUS.REVISION')]]);
        $paperUnschedules = $this->papers->get($this->conferenceId, ['status' => [Config::get('constants.PAPER_STATUS.UNSCHEDULED')]]);
        return view('director.paper.show_paper_un_schedule', [
            'paperResults'=> $paperResults,
            'paperUnschedules'=> $paperUnschedules,
        ]);
    }


    public function changePaperStatus(Request $request, $conferenceId, $paperId)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $paper = $this->papers->find($paperId);
            $paper->status = Config::get('constants.PAPER_STATUS.UNSCHEDULED');
            $paper->save();
            return $paper;
        }
        return null;
    }

    public function changeRedoPaperStatus(Request $request, $conferenceId, $paperId)
    {
        if ($request->ajax()) {
            $trackDicision = $this->papers->getTrackDecisions($paperId)->first();
            $paper = $this->papers->find($paperId);
            switch ($trackDicision->decision) {
                case (Config::get('constants.PAPER.ACCEPTED')):
                    $paper->status = Config::get('constants.PAPER_STATUS.ACCEPTED');
                    break;
                case (Config::get('constants.PAPER.REVISION')):
                    $paper->status = Config::get('constants.PAPER_STATUS.ACCEPTED');
                    break;
                case (Config::get('constants.PAPER.REJECTED')):
                    $paper->status = Config::get('constants.PAPER_STATUS.ACCEPTED');
                    break;
            }
            $paper->save();
            return $paper;
        }
        return null;
    }
}
