<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Session;

class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('layouts.admin.usermanager.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.usermanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
            'is_admin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $users = new User([
            'user_name' => $request->get('user_name'),
            'first_name' => $request->get('first_name'),
            'middle_name' => $request->get('middle_name'),
            'last_name' => $request->get('last_name'),
            'gender' => $request->get('gender'),
            'initals' => $request->get('initals'),
            'affiliation' => $request->get('affiliation'),
            'is_admin'=> $request->get('is_admin'),
            'phone' => $request->get('phone'),
            'fax' => $request->get('fax'),
            'country' => $request->get('country'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'image' => env('AVATAR_DEFAULT'),
        ]);

        if ($users->save()) {
            return redirect()->route('admin_user_list')->with('success', 'Account has been added successfully');
        } else{
            return redirect()->route('admin_user_create')->with('error', 'Error');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);
        if(empty($users))
            return  redirect()->back()->with('error', 'No Information');
        return view('layouts.admin.usermanager.view',compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);

        return view('layouts.admin.usermanager.edit',compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'affiliation' => ['required', 'string', 'max:255'],
            'is_admin' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $users = User::find($id);

        $users->user_name = $request->get('user_name');
        $users->first_name = $request->get('first_name');
        $users->middle_name = $request->get('middle_name');
        $users->last_name = $request->get('last_name');
        $users->gender = $request->get('gender');
        $users->initals = $request->get('initals');
        $users->affiliation = $request->get('affiliation');
        $users->is_admin = $request->get('is_admin');
        $users->phone = $request->get('phone');
        $users->fax = $request->get('fax');
        $users->country = $request->get('country');
        if(!($users->email == $request->get('email')))
            $users->email = $request->get('email');

        if($users->save()){
            return redirect()->route('admin_user_view',$id)->with('success', 'User has been update successfully');
        }else{
            return redirect()->route('admin_user_update',$id)->with('error', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user->delete()){
            if($user->image != env('AVATAR_DEFAULT')){
                Storage::disk('public')->delete($users->image);
            }
            return redirect()->route('admin_user_list')->with('success', 'Account has been deleted successfully');
        }else{
            return redirect()->route('admin_user_list')->with('error', 'Error');
        }
    }

    public function enable($id)
    {


        $users = User::find($id);
        $users->disable = '0';
        if($users->save()){
            return redirect()->route('admin_user_list')->with('success', 'Account has been enable successfully');
        }else{
            return redirect()->route('admin_user_list')->with('error', 'Error');
        }
    }

    public function disable($id)
    {
        $users = User::find($id);
        $users->disable = '1';
        if($users->save()){
            return redirect()->route('admin_user_list')->with('success', 'Account has been disable Successfully');
        }else{
            return redirect()->route('admin_user_list')->with('error', 'Error');
        }
    }

    public function exportCSV()
    {
        return Excel::download(new UserExport(), 'user_list.csv');
    }
}
