<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries =Country::paginate(5);
        return Inertia::render('Admin/Country/Index',[
            'countries'=>$countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('Admin/Country/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Country::Create([
          
            'title'=>$request->title,
            'iso2'=>$request->iso2,
            'iso3'=>$request->iso3,

        ]);
        return to_route('admin.countries.index');
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
    public function edit(Country $country)
    {
        return Inertia::render('Admin/Country/Edit',[
            'country'=>$country
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Country $country  )
    {
        $country->title=$request->title;
        $country->iso2 =$request->iso2;
        $country->iso3 =$request->iso3;
        $country->save();
        return to_route('admin.countries.index');
    }
    public function updateCountry(Request $request, $id)
    {
        // dd(request()->all());
        $country = Country::FindOrFail($id);
        $country->update([
            'status'=>$request->status,
        ]);
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return to_route('admin.countries.index');
    }
}
