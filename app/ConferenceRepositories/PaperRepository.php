<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/19/2019
 * Time: 10:33 AM
 */

namespace App\ConferenceRepositories;

use App\Models\Paper;

class PaperRepository
{
    public function find($paperId)
    {
        $paper = Paper::find($paperId);
        $paper->load('track');
        return $paper;
    }

    public function get($conferenceId, array $filters = null)
    {
        if (empty($filters)) {
            $papers = Paper::with('track.conference')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $papers = Paper::with('track.conference')->where($conditions)->get();
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
        $paper->status = Paper::STATUS_SUBMITTED;
        $paper->save();
        return $paper;
    }

}