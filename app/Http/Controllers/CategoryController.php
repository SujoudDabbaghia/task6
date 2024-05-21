<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('category.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:10|min:2'
        ]);
        $categories = new Category();
        $categories->name = $request->name;
        $categories->save();
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    
    public function edit(Category $category)
    {
        return view('category.edit' , compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|string|max:10|min:2'
        ]);
        $category->update([
            $category->name = $request->name,
        ]);
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
    /////////////////////////////////////////////////////////
    public function str(Request $request)
    {
        $request->validate([
         'str' => ['string'],
        ]);
        $categories = Category::where('name' , 'LIKE','%'.$request->str.'%')->get();
        return view('category.index' , compact('categories'));
    }
}
