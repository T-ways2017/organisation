<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //display all grades
        $grades = Grade::all();
        return view('grades.index', compact('grades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create a new grade
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store the grade
        $request->validate([
            'name' => 'required|unique:grades',
            'description' => 'required'
        ]);
        Grade::create($request->all());
        return redirect()->route('grades.index')->with('success', 'Grade created successfully.');

    }

    /**
     * Display the specified resource.
     *  public function show(string $id)
     */
    public function show(Grade $grade)
    {
        //display a grade
        //$grade = Grade::find($id);
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //Edit a grade
        //$grade = Grade::find($id);
        return view('grades.edit', compact('grade'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //update the grade
        $request->validate([
            'name' => 'required|unique:grades,name,'.$grade->id,
            'description' => 'required'
        ]);
        $grade->update($request->all());
        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete the grade
        //$grade = Grade::find($id);
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
