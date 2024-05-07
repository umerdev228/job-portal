<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ApprovedJobMail;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobSkill;
use App\Models\Skill;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


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
        return Inertia::render('Admin/Job/Index', [
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $categories = Category::where('status', Category::STATUS_APPROVED)->get();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        return Inertia::render('Admin/Job/Show', [
            'job' => $job,
            'categories' => $categories,
            'skills' => $skills,
            'job_skills' => $job->skills,


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $categories = Category::where('status', Category::STATUS_APPROVED)->get();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        return Inertia::render('Admin/Job/Edit', [
            'job' => $job,
            'categories' => $categories,
            'skills' => $skills,
            'job_skills' => $job->skills,


        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job  $job)
    {
        // dd(request()->all());

        $job->update([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'experience' => $request->experience,
            'description' => $request->description,
            'status' => $request->status,
            'is_feature' => $request->is_feature,

        ]);


        

        if ($request->status === 'approved') {
            $jobCreator = $job->user;
        
            if ($jobCreator) {
                // Concatenate first name and last name
                $name = $jobCreator->first_name . ' ' . $jobCreator->last_name;
        
                $mailData = [
                    'title' => 'Job Approved',
                    'body' => 'Your job "' . $job->title . '" has been approved.',
                    'name' => $name, // Concatenated name
                    'job' => $job,
                ];
                Mail::to('umardev82@gmail.com')->send(new ApprovedJobMail($mailData));
            }
        }





        if (request()->file('image')) {
            if ($job->image) {
                Storage::delete($job->image);
            }
            $imageName = time() . auth()->id() . '.' . request()->image->extension();
            $path = request()->image->storeAs('public/jobs/', $imageName);
            $job->image = $path;
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

        return to_route('admin.jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        $job->delete();
        JobSkill::where('job_id', $job->id)->delete();
        return to_route('admin.jobs.index');
    }

    public function updateFeature(Request $request, $id)
    {
        // Validate request data if needed
        // dd($request->all());
        $job = Job::findOrFail($id);
        $job->update([
            'is_feature' => $job->is_feature === 1 ? 0 : 1,
        ]);

        return to_route('admin.jobs.index');
    }
}
