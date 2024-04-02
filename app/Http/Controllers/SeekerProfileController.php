<?php

namespace App\Http\Controllers;

use App\Models\SeekerProfile;
use App\Http\Requests\StoreSeekerProfileRequest;
use App\Http\Requests\UpdateSeekerProfileRequest;
use App\Models\User;
use Inertia\Inertia;

class SeekerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'seeker')->paginate(12);
        //dd($users);
        return Inertia::render('Talent/Index', [
            'users' => $users,
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
    public function store(StoreSeekerProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SeekerProfile $seekerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeekerProfile $seekerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeekerProfileRequest $request, SeekerProfile $seekerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeekerProfile $seekerProfile)
    {
        //
    }
}
