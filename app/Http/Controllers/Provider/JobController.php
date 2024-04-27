<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobSkill;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::where('status', Category::STATUS_APPROVED)->get();
        //$jobs = Job::latest()->get();
        $jobs = Job::latest()->paginate(5);
        return Inertia::render('Provider/Job/Index', [
            'categories' => $categories,
            'jobs' => $jobs,


        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', Category::STATUS_APPROVED)->get();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        return Inertia::render('Provider/Job/Create', [
            'categories' => $categories,
            'skills' => $skills,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {

        $job = Job::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'experience' => $request->experience,
            'description' => $request->description,
        ]);
        
        if (request()->file('image')) {
            $imageName = time() . auth()->id() . '.' . request()->image->extension();
            request()->image->move(public_path('images/jobs/'), $imageName);
            $job->image = '/images/jobs/' . $imageName;
            $job->save();
        }
        if (count(request()->skills) > 0) {
            foreach (request()->skills as $skill) {
                JobSkill::create([
                    'job_id' => $job->id,
                    'skill_id' => $skill['id'],
                ]);
            }
        }

        return to_route('provider.jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $categories = Category::where('status', Category::STATUS_APPROVED)->get();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        return Inertia::render('Provider/Job/Edit', [
            'job' => $job,
            'categories' => $categories,
            'skills' => $skills,
            'job_skills' => $job->skills,


        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {


        $job->update([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'experience' => $request->experience,
            'description' => $request->description,

        ]);
        if (request()->file('image')) {
            $imageName = time() . auth()->id() . '.' . request()->image->extension();
            request()->image->move(public_path('images/jobs/'), $imageName);
            $job->image = '/images/jobs/' . $imageName;
            $job->save();
        }
        if (count(request()->skills) > 0) {
            JobSkill::where('job_id', $job->id)->delete();
            foreach (request()->skills as $skill) {
                JobSkill::create([
                    'job_id' => $job->id,
                    'skill_id' => $skill['id'],
                ]);
            }
        }

        return to_route('provider.jobs.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        JobSkill::where('job_id', $job->id)->delete();
        return to_route('provider.jobs.index');
    }
}
