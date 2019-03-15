<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $newsCategory = NewsCategory::all();
        return view('layouts.admin.news_category.list', ['newsCategory' => $newsCategory]);
    }

    public function create()
    {
        return view('layouts.admin.news_category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data["slug"] = Str::slug($request->name, '-');
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_news_category_create')
                ->withErrors($validator)
                ->withInput();
        }
        $newsCategory = new NewsCategory();
        $newsCategory->name = $request->name;
        $newsCategory->slug = $data["slug"];
        $newsCategory->description = $request->description;
        $newsCategory->save();
        return redirect()->route('admin_news_category_list')->with('success', 'Create ' . $newsCategory->name . ' successful !');
    }

    public function edit($id)
    {
        $newCategory = NewsCategory::find($id);
        return view('layouts.admin.news_category.edit',['newCategory'=> $newCategory]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $data["slug"] = Str::slug($request->name, '-');
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_news_category_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $newsCategory = NewsCategory::find($id);
        $newsCategory->name = $request->name;
        $newsCategory->slug = $data["slug"];
        $newsCategory->description = $request->description;
        $newsCategory->save();
        return redirect()->route('admin_news_category_list')->with('success', 'Update ' . $newsCategory->name . ' successful !');
    }

    public function destroy($id)
    {
        $newsCategory = NewsCategory::find($id);
        if (count($newsCategory->categoryLink)) {
            return redirect()->route('admin_news_category_list')->with('error','Please delete News of Category first !');
        }
        NewsCategory::destroy($id);
        return redirect()->route('admin_news_category_list')->with('success','Delete ' . $newsCategory->name . ' successful !');
    }

    public function validateData($data) {
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'name' => 'required',
            'slug' => 'required|unique:new_categories,slug,' . $id,
        ]);
    }
}
