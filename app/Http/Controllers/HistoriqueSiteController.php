<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoriqueSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //historique des sites
        $historiqueSites = HistoriqueSite::with(['employe', 'last_site', 'new_site'])->get();
        return view('historiqueSites.index', compact('historiqueSites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employes = Employe::all();
        $sites = Site::all();
        return view('historiqueSites.create', compact('employes', 'sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //storing the historique site
        $request->validate([
            'employe_id' => 'required|exxists:employes,id',
            'last_site_id' => 'required|exxists:sites,id',
            'new_site_id' => 'required|exxists:sites,id',
            'date_changement' => 'required|date'
        ]);
        HistoriqueSite::create($request->all());
        return redirect()->route('historiqueSites.index')->with('success', 'Historique site created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HistoriqueSite $historiqueSite)
    {
        //show a historique site
        return view('historiqueSites.show', compact('historiqueSite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoriqueSite $historiqueSite)
    {
        //Edit a historique site
        $employes = Employe::all();
        $sites = Site::all();
        return view('historiqueSites.edit', compact('historiqueSite', 'employes', 'sites'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistoriqueSite $historiqueSite)
    {
        //update the historique site
        $request->validate([
            'employe_id' => 'required|exxists:employes,id',
            'last_site_id' => 'required|exxists:sites,id',
            'new_site_id' => 'required|exxists:sites,id',
            'date_changement' => 'required|date'
        ]);
        $historiqueSite->update($request->all());
        return redirect()->route('historiqueSites.index')->with('success', 'Historique site updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoriqueSite $historiqueSite)
    {
        //delete the historique site
        $historiqueSite->delete();
        return redirect()->route('historiqueSites.index')->with('success', 'Historique site deleted successfully.');
    }
}
