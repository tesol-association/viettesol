<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res= Menu::all();
        return view('layouts.admin.menu.list',['menus'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request,[
        //    'name'       => 'required'
        //    'description' => 'required',
        //    'creator_id'     => 'required'
        // ]);
        //dd($request->all());
        Menu::create([
            'name'        => $request->name,
            'url'         => $request->url,
            'description' => $request->description,
            'created_by'  => $request->creator_id,
            'parent_id'   => $request->parent_id
        ]);
        Session::flash('success','Thêm thành công !');
        return redirect()->route('admin_menu_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res=Menu::find($id);
        return view('layouts.admin.menu.update',['menu'=> $res]);
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
        $menu= Menu::find($id);
        $menu->name = $request->name;
        $menu->url  = $request->url;
        $menu->description = $request->description;
        $menu->created_by  = $request->creator_id;
        $menu->parent_id   = $request->parent_id;

        $menu->save();
        Session::flash('success','Update thành công !');
        return redirect()->route('admin_menu_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
        Session::flash('success','Xóa thành công !');
        return redirect()->route('admin_menu_list');
    }
}
