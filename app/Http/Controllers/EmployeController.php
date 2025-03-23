<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //Display list of all Employes
    public function index()
    {
        //get all Employes
         $employes = Employe::with('site', 'grade')->get();
         return view('employes.index', compact('employes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    //Formula for create new employe
    public function create()
    {
        //add employe
        $sites = Site::all();
        $grade = Grade::all();

        return view('employe.create', compact('sites', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    //save a new employe
    public function store(Request $request)
    {
        // //
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'matricule'=>'required|unique:employes',
            'email' => 'required|email|unique:employes',
            'phone' => 'required',
            'adresse' => 'required',
            'birth' => 'required',
            'site_id' => 'required|exists:sites,id',
            'grade_id' => 'nullable|exists:grades,id',
            'work_id' => 'nullable|exists:works,id',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'rib' => 'nullable|mimes:pdf|max:2048',
        ]);

        $cvPath = $request->file('cv') ? $request->file('cv')->store('cvs') : null;
        $ribPath = $request->file('rib') ? $request->file('rib')->store('ribs') : null;

        Employe::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'birth' => $request->birth,
            'cv' => $cvPath,
            'rib' => $ribPath,
            'site_id' => $request->site_id,
            'grade_id' => $request->grade_id,
            'work_id' => $request->work_id,
        ]);

        return redirect()->route('employes.index')->with('success', 'Employe added succesfully ');


    }

    /**
     * Display the specified resource.
     *  public function show(Employe $employe)
     */
    public function show(string $id)
    {
       return view('employes.show', compact('employe'));

    }

    /**
     * Show the form for editing the specified resource.
     * public function edit(Emp)
     */
    //displays on employe
    public function edit(string $id)
    {
        //show one employes
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update employe
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'matricule'=>'required|unique:employes,matricule,'.$employe->id,
            'email' => 'required|email|unique:employes,email,'.$employe->id,
            'phone' => 'required',
            'adresse' => 'required',
            'birth' => 'required',
            'site_id' => 'required|exists:sites,id',
            'grade_id' => 'nullable|exists:grades,id',
            'work_id' => 'nullable|exists:works,id',
            'cv' => 'nullable|mimes:pdf|max:2048',
            'rib' => 'nullable|mimes:pdf|max:2048',
        ]);

        if ($request->file('cv')) {
            $cvPath = $request->file('cv')->store('cvs');
            $employe->cv = $cvPath;
        }
        if ($request->file('rib')) {
            $ribPath = $request->file('rib')->store('ribs');
            $employe->rib = $ribPath;
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}
