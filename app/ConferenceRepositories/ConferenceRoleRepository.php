<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/21/2019
 * Time: 2:04 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ConferencePermission;
use App\Models\ConferenceRole;
use Illuminate\Support\Facades\Config;

class ConferenceRoleRepository
{

    /**
     * @return ConferenceRole[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ConferenceRole::all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return ConferenceRole::find($id);
    }

    /**
     * @param $data
     * @return ConferenceRole
     */
    public function create($data)
    {
        $conferenceRole = new ConferenceRole();
        $conferenceRole->name = $data['name'];
        $conferenceRole->description = $data['description'];
        $conferenceRole->conference_id = $data['conference_id'];
        $conferenceRole->save();
        //Add all permission for New Role
        $permissions = ConferencePermission::all();
        foreach ($permissions as $permission) {
            $permission->roles()->attach($conferenceRole->id, ['allowed' => 0]);
        }
        return $conferenceRole;
    }

    public function accessPermissions(ConferenceRole $conferenceRole, array $permissionNames)
    {
        $permissions = ConferencePermission::whereIn('name', $permissionNames)->get();
        $permissionIds = $permissions->pluck('id')->all();
        $conferenceRole->permissions()->updateExistingPivot($permissionIds, ['allowed' => 1]);
        return true;
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
        $trackDirectorRole = ConferenceRole::where('name', Config::get('constants.CONFERENCE_ROLE.TRACK_DIRECTOR'))->where('conference_id', $conferenceId)->first();
        if (!$trackDirectorRole) {
            return null;
        }
        $trackDirectors = $trackDirectorRole->user;
        return $trackDirectors;
    }

    public function getReviewers($conferenceId)
    {
        $reviewerRole = ConferenceRole::where('name', Config::get('constants.CONFERENCE_ROLE.REVIEWER'))->where('conference_id', $conferenceId)->first();
        if(!$reviewerRole){
            return null;
        }
        $reviewer = $reviewerRole->user;
        return $reviewer;
    }

    public function getDirectors($conferenceId)
    {
        $directorRole = ConferenceRole::where('name', Config::get('constants.CONFERENCE_ROLE.DIRECTOR'))->where('conference_id', $conferenceId)->first();
        if (!$directorRole) {
            return null;
        }
        $directors = $directorRole->user;
        return $directors;
    }

    public function getAuthors($conferenceId)
    {
        $authorRole = ConferenceRole::where('name', Config::get('constants.CONFERENCE_ROLE.AUTHOR'))->where('conference_id', $conferenceId)->first();
        if (!$authorRole) {
            return null;
        }
        $authors = $authorRole->user;
        return $authors;
    }

}
