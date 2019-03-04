<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use Session;

class PartnerController extends Controller
{
    const UPLOAD_FOLDER='upload/logo'; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res= Partner::all();
        return view('layouts.admin.partner_sponsor.list',['partners'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.partner_sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'    => 'required',
           'logo'    => 'required',
           'type'    => 'required'
        ]);

        if ($request->hasFile('upload_file')) {
            if ($request->file('upload_file')->isValid()) {
                try {
                    $file = $request->file('upload_file');
                    $nameImage = $file->getClientOriginalName();

                    $path = $file->move(self::UPLOAD_FOLDER, $nameImage);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }
        }
        Partner::create([
           'name'        => $request->name,
           'description' => $request->description,
           'logo'        => asset($path),
           'type'        => $request->type
        ]);
        Session::flash('success','Thêm thành công !');
        return redirect()->route('admin_partner_list');
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
        $res=Partner::find($id);
        return view('layouts.admin.partner_sponsor.update',['partner'=> $res]);
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
        $this->validate($request,[
           'name'    => 'required',
           'logo'    => 'required',
           'type'    => 'required'
        ]);
        
        $partner= Partner::find($id);

        if ($request->hasFile('upload_file')) {
            if ($request->file('upload_file')->isValid()) {
                try {
                    $file = $request->file('upload_file');
                    $nameImage = $file->getClientOriginalName();

                    $path = $file->move(self::UPLOAD_FOLDER, $nameImage);
                } catch (Illuminate\Filesystem\FileNotFoundException $e) {

                }
            }
        }
        $partner->name        = $request->name;
        $partner->description = $request->description;
        $partner->logo        = asset($path);
        $partner->type        = $request->type;
        $partner->save();
        Session::flash('success','Update thành công !');
        return redirect()->route('admin_partner_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Partner::destroy($id);
        Session::flash('success','Xóa thành công !');
        return redirect()->route('admin_partner_list');
    }
}
