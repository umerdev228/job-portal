<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use App\Models\Degree;
use App\Models\Qualification;
use App\Models\SeekerProfile;
use App\Models\SeekerSkill;
use App\Models\Skill;
use App\Models\University;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = SeekerProfile::where('user_id', auth()->id())->first();
        $skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->get();
        $user_skills = SeekerSkill::where('user_id', auth()->id())->get()->pluck('id')->toArray();
        $address = Address::where('user_id', auth()->id())->first();
        $user_skills = Skill::where('status', Skill::STATUS_ACTIVE)->select('id', 'title')->whereIn('id', $user_skills)->get();
        $countries = Country::all();
        $cities = City::all();
        $universities = University::all();
        $degrees = Degree::all();
        $qualifications = Qualification::where('user_id', auth()->id())->with(['university', 'degree'])->get();

        return Inertia::render('Seeker/Profile/Index', [
            'profile' => $profile,
            'skills' => $skills,
            'user_skills' => $user_skills,
            'countries' => $countries,
            'cities' => $cities,
            'address' => $address,
            'universities' => $universities,
            'degrees' => $degrees,
            'qualifications' => $qualifications,
        ]);
    }

    public function update()
    {
        $user = User::where('id', auth()->id())->first();
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->save();

        if (request()->file('image')) {
            if($user->image)
            {
                Storage::delete($user->image);
            }
            $imageName = auth()->id() . '.' . request()->image->extension();
            $path = request()->image->storeAs('public/seeker/profile',$imageName);
            $user->image = $path;
            $user->save();
        }
        $profile = SeekerProfile::where('user_id', auth()->id())->first();
        $profile->gender = request()->gender;
        $profile->dob = Carbon::parse(request()->dob);
        $profile->phone = request()->phone;
        $profile->about = request()->about;
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

    public function updateAddress(Request $request)
    {
        $address = Address::firstOrCreate([
            'user_id' => auth()->id()
        ], [
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,

        ]);
        return back();
    }

    public function updateQualification(Request $request)
    {

        $qualifications = Qualification::create([
            'user_id' => auth()->id(),
            'university_id' => $request->university_id,
            'degree_id' => $request->degree_id,
            'from' => $request->from,
            'to' => $request->to,
        ]);
        return back();
    }

}

