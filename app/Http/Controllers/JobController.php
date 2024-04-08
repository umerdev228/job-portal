<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\JobApply;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::where('status', Category::STATUS_ACTIVE)->limit(4)->get();
        $jobs =Job::latest()->paginate(8);

        return Inertia::render('Job/Index', [
            'categories' => $categories,
            'jobs' => $jobs,
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
        return Inertia::render('Job/Show', [
            'job' => $job,
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
