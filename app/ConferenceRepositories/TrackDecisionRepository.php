<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;

use App\Models\TrackDecision;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Carbon\Carbon;

class TrackDecisionRepository
{

    /**
     * @return TrackDecision[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return TrackDecision::all();
    }

    public function find($trackDecisionId)
    {
        return TrackDecision::find($trackDecisionId);
    }

    /**
     * @param null $filters
     * @return TrackDecision[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $trackDecision = TrackDecision::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $trackDecision = TrackDecision::where($conditions)->get();
        }
        return $trackDecision;
    }

    /**
     * @param $data
     * @return TrackDecision
     */
    public function create(array $data)
    {
        $trackDecision = new TrackDecision();
        $trackDecision->paper_id = $data['paper_id'];
        $trackDecision->track_director_id = $data['track_director_id'];
        $trackDecision->decision = $data['decision'];
        $trackDecision->date_decided = Carbon::now();
        if ($trackDecision->save()) {
            $trackDecision->load('user', 'paper');
        }
        return $trackDecision;
    }


}
