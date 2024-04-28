<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degrees = Degree::paginate(5);
        return Inertia::render('Admin/Degree/Index',[
         'degrees' => $degrees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return Inertia::render('Admin/Degree/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Degree::Create([
            'title'=>$request->title,
        ]);
        return to_route('admin.degrees.index');
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
    public function edit(Degree $degree)
    {
        return Inertia::render('Admin/Degree/Edit',[
            'degree'=> $degree
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Degree $degree)
    {
        $degree->title=$request->title;
        $degree->save();
        return to_route('admin.degrees.index');
    }

    public function updateDegree(Request $request ,$id)
    {
        // dd(request()->all());
        $degree = Degree::findOrFail($id);
        
        $degree->update([
            'status' => $request->status,
        ]);
    
        return to_route('admin.degrees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Degree $degree)
    {
        $degree->delete();
        return to_route('admin.degrees.index');
    }
}
