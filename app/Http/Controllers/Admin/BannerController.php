<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Session;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    const UPLOAD_FOLDER='upload/banner';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res= Banner::all();
        return view('layouts.admin.banner.list',['banners'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.banner.create');
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
           'title'            => 'required',
           'upload_file'      => 'required|image'
        ]);

        if ($request->hasFile('upload_file')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->upload_file);
        }
        Banner::create([
           'title' => $request->title,
           'url'   => $path ?? null
        ]);
        Session::flash('success','Thêm thành công !');
        return redirect()->route('admin_banner_list');
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
        $res=Banner::find($id);
        return view('layouts.admin.banner.update',['banner'=> $res]);
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
           'title'       => 'required',
           'upload_file'      => 'required|image'
        ]);
        
        $banner= Banner::find($id);

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
        $banner->title = $request->title;
        $banner->url   = asset($path);
        $banner->save();
        Session::flash('success','Update thành công !');
        return redirect()->route('admin_banner_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Banner::destroy($id);
        Session::flash('success','Xóa thành công !');
        return redirect()->route('admin_banner_list');
    }
}
