<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
	public function index()
	{
		$comments = Comment::all();
		$status   = array('active','deactive');
		return view('layouts.admin.comment.list',['comments'=> $comments,'status'=>$status ]);
	}
    public function store(Request $request)
    {
    	Comment::create([
           'body' => $request->comment,
           'user_id'=>Auth::id(),
           'new_id' => $request->news_id
        ]);
        return redirect()->back();
    }
    public function update(Request $request)
    {
    	$id    = $request->id;
    	$status= $request->status;
        $comment=Comment::find($id);
        $comment->status=$status;
        $comment->save();
        
        $data=array(
           'status' => true
        ); 
    	echo json_encode($data);
    }
}
