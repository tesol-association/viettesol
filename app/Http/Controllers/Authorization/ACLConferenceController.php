<?php

namespace App\Http\Controllers\Authorization;

use App\ConferenceRepositories\ACLConferenceRepository;
use App\Http\Controllers\Admin\ConferenceManager\BaseConferenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ACLConferenceController extends BaseConferenceController
{
    protected $aclConferences;
    public function __construct(Request $request, ACLConferenceRepository $ACLConferenceRepository)
    {
        parent::__construct($request);
        $this->aclConferences = $ACLConferenceRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissionList()
    {
        $permissions = $this->aclConferences->allPermissions();
        return view('authorization.permission.list', [
            'permissions'=> $permissions
        ]);
    }

    public function accessList()
    {
        $accesses = $this->aclConferences->allAccesses($this->conferenceId);
        return view('authorization.access.list', [
            'accesses'=> $accesses
        ]);
    }

    public function switchAccessAllow(Request $request)
    {
        $data = $request->all();
        $access = $this->aclConferences->switchAccessAllow($data['access_id']);
        return $access;
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePermission(Request $request, $conferenceId)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $permission = $this->aclConferences->createPermission($data);
        return redirect()->route('conference_acl_permission_list', ['id' => $conferenceId])->with('success', 'Create ' . $permission->name . ' successful !');
    }

    /**
     * @param Request $request
     * @param $conferenceId
     * @param $permissionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermission(Request $request, $conferenceId, $permissionId)
    {
        $data = $request->all();
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $permission = $this->aclConferences->updatePermission($permissionId, $data);
        return redirect()->route('conference_acl_permission_list', ['id' => $conferenceId])->with('success', 'Update ' . $permission->name . ' successful !');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
        ]);
    }
}
