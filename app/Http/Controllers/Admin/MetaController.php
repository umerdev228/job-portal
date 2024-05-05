<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return Inertia::render('Admin/Meta/Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'key' => 'required|string',
            'value' => 'nullable|string',
        ]);

        // Extract data from the request
        $key = $request->input('key');
        $value = $request->input('value');

        // Update or create the record in the metas table based on the key
        Meta::updateOrCreate(
            ['key' => $key], // Search criteria
            ['value' => $value] // Data to update or create
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
