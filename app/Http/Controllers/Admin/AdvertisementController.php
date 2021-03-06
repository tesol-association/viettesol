<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Session;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    const UPLOAD_FOLDER='upload/adv'; 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res= Advertisement::all();
        return view('layouts.admin.advertisement.list',['advertisements'=> $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.advertisement.create');
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
           'name'       => 'required',
           'upload_file'      => 'required|image'
        ]);

        // if ($request->hasFile('upload_file')) {
        //     if ($request->file('upload_file')->isValid()) {
        //         try {
        //             $file = $request->file('upload_file');
        //             $nameImage = $file->getClientOriginalName();

        //             $path = $file->move(self::UPLOAD_FOLDER, $nameImage);
        //         } catch (Illuminate\Filesystem\FileNotFoundException $e) {

        //         }
        //     }
        // }
        if ($request->hasFile('upload_file')) {
            $path = Storage::disk('public')->put(self::UPLOAD_FOLDER, $request->upload_file);
        }

        Advertisement::create([
            'name'  => $request->name,
            'image' => $path ?? null,
        ]);
        Session::flash('success','Thêm thành công !');
        return redirect()->route('admin_advertisement_list');
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
        $res=Advertisement::find($id);
        return view('layouts.admin.advertisement.update',['advertisement'=> $res]);
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
           'name'       => 'required',
           'upload_file'      => 'required|image'
        ]);
        
        $advertisement= Advertisement::find($id);

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
        $advertisement->name    = $request->name;
        $advertisement->image   = asset($path);
        $advertisement->save();
        Session::flash('success','Update thành công !');
        return redirect()->route('admin_advertisement_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Advertisement::destroy($id);
        Session::flash('success','Xóa thành công !');
        return redirect()->route('admin_advertisement_list');
    }
}
