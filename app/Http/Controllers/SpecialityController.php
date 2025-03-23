<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //display all specialities
        $specialities = Speciality::all();
        return view('specialities.index', compact('specialities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create a new speciality
        return view('specialities.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //storing the speciality
        $request->validate([
            'name' => 'required|unique:specialities',
            'description' => 'required'
        ]);
        Speciality::create($request->all());
        return redirect()->route('specialities.index')->with('success', 'Speciality created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Speciality $speciality)
    {
        //display a speciality
        //$speciality = Speciality::find($id);
        return view('specialities.show', compact('speciality'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speciality $peciality)
    {
        //Edit a speciality
        //
        //$speciality = Speciality::find($id);
        return view('specialities.edit', compact('speciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speciality $speciality)
    {
        //update the speciality
        $request->validate([
            'name' => 'required|unique:specialities,name,'.$speciality->id,
            'description' => 'required'
        ]);
        $speciality->update($request->all());
        return redirect()->route('specialities.index')->with('success', 'Speciality updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *  public function destroy(string $id)
     */
    public function destroy(Speciality $speciality)
    {
        //delete a speciality
        //$speciality = Speciality::find($id);
        $speciality->delete();
        return redirect()->route('specialities.index')->with('success', 'Speciality deleted successfully.');
    }
}
