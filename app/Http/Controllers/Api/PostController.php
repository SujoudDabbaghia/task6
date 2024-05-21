<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    use GeneralTrait;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $posts = Post::with('sub_category')->get();
        $data = view('post.index',$posts);
        return  returnData($data, "The data has been accessed successfully");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        return  response()->json(view('post.create',$posts));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();
        $posts = new Post();
        $posts->sub_category_id = $request->sub_category_id;
        $posts->name = $request->name;
        $posts->save();
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */

    public function edit(Post $post)
    {
        return  response()->json(view('post.edit',$post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validated();
        $post->update([
            $post->sub_category_id = $request->sub_category_id,
            $post->name = $request->name,
        ]);
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
    /////////////////////////////////////////////////////////
    public function str(Request $request)
    {
        $request->validate([
         'str' => ['string'],
        ]);
        $posts = Post::where('name' , 'LIKE','%'.$request->str.'%')->get();
        return  response()->json(view('post.index',$posts));
    }
}
