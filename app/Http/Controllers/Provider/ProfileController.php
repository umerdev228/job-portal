<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = ProviderProfile::where('user_id', auth()->id())->first();
        $address = Address::where('user_id', auth()->id())->first();
        if (!$address) {
            Address::create([
                'user_id' => auth()->id(),
                'address' => '',
                'postal_code' => '0',
                'city_id' => 0,
                'country_id' => 0,
            ]);
        }
        $countries = Country::all();
        $cities = City::all();

        return Inertia::render('Provider/Profile/Index', [
            'profile' => $profile,
            'address' => $address,
            'countries' => $countries,
            'cities' => $cities,
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
        $address = Address::where('user_id', auth()->id())->first();
        $address->address = $request->address;
        $address->postal_code = $request->postal_code;
        $address->city_id = $request->city_id;
        $address->country_id = $request->country_id;
        $address->save();

        return back();
    }
}
