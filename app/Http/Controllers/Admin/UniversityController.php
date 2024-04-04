<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\City;
use App\Models\Country;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $universities = University::with(['country', 'city'])->paginate(5);
       return Inertia::render('Admin/University/Index',[
        'universities'=>$universities
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
         $cities = City::all();
        return Inertia::render('Admin/University/Create', [
            'countries' => $countries,
            'cities' => $cities, 
        ]);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        University::create([
            'title'=>$request->title,
            'city_id' =>$request->city_id,
             'country_id' =>$request->country_id,
        ]);
       
       return to_route('admin.universities.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university)
    {
        $countries = Country::all();
      $cities =City::all();
        return Inertia::render('Admin/University/Edit',[
            'university'=>$university,
            'countries' => $countries,
            'cities' => $cities, 
        ]);
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        $university->title = $request->title;
        $university->country_id =$request->country_id;
        $university->city_id = $request->city_id;
        $university->save();
        return to_route('admin.universities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
     $university->delete();
     return to_route('admin.universities.index');   
    }
}
