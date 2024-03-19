<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProviderProfile;
use App\Models\User;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = ProviderProfile::where('user_id', auth()->id())->first();

        return Inertia::render('Provider/Profile/Index', [
            'profile' => $profile,
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
        $profile = ProviderProfile::where('user_id', auth()->id())->first();
        $profile->company_name = request()->company_name;
        $profile->save();
    }
}
