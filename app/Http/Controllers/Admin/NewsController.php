<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsCategoryLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::all();
        foreach ($news as $new) {
            $new->tags = json_decode($new->tags, true);
        }
        return view('layouts.admin.news.list', ['news'=> $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $newsCategory = NewsCategory::all();
        return view('layouts.admin.news.create', ['newsCategory' => $newsCategory]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return redirect()
                ->route('admin_news_create')
                ->withErrors($validator)
                ->withInput();
        }
        $news = new News();
        $news->title = $request->title;
        $news->slug = $request->slug;
        $news->short_content = $request->short_content;
        $news->body = $request->body;
        $news->tags = json_encode($request->tags);
        $news->status = $request->status;
        $news->last_updated_by = Auth::id();
        $news->created_by = Auth::id();
        $news->save();
        if ($request->news_category) {
            foreach ($request->news_category as $categoryId) {
                $newsCategoryLink = new NewsCategoryLink();
                $newsCategoryLink->new_id = $news->id;
                $newsCategoryLink->category_id = $categoryId;
                $newsCategoryLink->save();
            }
        }
        return redirect()->route('admin_news_list')->with('success', 'Create ' . $news->title . ' successful !');
    }

    public function edit($id)
    {
        $new = News::find($id);
        $new->tags = json_decode($new->tags, true);
        $categories = [];
        foreach ($new->categoryLinks as $categoryLink) {
            $categories[] = $categoryLink->category->id;
        }
        $new->categories = $categories;
        $newsCategory = NewsCategory::all();
        return view('layouts.admin.news.edit', ['new' => $new, 'newsCategory' => $newsCategory]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data["id"] = $id;
        $validator = $this->validateData($data);
        if ($validator->fails()) {
            return redirect()
                ->route('admin_news_edit', ["id" => $id])
                ->withErrors($validator)
                ->withInput();
        }
        $new = News::find($id);
        $new->title = $request->title;
        $new->slug = $request->slug;
        $new->short_content = $request->short_content;
        $new->body = $request->body;
        $new->tags = json_encode($request->tags);
        $new->status = $request->status;
        $new->last_updated_by = Auth::id();
        $new->save();
        $categorieIds = [];
        foreach ($new->categoryLinks as $categoryLink) {
            $categorieIds[] = $categoryLink->category->id;
        }
        $sendedCategories = $request->news_category;
        foreach ($sendedCategories as $index => $categoryId) {
            if (($key = array_search($categoryId, $categorieIds)) === false) {
                $newsCategoryLink = new NewsCategoryLink();
                $newsCategoryLink->new_id = $new->id;
                $newsCategoryLink->category_id = $categoryId;
                $newsCategoryLink->save();
            } else {
                unset($sendedCategories[$index]);
                unset($categorieIds[$key]);
            }
        }
        if (isset($categorieIds) && count($categorieIds)) {
            foreach ($categorieIds as $categoryId) {
                NewsCategoryLink::where('new_id', $new->id)->where('category_id', $categoryId)->delete();
            }
        }
        return redirect()->route('admin_news_list')->with('success', 'Update ' . $new->title . ' successful !');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $newCategoryLinks = NewsCategoryLink::where('new_id', $id)->get();
        foreach ($newCategoryLinks as $newCategoryLink) {
            NewsCategoryLink::destroy($newCategoryLink->id);
        }
        $new = News::find($id);
        News::destroy($id);
        return redirect()->route('admin_news_list')->with('success','Xóa thành công: ' . $new->title . '!');
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateData($data)
    {
        $id = isset($data["id"]) && $data["id"] ? $data["id"] : null;
        return Validator::make($data, [
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . $id,
            'short_content' => 'required',
            'body' => 'required',
            'status' => 'required',
            'news_category' => 'required',
        ]);
    }

}
