<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/21/2019
 * Time: 2:04 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ConferenceRole;

class ConferenceRoleRepository
{

    /**
     * @return ConferenceRole[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ConferenceRole::all();
    }

    public function find($id)
    {
        return ConferenceRole::find($id);
    }

    /**
     * @param null $filters
     * @return ConferenceRole[]|\Illuminate\Database\Eloquent\Collection
     */
    public function get($filters = null)
    {
        if (empty($filters)) {
            $conferenceRole = ConferenceRole::all();
        } else {
            $conditions = [];
            foreach ($filters as $key => $filter) {
                $conditions[] = [$key, '=', $filter];
            }
            $conferenceRole = ConferenceRole::where($conditions)->get();
        }
        return $conferenceRole;
    }

    public function getTrackDirectors($conferenceId)
    {
        $trackDirectorRole = ConferenceRole::where('name', ConferenceRole::TRACK_DIRECTOR)->where('conference_id', $conferenceId)->first();
        if (!$trackDirectorRole) {
            return null;
        }
        $trackDirectors = $trackDirectorRole->user;
        return $trackDirectors;
    }

    public function getReviewers($conferenceId)
    {
        $reviewerRole = ConferenceRole::where('name', ConferenceRole::REVIEWER)->where('conference_id', $conferenceId)->first();
        if(!$reviewerRole){
            return null;
        }
        $reviewer = $reviewerRole->user;
        return $reviewer;
    }

}
