<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApply;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = Category::where('status', Category::STATUS_APPROVED)->limit(4)->get();
        $jobs = Job::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->where('status', Job::STATUS_APPROVED)
            ->latest()
            ->paginate(8);

        return Inertia::render('Job/Index', [
            'categories' => $categories,
            'jobs' => $jobs,
            'filters' => Request::input('search'),
        ]);
    }

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
