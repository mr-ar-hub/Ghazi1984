<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(){
        $comments = Comment::with('blogs')->get();
        return view('admin.comments.comment' , compact('comments'));
    }

    public function viewComment($id){
        $data = Comment::with('blogs')->where('id' , $id)->first();
        return view('admin.comments.viewcomment' , compact('data'));
    }

    public function deleteComment($id){
        $comments = Comment::find($id);
        $comments->delete();
        return back()->with('message', 'Comment deleted successfully!');

    }
}
