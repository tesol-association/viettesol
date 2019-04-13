<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/19/2019
 * Time: 10:33 AM
 */

namespace App\ConferenceRepositories;

use App\Models\Paper;
use App\Models\TrackDecision;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PaperRepository
{
    public function find($paperId)
    {
        $paper = Paper::with('track.users', 'sessionType', 'authors', 'attachFile')->where('id', $paperId)->first();
        if ($paper->track) {
            $paper->track->load('reviewForm.criteriaReviews');
        }
        return $paper;
    }

    public function get($conferenceId, array $filters = null)
    {
        if (empty($filters)) {
            $papers = Paper::with('track.conference')->get();
        } else {
            $papersQuery = Paper::with('track.conference');
            foreach ($filters as $key => $filter) {
                if (is_array($filter)) {
                    $papersQuery->whereIn($key, $filter);
                } else {
                    $papersQuery->where($key, '=', $filter);
                }
            }
            $papers = $papersQuery->get();
        }
        $papers = $papers->filter(function($paper) use ($conferenceId) {
            return $paper->track->conference->id == $conferenceId;
        });
        return $papers->all();
    }

    public function createSubmittedPaper(array $data)
    {
        $paper = new Paper();
        $paper->title = $data['title'];
        $paper->abstract = $data['abstract'];
        $paper->track_id = $data['track_id'];
        $paper->session_type_id = $data['session_type_id'];
        $paper->status = Config::get('constants.PAPER_STATUS.SUBMITTED');
        $paper->submission_by = Auth::id();
        $paper->save();
        return $paper;
    }

    public function updatePaper(array $data, $id)
    {
        $paper = Paper::find($id);
        $paper->title = $data['title'];
        $paper->abstract = $data['abstract'];

        $paper->save();
        return $paper;
    }

    public function getTrackDecisions($paperId)
    {
        $decisions = TrackDecision::where('paper_id', $paperId)->orderBy('date_decided', 'DESC')->get();
        return $decisions;
    }

    public function updatePaperFile($paperId, array $data)
    {
        $paper = Paper::find($paperId);
        $paper->full_paper = $data['full_paper'];
        $paper->file_id = $data['file_id'];
        $paper->save();
        return $paper;
    }

    /**
     * @param $paper
     * @param $status
     * @return mixed
     */
    public function changePaperStatus($paper, $status)
    {
        $currentStatus = $paper->status;
        $decisionStatus = [
            Config::get('constants.PAPER_STATUS.ACCEPTED'),
            Config::get('constants.PAPER_STATUS.REJECTED'),
            Config::get('constants.PAPER_STATUS.REVISION'),
        ];
        if (in_array($currentStatus, $decisionStatus) && in_array($status, $decisionStatus)) {
            $paper->status = $status;
            $paper->save();
            return $status;
        }
        $paperStatusList = Config::get('constants.PAPER_STATUS');
        $paperStatusList = array_values($paperStatusList);
        $indexCurrentStatus = array_search($currentStatus, $paperStatusList);
        $indexStatus = array_search($status, $paperStatusList);
        if ($indexStatus > $indexCurrentStatus) {
            $paper->status = $status;
            $paper->save();
            return $status;
        } else {
            return $currentStatus;
        }
    }

}
