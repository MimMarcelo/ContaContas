<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Auth::user()->bills;
        $sources = Bill::getCCTotals($bills);
        return view("bills.index", ["bills" => $bills, "sources" => $sources]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("bills.create", ["sources" => Source::sources(Auth::user()->id)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $bill = Bill::loadFromRequest($request);
    
        Auth::user()->bills()->save($bill);
    
        session()->flash('message', $bill->name.'\'bill successfully created');
        return redirect()->route("bills.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        return view("bills.show", ["bill" => $bill, "fields" => $bill->fillable]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        return view("bills.create", ["bill" => $bill, "sources" => Source::sources(Auth::user()->id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        $bill = Bill::loadFromRequest($request, $bill);

        Auth::user()->bills()->save($bill);
        
        session()->flash('message', $bill->name.'\'bill successfully updated');
        return redirect()->route("bills.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete();
        session()->flash('message', $bill->name.'\'bill successfully deleted');
        return redirect()->route("bills.index");
    }
}
