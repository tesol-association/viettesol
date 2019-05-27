<?php
/**
 * Created by PhpStorm.
 * User: thangbk111
 * Date: 3/20/2019
 * Time: 2:54 PM
 */

namespace App\ConferenceRepositories;


use App\Models\ConferencePermission;
use App\Models\ConferenceRole;
use App\Models\ConferenceRolePermission;

class ACLConferenceRepository
{
    public function allPermissions()
    {
        return ConferencePermission::all();
    }

    public function allAccesses($conferenceId)
    {
        $allAccesses = ConferenceRolePermission::with('role')->get();
        $conferenceAccesses = $allAccesses->filter(function ($access) use ($conferenceId) {
            return ($access->role != null) && ($access->role->conference_id == $conferenceId);
        });
        if ($conferenceAccesses->count()) {
            $conferenceAccesses->load('permission');
        }
        return $conferenceAccesses;
    }

    public function findPermission($permissionId)
    {
        return ConferencePermission::find($permissionId);
    }

    public function findAccess($accessId)
    {
        return ConferenceRolePermission::find($accessId);
    }

    public function switchAccessAllow($accessId)
    {
        $access = ConferenceRolePermission::find($accessId);
        if ($access->allowed == 0) {
            $access->allowed = 1;
        } else {
            $access->allowed = 0;
        }
        $access->save();
        return $access;
    }

    /**
     * @param $data
     * @return ConferencePermission
     */
    public function createPermission($data)
    {
        $permission = new ConferencePermission();
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
        //Add Permission For All Role
        $conferenceRoles = ConferenceRole::all();
        foreach ($conferenceRoles as $role) {
            $rolePermission = new ConferenceRolePermission();
            $rolePermission->conference_role_id = $role->id;
            $rolePermission->conference_permission_id = $permission->id;
            $rolePermission->allowed = 0;
            $rolePermission->save();
        }
        return $permission;
    }

    /**
     * @param $permissionId
     * @param $data
     * @return mixed
     */
    public function updatePermission($permissionId, $data)
    {
        $permission = ConferencePermission::find($permissionId);
        $permission->name = $data['name'];
        $permission->description = $data['description'];
        $permission->save();
        return $permission;
    }

    public function destroy($id)
    {
        $track = Track::find($id);
        $track->delete();
        return $track;
    }

}
