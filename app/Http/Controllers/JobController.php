<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Mail\JobApplyMail;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobApply;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

// use Illuminate\Support\Facades\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $chosen_skills = [];
        if ($request->has('chosen_skills') && count($request->chosen_skills)) {
            $chosen_skills = collect($request->chosen_skills)->pluck('id')->ToArray();
        }

        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        $categories = Category::where('status', Category::STATUS_APPROVED)->get();

        $jobs = Job::query()->where('status', Job::STATUS_APPROVED)
            ->when(count($chosen_skills) > 0, function ($query) use ($chosen_skills) {
                $query->whereHas('skills', function ($q) use ($chosen_skills) {
                    $q->whereIn('skill_id', $chosen_skills);
                });
            })
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
                // ->orWhere('category_id', 'like', "%{$search}%");
            })
            ->when($request->input('chosen_category'), function ($query, $search) {
                $query->where('category_id', $search);
            })
            ->latest()
            ->paginate(8);


        return Inertia::render('Job/Index', [
            'categories' => $categories,
            'jobs' => $jobs,
            'skills' => $skills,
            'filters' => $request->input('search') ?? '',
            'chosen_category' => $request->input('chosen_category') ?? 0,
            'chosen_skills' => $request->input('chosen_skills') ?? [],
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
        $user = Auth::user();
        $jobUrl = url('/provider/jobs/' . $job->id);
        $mailData = [
            'title' => 'Hi Dear!',
            'body' => 'New Job Application Received by : ' . $user->first_name . ' ' . $user->last_name,
            'userFirstName' => $user->first_name,
            'userLastName' => $user->last_name,
            'jobTitle' => $job->title,
            'jobDescription' => $job->description,
            'jobUrl' => $jobUrl,

        ];

        Mail::to('umardev82@gmail.com')->send(new JobApplyMail($mailData));

        JobApply::create([
            'user_id' => auth()->id(),
            'job_id' => $job->id,
        ]);
        return to_route('jobs.show', $job->id);
    }
}
