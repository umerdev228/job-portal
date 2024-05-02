<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApply;
use Inertia\Inertia;
use App\Models\Skill;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
{
    $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
    $categories = Category::where('status', Category::STATUS_APPROVED)->get();

    $jobs = Job::query()
        ->when($request->input('search'), function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category_id', 'like', "%{$search}%");
                //   ->orWhere('skill_id', 'like', "%{$search}%");
        })
        ->where('status', Job::STATUS_APPROVED)
        ->latest()
        ->paginate(8);

    return Inertia::render('Job/Index', [
        'categories' => $categories,
        'jobs' => $jobs,
        'skills' => $skills,
        'filters' => $request->input('search'),
    ]);
}

    // public function index(Request  $request)
    // {

        
    // //     $categories = Category::where('status', Category::STATUS_APPROVED)->get();

    // //     $jobs = Job::query()->where('status', Job::STATUS_APPROVED);

    // //     // Apply search filter by title
    // //     if ($request->input('search')) {
    // //         $jobs->where('title', 'like', '%' . $request->input('search') . '%');
    // //     }

    // //     // Apply category filter
    // //     if ($request->category_id && $request->category_id > 0) {
    // //         $jobs->where('category_id', $request->category_id); 
    // //     }

    // //       // Apply skill filter
    // // if ($request->input('skill_id') && $request->input('skill_id') > 0) {
    // //     $jobs->where('skill_id', $request->input('skill_id'));
    // // } 
    // $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
    // $categories = Category::where('status', Category::STATUS_APPROVED)->get();

    // $jobs = Job::query()
    //     ->when(Request::input('search'), function ($query, $search) {
    //         $query->where('title', 'like', "%{$search}%");
    //     })
    //     ->when(Request::input('search'),function($query,$search) {
    //         $query->where('category_id', 'like', "%{$search}%");
    //     })
    //     ->when(Request::input('search'),function($query,$search) {
    //         $query->where('skill_id', 'like', "%{$search}%");
    //     })
    //     ->where('status', Job::STATUS_APPROVED)
    //     ->latest()
    //     ->paginate(8);

    // return Inertia::render('Job/Index', [
    //     'categories' => $categories,
    //     'jobs' => $jobs,
    //      'skills' => $skills,
    //     'filters' => Request::input('search'),
    // ]);
      
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $applied = false;
        if (\auth()->user()) {
            $applied = JobApply::where('user_id', auth()->id())->where('job_id', $job->id)->exists();
        }
        return Inertia::render('Job/Show', [
            'job' => $job,
            'applied' => $applied,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }

    public function apply(Job $job)
    {
        JobApply::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);
        return to_route('jobs.show', $job->id);
    }
}
