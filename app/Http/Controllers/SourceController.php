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
    $sources = Source::sources(Auth::user()->id);
    $currencies = Auth::user()->currencies;
    // $kinds = Source::kinds(Auth::user()->id);
    // return view("sources.index", ["sources" => $sources, "kinds" => $kinds, "id" => Auth::user()->id]);
    return view("sources.index", ["sources" => $sources, "currencies" => $currencies]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //return view("sources.create");
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $source = Source::loadFromRequest($request);
    Auth::user()->sources()->save($source);
    $response = array();
    $response["success"] = true;
    $response["message"] = "Source \"" . $source->name . "\" successfully created";

    echo json_encode($response);
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
    if($request->cc)
      $request->cc = "true";
    if($request->resume)
      $request->resume = "true";
    
    $source = Source::loadFromRequest($request, $source);

    Auth::user()->sources()->save($source);

    $response = array();
        $response["obj"] = $source;
        $response["success"] = true;
        $response["message"] = "Source \"" . $source->name . "\" successfully updated";
        
        echo json_encode($response);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Source $source)
  {
    $source->delete();
    $response = array();
    $response["success"] = true;
    $response["message"] = "Source \"" . $source->name . "\" successfully deleted";
    echo json_encode($response);
  }
}
