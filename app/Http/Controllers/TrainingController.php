<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //display all trainings
        $trainings = Training::all();
        return view('trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create a new training
        return view('trainings.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store the training
        $request->validate([
            'name' => 'required|unique:trainings',
            'description' => 'required',
            'level' => 'required'
        ]);
        Training::create($request->all());
        return redirect()->route('trainings.index')->with('success', 'Training created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        //show a training
        //$training = Training::find($id);
        return view('trainings.show', compact('training'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        //Edit a training
        //$training = Training::find($id);
        return view('trainings.edit', compact('training'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Training $training)
    {
        //update the training
        $request->validate([
            'name' => 'required|unique:trainings,name,'.$training->id,
            'description' => 'required',
            'level' => 'required'
        ]);
        $training->update($request->all());
        return redirect()->route('trainings.index')->with('success', 'Training updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        //delete the training
        //$training = Training::find($id);
        $training->delete();
        return redirect()->route('trainings.index')->with('success', 'Training deleted successfully.');
    }
}
