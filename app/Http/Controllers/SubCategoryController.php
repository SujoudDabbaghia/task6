<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;

class SubCategoryController extends Controller
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
        $sub_categories = SubCategory::with('category')->get();
        return view('subcategory.index' , compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sub_categories = SubCategory::all();
        return view('subcategory.create' , compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request)
    {
        $request->validated();
        $sub_categories = new SubCategory();
        $sub_categories->name = $request->name;
        $sub_categories->category_id = $request->category_id;
        $sub_categories->save();
        return redirect()->route('subcategory.index');
    }

    /**
     * Display the specified resource.
     */
    
    public function edit(SubCategory $subCategory)
    {
        return view('subcategory.edit' , compact('subCategory'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, SubCategory $subCategory)
    {
        $request->validated();
        $subCategory->update([
            $subCategory->name = $request->name,
            $subCategory->category_id = $request->category_id,
        ]);
        return redirect()->route('subcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->route('subcategory.index');
    }
    /////////////////////////////////////////////////////////
    public function str(Request $request)
    {
        $request->validate([
         'str' => ['string'],
        ]);
        $sub_categories = SubCategory::where('name' , 'LIKE','%'.$request->str.'%')->get();
        return view('subcategory.index' , compact('sub_categories'));
    }
}
