<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;


use App\Models\Track;

class TrackRepository
{

    /**
     * @return ReviewForm[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Track::all();
    }

    public function find($trackId)
    {
        return Track::find($trackId);
    }

    /**
     * @param null $filters
     * @return Track[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $track = Track::with('conference', 'reviewForm', 'users')->get();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $track = Track::with('conference', 'reviewForm', 'users')->where($conditions)->get();
        }
        return $track;
    }

    /**
     * @param $data
     * @return Track
     */
    public function create($data)
    {
        $track = new Track();
        $track->name = $data['name'];
        $track->abbrev = $data['abbrev'];
        $track->policy = $data['policy'];
        $track->description = $data['description'];
        $track->conference_id = $data['conference_id'];
        $track->review_form_id = $data['review_form_id'];
        if (isset($data['keywords']) && count($data['keywords'])) {
            $track->keywords = $data['keywords'];
        }
        $track->save();
        if (isset($data['user_id']) && count($data['user_id'])) {
            $track->users()->attach($data['user_id']);
        }
        return $track;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $track = Track::find($id);
        $track->name = $data['name'];
        $track->abbrev = $data['abbrev'];
        $track->policy = $data['policy'];
        $track->description = $data['description'];
        $track->review_form_id = $data['review_form_id'];
        if (isset($data['keywords']) && count($data['keywords'])) {
            $track->keywords = $data['keywords'];
        }
        $track->save();
        if(isset($data['user_id'])){
            $track->users()->detach($track->users->pluck('id')->all());
            $track->users()->attach($data['user_id']);
        }

        return $track;
    }

    public function destroy($id)
    {
        $track = Track::find($id);
        $track->delete();
        return $track;
    }

}
