<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //list all sites
        $sites = Site::all();
        return view('sites.index', compact('sites'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create a new site
        return view('sites.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //save the site
        $request->validate([
            'name' => 'required|unique:sites',
            'address' => 'required'
        ]);
        Site::create($request->all());
        return redirect()->route('sites.index')->with('success', 'Site created successfully.');
    }

    /**
     * Display the specified resource.
     * public function show(string $id)
     */
    public function show(Site $site)
    {
        //display a site
        //$site = Site::find($id);
        return view('sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //Edit a site
        //$site = Site::find($id);
        return view('sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //update the site
        $request->validate([
            'name' => 'required|unique:sites,name,'.$site->id,
            'address' => 'required'
        ]);
        $site->update($request->all());
        return redirect()->route('sites.index')->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete the site
        $site->delete();
        return redirect()->route('sites.index')->with('success', 'Site deleted successfully.');
    }
}
