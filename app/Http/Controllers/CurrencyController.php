<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::all();
        return view("currencies.index", ["currencies" => $currencies]);
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
        if(self::keepOneDefault($request->default)){
            $request->default = "true";
        }
        
        $c = Currency::loadFromRequest($request);
        
        Auth::user()->currencies()->save($c);
    
        $response = array();
        $response["success"] = true;
        $response["message"] = "Currency \"" . $c->name . "\" successfully created";
        
        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
    }

    private static function keepOneDefault($default){
        if(count(Auth::user()->currencies()->get()) == 0){
            return true;
        }
        if($default){
            $d = Auth::user()->currencies()->where("default", "=","true")->first();
            $d->default = null;
            Auth::user()->currencies()->save($d);
            return true;
        }
        return false;
    }
}
