<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = Skill::latest()->get();
        return Inertia::render('Admin/Skill/Index', [
            'skills' => $skills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Skill/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Skill::create([
            'title' => $request->title,
            'status' => $request->status
        ]);
        return to_route('admin.skills.index');
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
    public function edit(Skill  $skill)
    {
        #dd($skill);
        return Inertia::render('Admin/Skill/Edit', [
            'skill' => $skill
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $skill->title = $request->title;
        $skill->status = $request->status;
        $skill->save();
        return to_route('admin.skills.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Skill $skill)
    {
        $skill->delete();
        return to_route('admin.skills.index');
    }
}
