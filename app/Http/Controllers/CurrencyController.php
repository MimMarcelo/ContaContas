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
        // $response = array();
        // $response["success"] = true;
        // $response["obj"] = $request;
        // return json_encode($response);
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
        if(self::keepOneDefault($request->default, $currency)){
            $request->default = "true";
        }
        
        $currency = Currency::loadFromRequest($request, $currency);
        
        Auth::user()->currencies()->save($currency);
    
        $response = array();
        $response["obj"] = $currency;
        $response["success"] = true;
        $response["message"] = "Currency \"" . $currency->name . "\" successfully updated";
        
        echo json_encode($response);
        return;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        $response = array();
        if(count(Auth::user()->currencies()->get()) == 1){

            $response["success"] = false;
            $response["message"] = $currency->name . " currency can't be deleted. It is necessary to maintain at least one";
        
            echo json_encode($response);
            return;
        }
        $currency->delete();
        
        if($currency->default){
            $c = Auth::user()->currencies()->first();
            $c->default = "true";
            Auth::user()->currencies()->save($c);
        }

        $response["success"] = true;
        $response["message"] = "Currency \"" . $currency->name ."\" successfully deleted";
        
        echo json_encode($response);
    }

    private static function keepOneDefault($default, $current = null){
        if(count(Auth::user()->currencies()->get()) == 0){
            return true;
        }
        if($default){
            $c = Auth::user()->currencies()->where("default", "=","true")->first();
            if($c){
                $c->default = null;
                Auth::user()->currencies()->save($c);
            }
            return true;
        }
        if($current){
            if($current->default && !$default){
                $c = Auth::user()->currencies()->where("id", "!=", $current->id)->first();

                $c->default = "true";
                Auth::user()->currencies()->save($c);
            }
        }
        return false;
    }
}
