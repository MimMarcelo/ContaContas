<?php

namespace App\Http\Controllers;

use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sources = Auth::user()->sources;
        $kinds = Source::kinds(Auth::user()->id);
        return view("sources.index", ["sources" => $sources, "kinds" => $kinds, "id" => Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("sources.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $source = Source::loadFromRequest($request);
        Auth::user()->sources()->save($source);
        session()->flash('message', 'Source \''.$source->name.'\' successfully created');
        return redirect()->route("sources.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Source $source)
    {
        return redirect()->route("sources.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Source $source)
    {
        return view("sources.create", ["source" => $source]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Source $source)
    {
        $source = Source::loadFromRequest($request, $source);

        Auth::user()->sources()->save($source);
        
        session()->flash('message', $source->name.'\'source successfully updated');
        return redirect()->route("sources.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Source $source)
    {
        $source->delete();
        session()->flash('message', $source->name.'\'source successfully deleted');
        return redirect()->route("sources.index");
    }
}
