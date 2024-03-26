<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile;
use App\Models\SeekerSkill;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Address;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = SeekerProfile::where('user_id', auth()->id())->first();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        $user_skills = SeekerSkill::where('user_id', auth()->id())->get()->pluck('id')->toArray();
        $user_skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->whereIn('id', $user_skills)->get();

        return Inertia::render('Seeker/Profile/Index', [
            'profile' => $profile,
            'skills' => $skills,
            'user_skills' => $user_skills,
        ]);
    }

    public function update()
    {
        $user = User::where('id', auth()->id())->first();
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->save();
        if (request()->file('image')) {
            $imageName = auth()->id() . '.' . request()->image->extension();
            request()->image->move(public_path('images/profile/'), $imageName);
            $user->image = '/images/profile/' . $imageName;
            $user->save();
        }
        $profile = SeekerProfile::where('user_id', auth()->id())->first();
        $profile->gender = request()->gender;
        $profile->dob = request()->dob;
        $profile->phone = request()->phone;
        $profile->save();

        SeekerSkill::where('user_id', auth()->id())->delete();
        foreach (request()->skills as $skill) {
            SeekerSkill::create([
                'user_id' => auth()->id(),
                'skill_id' => $skill['id'],
            ]);
        }

        return to_route('seeker.profile.index');
    }


    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        return back();
    }


    public function updateQualification(Request $request)
    {
        //
    }
}

