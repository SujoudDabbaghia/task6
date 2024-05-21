<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $comments = Comment::with('user','post')->get();
        return response()->json(view('comment.index' ,$comments));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comments = Comment::all();
        return response()->json(view('comment.create' ,$comments));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $request->validated();
        $comments = new Comment();
           $comments->user_id = $request->user_id;
           $comments->post_id = $request->post_id;
           $comments->opinion = $request->opinion;
           $comments->save();
        return redirect()->route('comment.index');
    }

    /**
     * Display the specified resource.
     */
   
    public function edit(Comment $comment)
    {
        return response()->json(view('comment.edit' ,$comment));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
         $request->validated();
        $comment->update([
            $comment->user_id = $request->user_id,
            $comment->post_id = $request->post_id,
            $comment->opinion = $request->opinion,
        ]);
        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment.index');
    }
}
