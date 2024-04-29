<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return Inertia::render('Admin/Category/Index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'title'=>$request->title,
            'status'=>$request->status,
            'is_feature'=>$request->is_feature,
        ]);
        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Category/Edit',[
            'category'=>$category
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->title = $request->title;
        $category->status = $request->status;
        $category->is_feature = $request->is_feature;
        $category->save();
        return to_route('admin.categories.index');
    }
    public function updateCategories(Request $request, $id)
    {
        $category = Category::FindOrFail($id); 
        $category->update([
            'status'=>$category->status===1? 0:1,
        ]);
        return to_route('admin.countries.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $category->delete();
        return to_route('admin.categories.index');
    }
}
