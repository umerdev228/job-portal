<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = AdminProfile::where('user_id', auth()->id())->first();
        return Inertia::render('Admin/Profile/Index', [
            'profile' => $profile,
        ]);
    }
  
    public function update()
    {
        $user = User::where('id', auth()->id())->first();
        $user->first_name = request()->first_name;
        $user->last_name = request()->last_name;
        $user->email=request()->email;
        $user->save();
        if (request()->file('image')) {
            $imageName = auth()->id() . '.' . request()->image->extension();
            request()->image->move(public_path('images/profile/'), $imageName);
            $user->image = '/images/profile/' . $imageName;
            $user->save();
        }
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
    }
