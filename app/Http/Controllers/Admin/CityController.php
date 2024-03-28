<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $cities =City::all();
        return Inertia::render('Admin/City/Index',[
            'cities'=>$cities
        ]);
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries=Country::all();
        return Inertia::render('Admin/City/Create',[
            'countries'=>$countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        City::Create([
            'title'=>$request->title,
            'country_id'=>$request->country_id,
        ]);
        return to_route('admin.cities.index');
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
    public function edit(City $city)
    {
        return Inertia::render('Admin/City/Edit',[
          'city'=>$city
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        $city->title =$request->title;
        $city->country_id = $request->country_id;
        $city->save();

        return to_route('admin.cities.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return to_route('admin.cities.index');
    }
}
